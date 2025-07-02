<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    // 入力画面表示
    public function index()
    {
        return view('index');
    }

    // 確認画面表示
    // 確認画面から「修正する」ボタンが押されたときの処理
    // 入力値を保持したまま入力フォーム(indexページ)へリダイレクトする
    public function confirm(ContactRequest $request)
    {
        $contact = $request->validated(); // バリデーション済みデータのみ取得
        return view('confirm', compact('contact'));
    }

    // データ保存＆サンクスページへ
    public function store(ContactRequest $request)
    {
        //dd('storeメソッドに到達'); // ←ここで送信データを表示してみる

        $contact = new Contact();
        $form = $request->validated(); // バリデーション済みデータのみ取得
        // 電話番号の連結処理
        $form['tel'] = $request->tel1 . $request->tel2 .  $request->tel3;
        $form['building_name'] = $request->building_name;
        unset($form['tel1'], $form['tel2'], $form['tel3']);
        $contact->fill($form)->save();
        return view('thanks');
    }

    // 修正ボタンで戻るとき（フォーム値を保持したまま）
    public function back(Request $request)
    {
        return redirect('/')
            ->withInput($request->except('_token'));
    }
}
