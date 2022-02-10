<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordRequest extends FormRequest
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
            'menu' => 'required|max:150',
            'feedback' => 'required|max:200'
        ];
    }

    public function messages()
    {
        return [
        "required" => "必須項目が未入力です。",
        "menu.max:150" => "メニューは最大150文字以内です。",
        "feedback.max:200" => "フィードバックは最大200文字以内です。",
        ];
    }
}
