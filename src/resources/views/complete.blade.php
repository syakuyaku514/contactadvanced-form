<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese 決済完了</title>
    <link rel="stylesheet" href="{{ asset('css/complete.css') }}">
</head>

<body>
    <div class="container">
        <header>
            <h1 class="container_title">決済が成功しました</h1>
        </header>
        <main>
            <div class="completebox">
                <p class="completetext">ご利用いただきありがとうございます。決済が正常に完了しました。</p>
                <p>詳細情報:</p>
                <div class="complete_list">
                    <ul class="list">
                        <li>決済額: {{ $amount }} 円</li>
                        <li>通貨: {{ strtoupper($currency) }}</li>
                    </ul>
                </div>
                <div class="container_btn">
                    <a href="{{ url('/') }}" class="btn-primary">ホームに戻る</a>
                </div>
            </div>
        </main>
        <footer>
            <p>&copy; {{ date('Y') }} Rese.</p>
        </footer>
    </div>
</body>
</html>