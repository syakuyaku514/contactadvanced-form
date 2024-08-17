<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
</head>
<body>
    <h1>店舗管理者画面です</h1>

    <!-- ログインボタン -->
    <form action="{{ route('owner.logout') }}" method="POST">
    @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>