<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
</head>
<body>
    <p>{{ $reservation->user->name }}様、</p>
    <p>ご予約の日時は{{ \Carbon\Carbon::parse($reservation->time)->format('Y年m月d日 H:i') }}です。</p>
    <p>ご来店をお待ちしております。</p>
</body>
</html>