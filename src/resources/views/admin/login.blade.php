<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/admin/admin.index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <h1>管理者ログイン</h1>
    <div class="formcard">
        <form method="POST" action="{{ route('admin.login') }}" class="formcard_form">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <img src="{{ asset('img/emailicon.png')}}" alt="メールアイコン" width="25" height="25">
                    <input type="email" class="inputlabel" name="email" id="email" placeholder="Email" required>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <img src="{{ asset('img/keyicon.png')}}" alt="鍵アイコン" width="25" height="25">
                    <input type="password" class="inputlabel" name="password" id="password" placeholder="Password" required>
                </div>
            </div>

            <div class="adminloginbtn">
                <button class="form__button-submit" type="submit">ログイン</button>
            </div>
        </form>
    </div>
</body>
</html>