<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleCommentRequest extends FormRequest
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
            'comment' => 'required|max:150'
        ];
    }

    public function messages()
    {
        return [
        "required" => "必須項目が未入力です。",
        "comment.max:150" => "コメントは最大150文字以内です。",
        ];
    }
}
