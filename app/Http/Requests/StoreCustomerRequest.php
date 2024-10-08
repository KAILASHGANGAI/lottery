<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'cid' => 'required|string|max:255|unique:customers,cid',
            'phone' => 'nullable|string|max:20',
            'provision_id' => 'required|exists:provisions,id',
            'district_id' => 'required|exists:districts,id',
            'gaupalika_id' => 'required|exists:gaupalikas,id',
            'ward_no' => 'nullable|string|max:255',
            'lottery_amount' => 'nullable|integer',
            'ref_fee' => 'nullable|integer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gender' => 'nullable|string|max:10',
            'citizenship_no' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'salary' => 'nullable|string|max:255',
            'wlocation' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'hf_name' => 'nullable|string|max:255',
            'no_of_members' => 'nullable|string|max:255',
            'refered_by' => 'required|string|max:255',
            'nominee_holder_name' => 'nullable|string|max:255',
            'nominee_relation' => 'nullable|string|max:255',
            'nominee_phone' => 'nullable|string|max:255',
            'temp_provision_id' => 'nullable|string|max:255',
            'temp_district_id' => 'nullable|string|max:255',
            'temp_gaupalika_id' => 'nullable|string|max:255',
            'temp_ward_no' => 'nullable|string|max:255',
            'reg_date' => 'nullable|string|max:255',
            
        ];
    }
}
