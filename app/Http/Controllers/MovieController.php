<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    // 作品一覧を表示
    public function index()
    {
        // 削除済みでない作品だけ取得
        $movies = Movie::whereNull('deleted_at')->get();
        return view('watchlist.index', compact('movies'));
    }

    // 作品登録フォームを表示
    public function create()
    {
        return view('movies.create');
    }

    // 作品を保存（登録）
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

    // 作品編集フォームを表示
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.edit', compact('movie'));
    }

    // 作品情報を更新
    public function update(Request $request, $id)
{
    // 更新処理開始のログ
    Log::info("update メソッド開始 - ID: {$id}");

    // フォームの入力データをバリデーション
    $validatedData = $request->validate([
        'status' => 'required|in:未視聴,視聴中,視聴済み', // 視聴状況のみバリデーション
    ]);

    // ID に対応する映画データを取得（存在しない場合はエラー）
    $movie = Movie::findOrFail($id);

    // 更新データを準備
    $updateData = ['status' => $request->status];

    // ✅ 視聴済みにした場合、ウォッチリストから削除（in_watchlist を 0 にする）
    if ($request->status === '視聴済み') {
        $updateData['in_watchlist'] = 0; // ウォッチリストから削除
        Log::info("ウォッチリストから削除 - ID: {$id}"); // ログ記録
    }

    // 1回の update() でまとめて更新
    $movie->update($updateData);

    // 更新後の情報をログに記録
    Log::info("更新成功 - ID: {$id}, ステータス: {$movie->status}");

    // 視聴済みリストにリダイレクト
    return redirect()->route('movies.collection');
}

    // 作品を論理削除
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->deleted_at = now();
        $movie->save();
        
        return back();
    }
    // 視聴済みの作品を一覧表示
    public function collection()
    {
        // 視聴済みの作品を取得
        $movies = Movie::where('status', '視聴済み')->get();

        // collection.blade.php にデータを渡す
        return view('movies.collection', compact('movies'));
    }
}