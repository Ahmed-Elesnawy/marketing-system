<?php

namespace App\Http\Requests\Dashboard;

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
        $arry = [
            'name'         => ['required','string'],
            'code'         => ['required','unique:products'],
            'image'        => ['nullable','image'],
            'images_url'   => ['nullable','url'],
            'price'        => ['required','numeric'],
            'commission'   => ['required','numeric'],
            'stock'        => ['nullable','numeric'],
            'desc'         => ['required','string'],
            'category_id'  => ['required','numeric'],
            'sizes'        => ['nullable','string'],    
        ];

        if ( $this->getMethod() == 'PUT' )
        {
            $arry['code'] = ['required','unique:products,code,'.$this->product->id];
        }

        return $arry;
    }
}
