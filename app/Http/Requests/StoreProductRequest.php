<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        if ($this->isMethod('POST')) {
            return [
                'name' => 'required|max:255|unique:products,name',
                'description' => 'required',
                'price' => 'required|max:10',
                'stock' => 'required|max:6',
                'discount' => 'required|max:2'
            ];
        } else if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return [
                'name' => 'required|max:255',
                'description' => 'required',
                'price' => 'required|max:10',
                'stock' => 'required|max:6',
                'discount' => 'required|max:2'
            ];
        }
    }
}
