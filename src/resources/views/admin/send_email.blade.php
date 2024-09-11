<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メール送信画面</title>
    <link rel="stylesheet" href="{{ asset('css/admin/admin.mail.css') }}">
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

    <form action="{{ route('admin.sendEmail') }}" method="POST" class="mailform">
        @csrf
        <table>

          <tr>
            <th>
              <label for="email" class="maillabel">宛先メールアドレス:</label>
            </th>
            <th>
              <input type="email" name="email" id="email" class="mailinput" required>
            </th>
          </tr>
        
          <tr>
            <td>
              <label for="subject" class="maillabel">件名:</label>
            </td>
            <td>
              <input type="text" name="subject" id="subject" class="mailinput" required>
            </td>
          </tr>
        
          <tr>
            <td>
              <label for="message" class="maillabel">メッセージ:</label>
            </td>
            <td>
              <textarea name="message" id="message" rows="5" class="mailinput" required></textarea>
            </td>
          </tr>

        </table>

        <button type="submit" class="mailbtn">送信</button>
    </form>
</body>
</html>