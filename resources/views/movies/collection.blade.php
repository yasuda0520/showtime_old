@extends('layouts.app') {{-- 共通レイアウトを継承 --}}

@section('content') {{-- メインコンテンツセクションの開始 --}}
<div class="container my-5">
    {{-- 画面タイトル --}}
    <h1 class="text-center">マイコレクション</h1>
    {{-- 画面説明 --}}
    <p class="text-center">視聴済みの作品を楽しむ画面です</p>

    {{-- 映画一覧表示エリア --}}
    <div class="row">
        {{-- 取得した映画データをループ処理 --}}
        @foreach($movies as $movie) 
            {{-- 視聴済みの映画のみ表示 --}}
            @if($movie->status === '視聴済み') 
            {{-- 映画カードコンポーネント --}}
            <div class="col-md-4 mb-3">
                <div class="card">
                    {{-- 映画のサムネイル画像 --}}
                    <img src="{{ $movie->poster_url ?? 'path/to/default_image.jpg' }}" class="card-img-top" alt="{{ $movie->title }}">
                    
                    <div class="card-body">
                        {{-- 映画タイトル --}}
                        <h5 class="card-title">{{ $movie->title }}</h5>
                        {{-- 映画の説明 --}}
                        <p class="card-text">{{ $movie->description }}</p>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
</div>
@endsection {{-- メインコンテンツセクションの終了 --}}