<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin/admin.index.css') }}">
</head>
<body>
    <h1>管理者画面です</h1>

    <!-- ログアウトボタン -->
    <form action="{{ route('admin.logout') }}" method="POST">
    @csrf
        <button type="submit" class="indexbtn">Logout</button>
    </form>

    <div class="adminindex">
    <div class="admincreate">
        <p>店舗代表者作成</p>

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
            <button type="submit">新規作成</button>
        </div>
    </form>
    </div>

    <div class="adminview">
        <p>店舗代表者一覧</p>
        @foreach ($owners as $owner)
        <table>
            <tr>
               <td>{{$owner->name}}</td>
               <td>{{$owner->email}}</td>
            </tr>
        </table>
        @endforeach
    </div>
    

    <div>
        <a href="{{ route('admin.sendEmailForm') }}">
            <button class="indexbtn">メール送信画面へ</button>
        </a>
    </div>

    </div>

</body>
</html>