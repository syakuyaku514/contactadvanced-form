<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>決済完了</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <header>
            <h1>決済が成功しました</h1>
        </header>
        <main>
            <p>ご利用いただきありがとうございます。決済が正常に完了しました。</p>
            <p>詳細情報:</p>
            <ul>
                <li>決済額: {{ $amount }} 円</li>
                <li>通貨: {{ strtoupper($currency) }}</li>
            </ul>
            <a href="{{ url('/') }}" class="btn btn-primary">ホームに戻る</a>
        </main>
        <footer>
            <p>&copy; {{ date('Y') }} あなたの会社名. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>