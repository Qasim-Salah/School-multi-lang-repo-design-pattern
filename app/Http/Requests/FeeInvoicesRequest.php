<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeInvoicesRequest extends FormRequest
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
            'student_id' => 'required',
            'fee_id' => 'required',
            'amount' => 'required',
            'grade_id' => 'required',
            'classroom_id' => 'required',
            'description' => 'required',

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
