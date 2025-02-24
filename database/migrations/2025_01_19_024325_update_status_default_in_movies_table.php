<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // `status` カラムを修正し、デフォルト値を「未視聴」に設定
        Schema::table('movies', function (Blueprint $table) {
            $table->enum('status', ['視聴中', '未視聴'])->default('未視聴')->change();
        });
    }

    public function down(): void
    {
        // `status` カラムを元の状態に戻す
        Schema::table('movies', function (Blueprint $table) {
            $table->string('status')->default(null)->change();
        });
    }
};