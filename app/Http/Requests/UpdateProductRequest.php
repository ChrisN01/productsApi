<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|max:255|unique:products,name,' . $this->product->id,
            'detail' => 'required',
            'price' => 'required|numeric|max:100',
            'stock' => 'required|integer|max:6',
            'discount' => 'required|integer|max:70',
        ];
    }
    
}
