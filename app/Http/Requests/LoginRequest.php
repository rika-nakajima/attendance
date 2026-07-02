<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスは必須項目です。',
            'email.email'    => 'メールアドレスの形式で入力してください。',
            'password.required' => 'パスワードは必須項目です。',
        ];
    }
}
