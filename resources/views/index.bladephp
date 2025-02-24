@extends('layouts.app') <!-- レイアウトを継承 -->

@section('content') <!-- コンテンツセクションの開始 -->
<div class="container my-5">
    <h1 class="text-center">コレクション</h1> <!-- タイトル -->

    <!-- コレクションのリスト -->
    <div class="row">
        <!-- データベースから取得したコレクションをループ表示 -->
        @foreach($collections as $item) 
        <div class="col-md-4">
            <div class="card">
                <!-- コレクションの画像 -->
                <img src="{{ $item->image }}" class="card-img-top" alt="{{ $item->title }}">
                <div class="card-body">
                    <!-- コレクションのタイトル -->
                    <h5 class="card-title">{{ $item->title }}</h5>
                    <p class="card-text">{{ $item->description }}</p>
                    <!-- 詳細ページへのリンク -->
                    <a href="/collections/{{ $item->id }}" class="btn btn-primary">詳細を見る</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection <!-- コンテンツセクションの終了 -->