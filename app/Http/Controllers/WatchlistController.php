<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Log;

class WatchlistController extends Controller
{
    // ウォッチリストを表示
    public function index()
    {
        $movies = Movie::whereNotNull('watchlist_added_at')->get();
        return view('watchlist.index', compact('movies'));
    }

    // マイリストに追加
    public function addToWatchlist(Request $request, $id)
    {
        // 映画データを取得
        $movie = Movie::findOrFail($id);

        if (!$movie) {
            Log::error("映画が見つからない - ID: " . $id);
            return redirect()->route('home')->with('error', '映画が見つかりませんでした。');
        }

        // watchlist_added_at を現在の日時に設定
        $movie->update(['watchlist_added_at' => now()]);

        // ステータス更新のリクエスト内容を記録
        Log::info("更新リクエストの内容: ", ['status' => $request->status]);

        // ウォッチリスト追加完了のログ
        Log::info("ウォッチリストに追加完了 - ID: " . $id);
        
        // 修正: ウォッチリスト画面にリダイレクト
        return redirect()->route('watchlist.index')->with('success', 'ウォッチリストに追加しました！');
    }

    // ウォッチリストの編集画面を表示
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('watchlist.edit', compact('movie'));
    }

    // ウォッチリストの映画データを更新
    public function update(Request $request, $id)
    {
        // バリデーション
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'year' => 'required|integer',
            'description' => 'nullable',
            'status' => 'required|in:未視聴,視聴中,視聴済み',
        ]);

        // 映画データを取得
        $movie = Movie::findOrFail($id);

        // 映画データを更新
        $movie->update($validatedData);

        // 追加処理: 視聴済みにしたらウォッチリストから削除
        if ($validatedData['status'] === '視聴済み') {
            $movie->watchlist_added_at = null; // 直接プロパティを変更
            $movie->save(); // `save()` を使用して確実に更新
            Log::info("視聴済みに変更されたため、ウォッチリストから削除 - ID: " . $id);
        }

        // 更新後の画面にリダイレクト
        return redirect()->route('watchlist.index')->with('success', '視聴状況を更新しました！');
    }

    // ウォッチリストから削除する
    public function removeFromWatchlist($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->watchlist_added_at = null; // 直接プロパティを変更
        $movie->save(); // `save()` を使用して確実に更新

        return redirect()->route('watchlist.index')->with('success', 'ウォッチリストから削除しました！');
    }
}