<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    // 映画一覧を表示
    public function index()
    {
        $movies = Movie::whereNull('deleted_at')->get(); // 論理削除されていないものだけ取得
        return view('movies.index', compact('movies'));
    }

    // 映画登録フォームを表示
    public function create()
    {
        return view('movies.create');
    }

    // 映画を保存（登録）
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'year' => 'required|integer',
            'description' => 'nullable',
        ]);

        // `status` は登録時に設定せず、DB のデフォルト値を使用
        Movie::create($validatedData);

        return redirect()->route('movies.index')->with('success', '映画を登録しました');
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

        return redirect()->route('movies.index')->with('success', '映画情報を更新しました');
    }

    // 映画を論理削除
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->update(['deleted_at' => now()]);

        return redirect()->route('movies.index')->with('success', '映画を削除しました');
    }
}