<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        if ( $this->getMethod() == 'PUT' )
        {
            return [
                
                'name_ar' => ['required','unique:categories,name_ar,'.$this->category->id],
                'name_en' => ['required','unique:categories,name_en,'.$this->category->id]
            ];
        }

        return [

            'name_ar' => ['required','unique:categories'],
            'name_en' => ['required','unique:categories'],

        ];
    }
}
