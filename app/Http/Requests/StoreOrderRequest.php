<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'billing_name'                  => 'required|string|min:2',
            'billing_email'                 => 'required|email',
            'billing_total'                 => 'required|numeric',
            'products'                      => 'required|array|min:1',
            'products.*.product_id'         => 'required|numeric|exists:products,id',
            'products.*.quantity'           => 'required|numeric|min:1',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        if ($validator->fails()) {
            throw new HttpResponseException(returnCustomValidationError('please check your data', $validator->errors()));
        }
    }
}
