@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">観たい作品を登録</h1>
    <form action="{{ route('movies.store') }}" method="POST">
        @csrf <!-- Laravelのセキュリティ対策（フォーム送信時に必須） -->

        <!-- タイトル入力欄 -->
        <div class="mb-3">
            <label class="form-label">タイトル</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <!-- 公開年（数字のみ入力可能） -->
        <div class="mb-3">
            <label class="form-label">公開年</label>
            <input type="number" name="year" class="form-control" placeholder="例: 2025">
        </div>

        <!-- 説明（テキストエリア） -->
        <div class="mb-3">
            <label class="form-label">説明</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        
        <!-- 観たい度（ラジオボタン形式で1〜5の星評価） -->
        <div class="mb-3">
            <label class="form-label">観たい度（1〜5）</label>
            <div>
                @for ($i = 1; $i <= 5; $i++)
                    <label class="form-check form-check-inline">
                        <input type="radio" name="watch_priority" value="{{ $i }}" class="form-check-input" @checked($i == 3)>
                        ☆{{ $i }}
                    </label>
                @endfor
            </div>
        </div>

        <!-- 登録ボタン -->
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
</div>
@endsection