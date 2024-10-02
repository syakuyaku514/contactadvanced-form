<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>支払いページ</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
</head>
<body>
    <div class="container">
        <h1 class="title">お支払い画面</h1>
        <div class="container_form">
        <form id="payment-form" action="{{ route('payment.process') }}" method="POST">
            @csrf
            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
            <div class="form-group">
                <label for="amount">お支払い金額 (JPY)</label>
                <input type="number" id="amount" name="amount" value="{{ $reservation->number * 5000 }}" readonly>
            </div>
            <div class="form-group">
                <label for="card-element">クレジットカードまたはデビットカード</label>
                <div id="card-element">
                    <!-- StripeのElementがここに挿入されます。 -->
                </div>
                <!-- フォームのエラーを表示するために使用します。 -->
                <div id="card-errors" role="alert"></div>
            </div>
            <div class="form-group">
                <button type="submit">支払う</button>
            </div>
        </form>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>

    <script>
    // ページがロードされた後にStripeの処理を行う
    document.addEventListener('DOMContentLoaded', function() {
        // Stripeクライアントを作成します。
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');

        // Elementsのインスタンスを作成します。
        var elements = stripe.elements();

        // カード要素を作成します。
        var card = elements.create('card');

        // `card-element` divにカードElementのインスタンスを追加します。
        card.mount('#card-element');

        // カードElementからのリアルタイムバリデーションエラーを処理します。
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // フォームの送信を処理します。
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // エラーがあった場合にユーザーに通知します。
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // トークンをサーバーに送信します。
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);
                    form.submit();
                }
            });
        });
    });
</script>
</body>
</html>