<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOWTIME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100"> <!-- ここにBootstrapクラスを追加 -->
    <header class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SHOWTIME</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">ホーム</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('movies.create') }}">観たい作品を登録</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('watchlist.index') }}">ウォッチリスト</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('movies.collection') }}">マイコレクション</a></li>
                </ul>
            </div>
        </div>
    </header>

    <main class="flex-grow-1 container mt-4"> <!-- フッター以外を広げる -->
        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-auto"> <!-- mt-autoを追加 -->
        <p>&copy; 2025 SHOWTIME All Rights Reserved.</p>
    </footer>
</body>
</html>