<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionsRequests extends FormRequest
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
            'name' => 'required',
            'name_en' => 'required',
            'grade_id' => 'required',
            'class_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('Sections_trans.required_ar'),
            'name_en.required' => trans('Sections_trans.required_en'),
            'grade_id.required' => trans('Sections_trans.Grade_id_required'),
            'class_id.required' => trans('Sections_trans.Class_id_required'),
        ];
    }
}
