<?php

return [

    'required' => ':attribute を入力してください。',
    'email' => ':attribute は「ユーザー名@ドメイン」形式で入力してください。',
    'confirmed' => ':attribute と確認用が一致しません。',

    // ... 他のメッセージ

    'custom' => [
        'name' => [
            'required' => 'お名前を入力してください',
        ],
        'email' => [
            'required' => 'メールアドレスを入力してください',
            'email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
        ],
        'password' => [
            'required' => 'パスワードを入力してください',
            'min' => 'パスワードは8文字以上で入力してください',
            'confirmed' => 'パスワードと確認用パスワードが一致しません',
        ],
        'password_confirmation' => [
            'required' => 'パスワード（確認用）を入力してください',
        ],
    ],

    'attributes' => [
        'name' => '名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード（確認用）',
    ],

];