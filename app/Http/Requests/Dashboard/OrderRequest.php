<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            
            'client_name'    => ['required','string'],
            'client_address' => ['required','string'],
            'client_phone1'  => ['required'],
            'province_id'    => ['required','numeric'],
            'markter_note'   => ['nullable','string'],
         
        ];
    }
}
