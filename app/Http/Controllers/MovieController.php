<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    // 映画一覧を表示
    public function index()
    {
        // 削除済みでない作品だけ取得
        $movies = Movie::whereNull('deleted_at')->get();
        return view('watchlist.index', compact('movies'));
    }

    // 映画登録フォームを表示
    public function create()
    {
        return view('movies.create');
    }

    // 映画を保存（登録）
    public function store(Request $request)
    {
        // バリデーション
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'year' => 'required|integer',
            'description' => 'nullable',
        ], [
            'title.required' => 'タイトルを入力してください。',
            'year.required' => '公開年を入力してください。',
            'year.integer' => '公開年は数値で入力してください。',
        ]);

        // `status` は登録時に設定せず、DB のデフォルト値を使用
        Movie::create([
            'title' => $validatedData['title'],
            'year' => $validatedData['year'],
            'description' => $validatedData['description'] ?? null,
            'status' => '未視聴', // デフォルト値を設定
        ]);
        
        return redirect()->route('home');
    }

    // 映画編集フォームを表示
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.edit', compact('movie'));
    }

    // 映画情報を更新
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'year' => 'required|integer',
            'description' => 'nullable',
            'status' => 'required|in:未視聴,視聴中,視聴済み',
        ]);

        $movie = Movie::findOrFail($id);
        $movie->update($validatedData);

        return redirect()->route('movies.index');
    }

    // 映画を論理削除
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->deleted_at = now();
        $movie->save();
        
        return back();
    }
}