<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CollectionController;

class CollectionController extends Controller
{
    /**
     * コレクションの一覧を表示
     */
    public function index()
    {
        // コレクション一覧ページを表示する
        return view('collections.index');
    }

    /**
     * 特定のコレクションを表示
     * @param int $id コレクションのID
     */
    public function show($id)
    {
        // 特定のコレクション詳細ページを表示する
        return view('collections.show', ['id' => $id]);
    }

    /**
     * 新しいコレクション作成フォームを表示
     */
    public function create()
    {
        // 新しいコレクション作成ページを表示する
        return view('collections.create');
    }

    /**
     * 新しいコレクションを保存
     * @param Request $request リクエストデータ
     */
    public function store(Request $request)
    {
        // 新しいコレクションをデータベースに保存
        // 必要に応じてバリデーション処理を追加
        return redirect()->route('collections.index'); // コレクション一覧ページへリダイレクト
    }
}