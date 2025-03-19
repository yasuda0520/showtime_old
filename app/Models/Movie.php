<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    // 明示的にテーブル名を指定
    protected $table = 'movies';

    // `year` を追加し、`watchlist_added_at` の更新が適用されるように修正
    protected $fillable = ['title', 'year', 'description', 'status', 'priority', 'watchlist_added_at', 'deleted_at'];
    
    // `watchlist_added_at` を日時としてキャスト
    protected $casts = [
        'watchlist_added_at' => 'datetime',
    ];
}