<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者画面</title>
    <link rel="stylesheet" href="{{ asset('css/admin/admin.index.css') }}">
</head>
<body>
    <h1>管理者画面</h1>

    <div class="adminform">
        <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
            <button type="submit" class="indexbtn">Logout</button>
        </form>
        <a href="{{ route('admin.sendEmailForm') }}">
            <button class="indexbtn">メール送信画面へ</button>
        </a>
    </div>

    <div class="adminindex">
        <div class="admincreate">
        <p class="admincreatep">店舗代表者作成</p>

        <form method="POST" action="{{ route('owner.register.submit') }}">
            @csrf
            <div>
                <label for="name" class="formlabel">名前</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div>
                <label for="email" class="formlabel">メールアドレス</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="password" class="formlabel">パスワード</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <label for="password_confirmation" class="formlabel">パスワード確認</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>
            <div>
                <button type="submit" class="createbtn">新規作成</button>
           </div>
        </form>
        </div>

        <div class="adminview">
            <p class="admincreatep">店舗代表者一覧</p>
            @foreach ($owners as $owner)
            <table>
                <tr>
                   <td class="adminviewname">{{$owner->name}}</td>
                   <td class="adminviewemail">{{$owner->email}}</td>
                </tr>
            </table>
            @endforeach
        </div>
       

    </div>

</body>
</html>