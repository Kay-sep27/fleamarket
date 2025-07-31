<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|between:0,10000',
            'description' => 'required|string|max:120',
            'image' => 'nullable|mimetypes:image/jpeg,image/png,image/jpg|max:2048',
            'seasons'     => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => '商品名を入力してください',
            'price.required'       => '値段を入力してください',
            'price.numeric'        => '数値で入力してください',
            'price.between'        => '0~10000円以内で入力してください',
            'description.required' => '商品説明を入力してください',
            'description.max'      => '120文字以内で入力してください',
            'image.mimes'          => '「.png」または「.jpeg」形式でアップロードしてください',
            'seasons.required'     => '季節を選択してください',
        ];
    }
}