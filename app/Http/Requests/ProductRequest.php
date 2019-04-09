<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|alpha_dash|unique:products',
             'price'=>'required|numeric|between:1,99999999',
            'details'=>'required|string',
            'discount'=>'required|numeric|max:50',
            'stock'=>'required|numeric|max:100',
        ];
    }
}
