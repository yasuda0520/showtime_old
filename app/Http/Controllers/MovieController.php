<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    // 映画一覧を表示
    public function index()
    {
        // ウォッチリストにある未視聴の作品のみ取得
        $movies = Movie::whereNotNull('watchlist_added_at')->where('status', '!=', '視聴済み')->get();
        return view('watchlist.index', compact('movies'));
    }

    // ホーム画面に表示する作品を取得
    public function home()
    {
        // ウォッチリストに追加されていない作品のみ取得
        $movies = Movie::whereNull('watchlist_added_at')
                       ->where('status', '!=', '視聴済み')
                       ->get();

        return view('home', compact('movies'));
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
        // バリデーション
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'year' => 'nullable|integer', 
            'description' => 'nullable',
            'status' => 'required|in:未視聴,視聴中,視聴済み',
        ]);

        $movie = Movie::findOrFail($id);
        $movie->update($validatedData);

        // 視聴済みならウォッチリストから削除
        if ($validatedData['status'] === '視聴済み') {
            $movie->watchlist_added_at = null;
            $movie->save(); // `save()` で確実に適用
        }

        return redirect()->route('movies.index');
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

    // 作品をウォッチリストに追加
    public function addToWatchlist(Request $request, $id)
    {
        dd('処理開始'); // ここで確実に止まるか確認

        $movie = Movie::findOrFail($id);
        
        // デバッグログを追加
        Log::info("ウォッチリスト追加前: ID = {$id}, watchlist_added_at = {$movie->watchlist_added_at}");

        $movie->watchlist_added_at = now();

        try {
            $saved = $movie->save(); // `save()` を実行

            if ($saved) {
                Log::info("ウォッチリスト追加後: ID = {$id}, watchlist_added_at = {$movie->watchlist_added_at}, save_result = {$saved}");
            } else {
                Log::error("ウォッチリスト追加エラー: ID = {$id}, save() が false を返しました。");
            }
        } catch (\Exception $e) {
            Log::error("ウォッチリスト追加失敗: ID = {$id}, エラー: " . $e->getMessage());
        }

        return redirect()->route('home')->with('success', 'ウォッチリストに追加しました！');
    }
}