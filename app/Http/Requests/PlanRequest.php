<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
            'plan_name' => 'required|max:20',
            'price' => 'required',
            'time' => 'required',
            'introduction' => 'required|max:150'
        ];
    }

    public function messages()
    {
        return [
        "required" => "必須項目が未入力です。",
        "plan_name.max:20" => "プラン名は20文字以内です。",
        "introduction.max:150" => "自己紹介は150文字以内です。",
        ];
    }

}
