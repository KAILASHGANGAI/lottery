<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|integer',
            'product_name' => 'required|string',
            'product_code' => 'required|string|unique:products,product_code', // Add unique constraint here
            'total_quantity' => 'nullable|string',
            'buying_price' => 'nullable|string',
            'selling_price' => 'required|string',
            'supplier_name' => 'nullable|string',
            'buying_date' => 'nullable|string',
            'sold_quantity' => 'nullable',
            'recommendation' => 'integer|default:10',

        ];
    }
}
