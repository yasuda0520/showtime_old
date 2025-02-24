@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center">マイコレクション</h1>
    <p class="text-center">視聴済みの作品を楽しむ画面です</p>

    <div class="row">
        @foreach($movies as $movie)
            <!-- APIで取得した視聴済みの作品を表示 -->
            @if($movie->status === '視聴済み') <!-- ここで視聴済みか判定 -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ $movie->poster_url ?? 'path/to/default_image.jpg' }}" class="card-img-top" alt="{{ $movie->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $movie->title }}</h5>
                        <p class="card-text">{{ $movie->description }}</p>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
</div>
@endsection