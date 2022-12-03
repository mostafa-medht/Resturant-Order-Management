<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChargeIngredientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'ingredient_id' => 'required|numeric|exists:ingredients,id',
            'quantity'      => 'required|numeric|min:1',
            'unit'          => 'sometimes|string|in:kg,g'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        if ($validator->fails()) {
            throw new HttpResponseException(returnCustomValidationError('please check your data', $validator->errors()));
        }
    }
}
