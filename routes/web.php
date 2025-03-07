<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\HomeController;

// ホーム画面のルート
Route::get('/', [HomeController::class, 'index'])->name('home');

// 映画の新規登録画面を表示するルート
Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');

// 映画の登録処理を実行するルート
Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');

// 映画の一覧を表示するルート
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');

// 映画の編集画面を表示するルート
Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');

// 映画の更新処理を実行するルート
Route::put('/movies/{id}', [MovieController::class, 'update'])->name('movies.update');

// 映画の削除処理を実行するルート
Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('movies.destroy');

// ウォッチリスト画面を表示するルート
Route::get('/watchlist', [WatchlistController::class, 'index'])->name('watchlist.index');

//  ウォッチリストに追加
Route::post('/movies/{id}/add-to-watchlist', [WatchlistController::class, 'addToWatchlist'])->name('movies.addToWatchlist');

// ウォッチリストから削除するルート
Route::delete('/watchlist/{id}', [WatchlistController::class, 'removeFromWatchlist'])->name('watchlist.remove');

// ウォッチリストの更新処理を実行するルート
Route::put('/watchlist/{id}/update', [WatchlistController::class, 'update'])->name('watchlist.update');

// 視聴済みの映画を表示するページ
Route::get('/collection', [MovieController::class, 'collection'])->name('movies.collection');