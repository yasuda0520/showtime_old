<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            
            // 'status' カラムのデータ型を ENUM から string(20) に変更し、デフォルト値を '未視聴' に設定
            $table->string('status', 20)->default('未視聴')->change();
        });
    }

    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            
            // ロールバック時に 'status' カラムを string 型のままデフォルト値なしに変更
            $table->string('status')->default(null)->change();
        });
    }
};