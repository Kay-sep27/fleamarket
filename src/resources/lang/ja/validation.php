<?php

return [

    'required' => ':attribute を入力してください。',
    'numeric' => ':attribute は数値で入力してください。',
    'min' => [
        'numeric' => ':attribute は :min 以上の数値を入力してください。',
        'string' => ':attribute は :min 文字以上で入力してください。',
    ],
    'max' => [
        'string' => ':attribute は :max 文字以内で入力してください。',
    ],
    'image' => ':attribute は画像ファイルを指定してください。',
    'mimes' => ':attribute は :values 形式でアップロードしてください。',
    'confirmed' => ':attribute の確認が一致しません。',
    
    'custom' => [
        'name' => [
            'required' => '商品名を入力してください。',
        ],
        'price' => [
            'required' => '価格を入力してください。',
            'numeric' => '価格は数値で入力してください。',
            'min' => '価格は0円以上で入力してください。',
        ],
        'description' => [
            'required' => '商品説明を入力してください。',
            'max' => '商品説明は120文字以内で入力してください。',
        ],
        'image' => [
            'image' => '画像ファイルを選択してください。',
            'mimes' => '画像はjpegまたはpng形式でアップロードしてください。',
        ],
    ],

    'attributes' => [
        'name' => '商品名',
        'price' => '価格',
        'description' => '商品説明',
        'image' => '商品画像',
    ],

];