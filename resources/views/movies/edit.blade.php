@extends('layouts.app')

@section('content')
<div class="container">
    <h1>作品の編集</h1>

    <form method="POST" action="{{ route('movies.update', $movie->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $movie->title) }}">
        </div>
        
        <div class="mb-3">
            <label for="status" class="form-label">視聴状況</label>
            <select id="status" name="status" class="form-select">
                <option value="未視聴" {{ $movie->status == '未視聴' ? 'selected' : '' }}>未視聴</option>
                <option value="視聴中" {{ $movie->status == '視聴中' ? 'selected' : '' }}>視聴中</option>
                <option value="視聴済み" {{ $movie->status == '視聴済み' ? 'selected' : '' }}>視聴済み</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection