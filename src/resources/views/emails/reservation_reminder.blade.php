<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
</head>
<body>
    <h1>予約リマインド</h1>
    <p>{{ $reservation->user->name ?? 'No name provided' }}様</p>

    <p>以下の内容で予約がされています。</p>
    <ul>
        <li>店舗: {{ $reservation->store->store}}</li>
        <li>日時: {{ $reservation->time }}</li>
    </ul>
    <p>ご来店をお待ちしております。</p>
</body>
</html>