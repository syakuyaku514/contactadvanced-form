<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirmemail</title>
</head>
<body>
    <div class="mb-4 text-sm text-gray-600">
            ご登録ありがとうございます！<br>
            ご入力いただいたメールアドレスへ認証リンクを送信しましたので、クリックして認証を完了させてください。<br>
            もし、認証メールが届かない場合は再送させていただきます。
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                新しい認証メールが送信されました。
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="/email/verification-notification">
                @csrf

                <div>
                    <x-jet-button type="submit">
                        認証メールを再送する
                    </x-jet-button>
                </div>
            </form>

            <form method="POST" action="/logout">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    ログアウト
                </button>
            </form>
        </div>
</body>
</html>