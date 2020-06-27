<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProvinceRequest extends FormRequest
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
        $rules = [
            'name' => ['required','unique:provinces'],
            'shipping_price' => ['required','numeric'],
        ];

        if ( $this->getMethod() == 'PUT' )
        {
            $rules['name'] = 'required|unique:provinces,name,'.$this->province->id;
        }

        return $rules;
    }
}
