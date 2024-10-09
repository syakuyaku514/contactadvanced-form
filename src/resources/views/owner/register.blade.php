<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>店舗管理者登録</title>
</head>
<body>
    <h1>店舗管理者登録</h1>
    <form method="POST" action="{{ route('owner.register.submit') }}">
        @csrf
        <div>
            <label for="name">名前</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
        <div>
            <button type="submit">登録</button>
        </div>
    </form>
</body>
</html>