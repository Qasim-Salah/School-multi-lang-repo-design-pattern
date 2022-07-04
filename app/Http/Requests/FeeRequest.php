<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeRequest extends FormRequest
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
            'title_ar' => 'required',
            'title_en' => 'required',
            'amount' => 'required|numeric',
            'grade_id' => 'required|integer',
            'classroom_id' => 'required|integer',
            'type' => 'required|in:رسوم دراسية,رسوم باص',
            'description' => 'required',
            'year' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title_ar.required' => trans('validation.required'),
            'title_en.required' => trans('validation.unique'),
            'amount.required' => trans('validation.required'),
            'amount.numeric' => trans('validation.numeric'),
            'grade_id.required' => trans('validation.required'),
            'classroom_id.required' => trans('validation.required'),
            'year.required' => trans('validation.required'),
        ];
    }
}
