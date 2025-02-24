<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class HomeController extends Controller
{
    //ホーム画面を表示するメソッド
    public function index()
    {
        // 映画データを取得
        $movies = Movie::all(); // データベースから映画データを取得

        // home.blade.php にデータを渡して表示
        return view('home', compact('movies'));
    }
}