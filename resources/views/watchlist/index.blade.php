@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center">ウォッチリスト</h1>

    @if($movies->isEmpty())
        {{-- ウォッチリストが空の場合のメッセージ表示 --}}
        <p class="text-center">まだ登録された作品はありません。</p>
    @else
        <div class="row">
            @foreach($movies as $movie)
                {{-- 削除されていない映画のみ表示する --}}
                @if (is_null($movie->deleted_at))
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                {{-- 映画のタイトルを表示 --}}
                                <h5 class="card-title">{{ $movie->title }}</h5>
                                {{-- 映画の説明を表示 --}}
                                <p class="card-text">{{ $movie->description }}</p>
                                {{-- 視聴ステータスを表示 --}}
                                <p class="card-text"><strong>ステータス:</strong> {{ $movie->status }}</p>
                                {{-- 編集ボタン（映画の情報を編集） --}}
                                <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning">編集</a>
                                {{-- 削除ボタン（映画を削除する） --}}
                                <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-button">削除</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
@endsection