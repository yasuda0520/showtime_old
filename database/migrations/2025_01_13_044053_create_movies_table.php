<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // タイトルカラム
            $table->integer('year')->nullable(false); // 公開年カラム
            $table->text('description')->nullable(); // 説明カラムを追加
            $table->string('status')->default('未視聴'); // ステータスカラムを追加
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies'); // movies テーブルを削除
    }
};
