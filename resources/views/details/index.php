@extends('layouts.app') <!-- レイアウトを継承 -->

@section('content') <!-- コンテンツセクションの開始 -->
<div class="container my-5">
    <!-- 詳細情報 -->
    <h1 class="text-center">{{ $item->title }}</h1> <!-- タイトル -->
    <div class="row">
        <div class="col-md-6">
            <!-- 映画・ドラマ・アニメの画像 -->
            <img src="{{ $item->image }}" class="img-fluid" alt="{{ $item->title }}">
        </div>
        <div class="col-md-6">
            <!-- 映画・ドラマ・アニメの説明 -->
            <p>{{ $item->description }}</p>
            <p><strong>ジャンル:</strong> {{ $item->genre }}</p>
            <p><strong>公開日:</strong> {{ $item->release_date }}</p>
            <!-- 戻るボタン -->
            <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
            <!-- ウォッチリストに追加 -->
            <form action="/watchlist" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <button type="submit" class="btn btn-primary">ウォッチリストに追加</button>
            </form>
        </div>
    </div>
</div>
@endsection <!-- コンテンツセクションの終了 -->