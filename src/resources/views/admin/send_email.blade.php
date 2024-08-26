<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メール送信画面</title>
</head>
<body>
    <h1>メール送信</h1>
    <div>
        <button type="button" onClick="history.back()" class="backbtn"><</button>
    </div>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.sendEmail') }}" method="POST">
        @csrf
        <label for="email">宛先メールアドレス:</label>
        <input type="email" name="email" id="email" required>
        
        <label for="subject">件名:</label>
        <input type="text" name="subject" id="subject" required>
        
        <label for="message">メッセージ:</label>
        <textarea name="message" id="message" rows="5" required></textarea>
        
        <button type="submit">送信</button>
    </form>
</body>
</html>