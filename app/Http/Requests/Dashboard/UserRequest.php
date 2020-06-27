<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
         $rules =  [
            'name'     => ['required','string','min:3'],
            'email'    => ['required','email','unique:users'],
            'password' => ['required','min:4','confirmed'],
            'status'   => ['required','in:pending,active'],
            'type'     => ['required','in:admin,markter'],
            'phone'    => ['required'],
            'image'    => ['nullable','image'],
        ];

        if ( $this->getMethod()  == 'PUT' )
        {
            $rules['password'] = ['nullable','min:4'];
            $rules['email']    = ['required','unique:users,email,'.$this->user->id];
        }

        return $rules;
    }
}
