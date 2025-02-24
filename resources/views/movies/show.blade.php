<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- ページのタイトル -->
    <title>SHOWTIME - 作品詳細</title>
    
    <!-- アプリケーションのスタイルシートを読み込む -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <!-- ヘッダーセクション -->
    <header>
        <h1>SHOWTIME</h1>
        <nav>
            <ul>
                <!-- 作品一覧ページへのリンク -->
                <li><a href="{{ route('movies.index') }}">作品一覧</a></li>
                <!-- 新しい作品を追加するページへのリンク -->
                <li><a href="{{ route('movies.create') }}">新しい作品を追加</a></li>
                <!-- ホームページへのリンク -->
                <li><a href="{{ route('home') }}">ホーム</a></li>
            </ul>
        </nav>
    </header>

    <!-- メインコンテンツ -->
    <main>
        <!-- 作品のタイトルを表示 -->
        <h2>{{ $movie->title }}</h2>
        <!-- 作品の説明を表示 -->
        <p>{{ $movie->description }}</p>
        <!-- 視聴状況を表示 -->
        <p>視聴状況: {{ $movie->status }}</p>
        <!-- 作品一覧ページに戻るリンク -->
        <a href="{{ route('movies.index') }}">作品一覧に戻る</a>
    </main>

    <!-- フッターセクション -->
    <footer>
        <p>&copy; 2025 SHOWTIME All Rights Reserved.</p>
    </footer>
</body>
</html>