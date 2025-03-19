@extends('layouts.app') <!-- レイアウトを継承 -->

@section('content')
<div class="container my-5">
    <!-- メインタイトル -->
    <h1 class="text-center">ようこそ SHOWTIME へ</h1>
    <!-- サブタイトル -->
    <p class="text-center">映画・ドラマ・アニメを登録して、自分だけのコレクションを作ろう！</p>

    <!-- 登録された作品一覧 -->
    <h2 class="text-center my-4">登録された作品一覧</h2>
    @if($movies->isEmpty())
        <p class="text-center">まだ登録された作品はありません。</p>
    @else
        <div class="row">
            @foreach($movies as $movie)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie->title }}</h5>
                            <p class="card-text">{{ $movie->description }}</p>
                            <p class="card-text"><strong>観たい度:</strong> {{ $movie->priority }} ☆</p>

                            <!-- ウォッチリストに追加ボタン -->
                            <form action="{{ route('movies.watchlist', ['id' => $movie->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-primary">ウォッチリストに追加</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- 静的な映画カードの例 -->
    <h2 class="text-center my-4">おすすめ作品</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="movie1.jpg" class="card-img-top" alt="作品1">
                <div class="card-body">
                    <h5 class="card-title">作品タイトル1</h5>
                    <p class="card-text">作品の説明。</p>
                    <a href="#" class="btn btn-primary">詳細を見る</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="movie2.jpg" class="card-img-top" alt="作品2">
                <div class="card-body">
                    <h5 class="card-title">作品タイトル2</h5>
                    <p class="card-text">作品の説明。</p>
                    <a href="#" class="btn btn-primary">詳細を見る</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="movie3.jpg" class="card-img-top" alt="作品3">
                <div class="card-body">
                    <h5 class="card-title">作品タイトル3</h5>
                    <p class="card-text">作品の説明。</p>
                    <a href="#" class="btn btn-primary">詳細を見る</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection