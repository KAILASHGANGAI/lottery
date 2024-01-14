<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'product_name' => 'string',
            'total_quantity' => 'nullable|string',
            'buying_price' => 'nullable|string',
            'selling_price' => 'string',
            'supplier_name' => 'nullable|string',
            'buying_date' => 'nullable|string',
            'sold_quantity' => 'nullable',
            'recommendation' => 'integer',
        ];
    }
}
