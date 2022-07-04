<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
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
            'name' => 'required|unique:grades,name->ar,'.$this->id,
            'name_en' => 'required|unique:grades,name->en,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required'),
            'name.unique' => __('validation.unique'),
            'name_en.required' => __('validation.required'),
            'name_en.unique' => __('validation.unique'),
        ];
    }
}
