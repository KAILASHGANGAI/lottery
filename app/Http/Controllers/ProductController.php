<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Exception;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $product = new Product($request->all());
            // Handle image upload
            if ($request->hasFile('image')) {
                $uploadedFile = $request->file('image');

                // Generate a unique name for the file
                $fileName = uniqid('photo_') . '.' . $uploadedFile->getClientOriginalExtension();

                // Move the file to the public/photos directory
                $uploadedFile->move(public_path('photos/products'), $fileName);

                // Set the photo attribute in the product model
                $product->image = 'photos/products/' . $fileName;
            }

            $product->save();

            toast('product created successfully!', 'success');

            return redirect()->route('products.index')->with('success', 'product created successfully!');
        } catch (\Exception $e) {
            toast('Something went wrong' , 'error');

            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $product->update($request->all());

            // Handle image upload
            if ($request->hasFile('image')) {
                $uploadedFile = $request->file('image');

                // Generate a unique name for the file
                $fileName = uniqid('photo_') . '.' . $uploadedFile->getClientOriginalExtension();

                // Move the file to the public/photos directory
                $uploadedFile->move(public_path('photos/products'), $fileName);

                // Set the photo attribute in the product model
                $product->image = 'photos/products/' . $fileName;
            }

            $product->save();
            toast('product Updated successfully!', 'success');

            return redirect()->route('products.index')->with('success', 'Product updated successfully');
        } catch (Exception $e) {
            toast('Something went wrong' , 'error');

            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
    public function search(Request $request)
    {

        try {
            $query = $request->searchitem;
            // Perform a simple search on product_name
            $products = Product::where('product_name', 'like', "%$query%")->get();

            return  response()->json($products);
        } catch (Exception $e) {
            toast('Something went wrong' , 'error');

            return redirect()->json(['error' => $e->getMessage()]);
        }
    }
}
