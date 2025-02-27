<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class HomeController extends Controller
{
    //ホーム画面を表示するメソッド
    public function index()
    {
        /// 削除済みでない作品だけ取得
        $movies = Movie::whereNull('deleted_at')->get();

        // home.blade.php にデータを渡して表示
        return view('home', compact('movies'));
    }
}