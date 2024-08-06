<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepositeRequest extends FormRequest
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
            'customer_id' => 'required|exists:customers,id',
            'deposite_amount' => 'required|numeric|min:0',
            'fine_amount' => 'numeric|min:0',
            'customer_name' => 'required|string|max:255',
            'customer_by' => 'nullable|string|max:255',
            'dod' => 'required|date'
        ];
    }
}
