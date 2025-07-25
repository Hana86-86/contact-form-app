<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'last_name' =>'required|string|max:255',
            'first_name' =>'required|string|max:255',
            'gender' => 'required|in:男性,女性,その他',
            'email' => ['required', 'regex:/^[^@]+@[^@]+\.[^@]+$/'],
            'tel' => 'required|digits_between:10,11',
            'address' => 'required|string|max:255',
            'category_id' => 'required|in:1,2,3,4,5',
            'detail' => 'required|string|max:120',
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => ' メール形式で入力してください（例：example@example.com）',
            'email.regex' => 'メールアドレスは「ユーザー名@ドメイン.拡張子」形式で入力してください。',
            'tel.required' => '電話番号を入力してください',
            'tel.digits' => '電話番号は10桁または11桁で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
