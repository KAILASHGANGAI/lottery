<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Owner;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::paginate(12);

        return view('/pos', compact('products'));
    }
    public function getcard()
    {
        $cards = Card::all();
        return response()->json(['datas' => $cards]);
    }
    public function quantityUpdate(Request $req,  $id)
    {

        $card = Card::find($id);
        try {
            $total = $req->quantity * $card->price;
            $card->quantity = $req->quantity;
            $card->subtotal = $total;
            $card->save();

            return response()->json(['statu s' => 'quantity updated']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function addToCart($productId)
    {

        try {
            $product = Product::find($productId);
            $card = Card::where('product_id', $productId)->first();
            if ($card) {
                $card->update([
                    'quantity' =>  $card['quantity'] + 1,
                    'subtotal' => $card->subtotal + $product->selling_price
                ]);
            } else {
                Card::create([
                    'product_id' => $product->id,
                    'product_name' => $product->product_name,
                    'quantity' => 1,
                    'price' => $product->selling_price,
                    'subtotal' => $product->selling_price,

                ]);
            }



            toast("Product added to card.", 'success');
            return response()->json(['message' => "product is ready to sale"]);
        } catch (Exception $e) {
            return response()->json(['message' => "something is wrong", 'error' => $e->getMessage()]);
        }
    }
    public function removeFromCart(Request $request, $id)
    {
        try {
            // Retrieve the cart item based on the product ID
            $cartItem = Card::find($id)->first();
            if ($cartItem) {
                $cartItem->delete();
                return response()->json(['status' => 'Item removed from the cart']);
            } else {
                return response()->json(['error' => 'Item not found in the cart'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function checkout(Request $req)
    {

        try {
            $datas = Card::all();
            // Start a database transaction
            DB::beginTransaction();
            // Step 1: Create an order
            $order = new Order();
            $order->customer_id = $req->customer_id;
            $order->user_id = Auth::id();
            $order->quantity = $datas->sum('quantity');
            $order->total = $datas->sum('subtotal');
            $order->pay_amount = $req->pay_amount;
            $order->due = $req->due;
            $order->payby = $req->customer_name;
            $order->save();

            // Step 2: Move data to OrderDetails
            foreach ($datas as $card) {
                OrderDetails::create([
                    'order_id' => $order->id,
                    'product_id' => $card->product_id,
                    'quantity' => $card->quantity,
                    'price' => $card->price,
                ]);

                // Delete the record from the Card model
                $card->delete();
            }

            // Commit the transaction if everything is successful
            DB::commit();

            // Additional logic if needed after the successful transaction
            return redirect()->route('checkout.bill', ['order' => $order, 'cards' => $datas]);
        } catch (\Exception $e) {
            // An error occurred, rollback the database transaction
            DB::rollBack();
            // Log the error or handle it in any way you prefer
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function showBill(Request $request)
    {
        $owner = Owner::find(1);
        $orderId = $request->input('order');
        $order = Order::with('orderDetails')->find($orderId);
        if (!$order) {
            abort(404, 'Order not found');
        }
        return view('print.bill', ['order' => $order, 'owner'=>$owner]);
    }
}
