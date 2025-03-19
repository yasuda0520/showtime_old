<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\HomeController;

// ホーム画面のルート
Route::get('/', [HomeController::class, 'index'])->name('home');

// 作品の新規登録画面を表示するルート
Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');

// 作品の登録処理を実行するルート
Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');

// 作品の一覧を表示するルート
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');

// 作品の編集画面を表示するルート
Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');

// 作品の更新処理を実行するルート
Route::put('/movies/{id}', [MovieController::class, 'update'])->name('movies.update');

// 作品の削除処理を実行するルート
Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('movies.destroy');

// ウォッチリスト画面を表示するルート
Route::get('/watchlist', [WatchlistController::class, 'index'])->name('watchlist.index');

// 作品をウォッチリストに追加するルート
Route::post('/movies/{id}/add-to-watchlist', [WatchlistController::class, 'addToWatchlist'])->name('movies.addToWatchlist');

// ウォッチリストから映画を削除するルート
Route::delete('/watchlist/{id}', [WatchlistController::class, 'removeFromWatchlist'])->name('watchlist.remove');

// ウォッチリストの映画情報を更新するルート
Route::put('/watchlist/{id}/update', [WatchlistController::class, 'update'])->name('watchlist.update');

// マイコレクション画面を表示するルート
Route::get('/collection', [MovieController::class, 'collection'])->name('movies.collection');

// 作品をウォッチリストに追加するルート
Route::post('/movies/{id}/watchlist', [MovieController::class, 'addToWatchlist'])->name('movies.watchlist');