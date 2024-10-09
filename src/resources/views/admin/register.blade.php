<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者登録</title>
    <link rel="stylesheet" href="{{ asset('css/admin/admin.index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <h1>管理者登録</h1>
    <div class="formcard">
        <form method="POST" action="{{ route('admin.register.submit') }}" class="formcard_form">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <img src="{{ asset('img/personicon.png')}}" alt="ユーザーアイコン" width="25" height="25">
                    <input type="text" name="name" id="name" required>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <img src="{{ asset('img/emailicon.png')}}" alt="メールアイコン" width="25" height="25">
                    <input type="email" name="email" id="email" required>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <img src="{{ asset('img/keyicon.png')}}" alt="鍵アイコン" width="25" height="25">
                    <input type="password" name="password" id="password" required>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <img src="{{ asset('img/keyicon.png')}}" alt="鍵アイコン" width="25" height="25">
                    <input type="password" name="password_confirmation" id="password_confirmation" required>
                </div>
            </div>
            <div class="adminloginbtn">
                <button class="form__button-submit" type="submit">登録</button>
            </div>
        </form>
    </div>
</body>
</html>