<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;
use App\Models\Reservation;
use App\Models\User;

class UserController extends Controller
{

    // indexビュー表示　入力フォーム
    public function index()
    {
        return view('index');
    }

    public function payment(Request $request)
    {
        $reservation = Reservation::findOrFail($request->reservation_id);
        // ログインしているユーザーの情報を取得
        $user = $request->user(); 
    
        $stripe = new StripeClient('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
    
        try {
            // 支払いを処理
            $charge = $stripe->charges->create([
                // 金額は単位で指定
                'amount' => $reservation->number * 5000 * 1,
                'currency' => 'jpy',
                // フォームから送信されたトークン
                'source' => $request->stripeToken,
                'description' => 'Reservation Payment for ' . $reservation->id,
                'receipt_email' => $user->email,
            ]);

            // 支払いが成功した場合、完了画面にリダイレクト
            return redirect()->route('complete')->with([
                'amount' => $reservation->number * 5000,
                'currency' => 'jpy',
            ]);

        } catch (\Exception $e) {
            // 支払いが失敗した場合、エラーメッセージを表示
            return back()->withErrors(['error' => '支払いに失敗しました: ' . $e->getMessage()]);
        }
    }

    public function paymentPage(Request $request, $reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        return view('payment', ['reservation' => $reservation]);
    }
    

    public function complete()
    {
        // 完了画面に渡すデータを準備
        $amount = session('amount');
        $currency = session('currency');

        return view('complete', compact('amount', 'currency'));
    }

}
