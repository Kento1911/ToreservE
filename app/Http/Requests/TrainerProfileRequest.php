<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainerProfileRequest extends FormRequest
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
            'trainer_id' => 'unique:trainer_profiles',
            'name' => 'required|max:20',
            'sex' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg|max:10240',
            'profile_comment' => 'required|max:500',
        ];
    }

    public function messages()
    {
        return [
        "required" => "必須項目が未入力です。",
        "profile_image.image" => "指定されたファイルが画像ではありません。",
        "mines" => "指定された拡張子(PNG/JPG/JPEG)ではありません。",
        "profile_iamge.max" => "10MBを超えています。",
        "name.max" => "名前は最大20文字です。" ,
        "profile_comment" => "自己紹介は最大500文字以内です。",
        ];
    }
}
