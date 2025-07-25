<?php

namespace App\Http\Rules;

class RegisterValidationRules
{
    public static function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'max:255','unique:users,email','email:rfc'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public static function messages(): array
    {
        return [
            'name.required' => 'お名前を入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください。',
            'email.unique' => 'すでに登録されているメールアドレスです。',
            'password.required' => 'パスワードを入力してください。',
        ];
    }
}