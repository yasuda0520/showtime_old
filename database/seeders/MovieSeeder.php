<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    public function run()
    {
        Movie::create([
            'title' => 'テスト映画',
            'description' => 'テスト用の映画データ',
            'status' => '未視聴',
            'priority' => 3,
            'year' => 2025
        ]);
    }
}