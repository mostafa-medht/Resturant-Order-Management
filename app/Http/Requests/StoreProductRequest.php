<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'                          => 'required|string|min:2',
            'price'                         => 'required|numeric|min:1',
            'active'                        => 'sometimes|boolean',
            'ingredients'                   => 'required|array|min:1',
            'ingredients.*.ingredient_id'   => 'required|numeric|exists:ingredients,id',
            'ingredients.*.quantity'        => 'required|numeric|min:1',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        if ($validator->fails()) {
            throw new HttpResponseException(returnCustomValidationError('please check your data', $validator->errors()));
        }
    }
}
