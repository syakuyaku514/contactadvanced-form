<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
</head>
<body>
    <h1>店舗管理者画面です</h1>

    <!-- ログアウトボタン -->
    <form action="{{ route('owner.logout') }}" method="POST">
    @csrf
        <button type="submit">Logout</button>
    </form>

    <p>店舗情報の作成</p>
    <p>店舗情報の更新</p>
    <p>予約情報の確認</p>
</body>
</html>