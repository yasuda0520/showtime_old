<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie; // Movieモデルを使用

class RegistrationController extends Controller
{
    // 新規登録画面を表示
    public function create()
    {
        return view('movies.create'); // 新規登録画面を表示
    }

    // 登録処理
    public function store(Request $request)
    {
        // バリデーション（必須項目や最大文字数の確認）
        $request->validate([
            'title' => 'required|max:255', // タイトルが必須
            'description' => 'nullable',  // 説明は任意
            'status' => 'required|in:視聴中,未視聴', // 視聴状況
        ]);

        // データをデータベースに保存
        Movie::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
        ]);

        // ホーム画面にリダイレクト
        return redirect()->route('home')->with('success', '作品が登録されました！');
    }
}