<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true; // 必ずtrue
    }

    public function rules(): array
    {
    return [
        'last_name' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'gender' => 'required|in:男性,女性,その他',
        'email' => 'required|email',
        'tel1' => 'required|digits_between:2,5',
        'tel2' => 'required|digits:4',
        'tel3' => 'required|digits:4',
        'address' => 'required|string|max:255',
        'building_name' => ['nullable', 'string', 'max:100'],
        'category_id' => 'required|in:1,2,3,4,5',
        'content' => 'required|string|max:120',
    ];
    }

    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel1.required' => '電話番号を入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel3.required' => '電話番号を入力してください',
            'tel1.digits_between' => '電話番号は5桁までの数字で入力してください',
            'tel2.digits' => '電話番号は4桁の数字で入力してください',
            'tel3.digits' => '電話番号は4桁の数字で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'content.required' => 'お問い合わせ内容を入力してください',
            'content.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
