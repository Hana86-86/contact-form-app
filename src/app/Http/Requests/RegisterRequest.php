<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
            'bail',
            'required',
            'string',
            'email',
            'max:255',
            'unique:users,email',
            'regex:/^[^@]+@[^@]+\.[^@]+$/',
        ],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'お名前を入力してください',
        'email.required' => 'メールアドレスを入力してください',
        'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
        'email.regex' => 'メールアドレスは「ユーザー名@ドメイン.拡張子」形式で入力してください',
        'email.unique' => 'すでに登録されているメールアドレスです',
        'password.required' => 'パスワードを入力してください',
        ];
    }
}
