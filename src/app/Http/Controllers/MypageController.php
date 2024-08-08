<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Reservation;
use App\Models\Favorite;
use App\Models\Genre;
use App\Models\Region;
use App\Http\Requests\ReservationRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MypageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 画面表示
    public function index()
    {
        // ユーザーの予約情報を取得
        $reservations = Reservation::with('store')->where('user_id', auth()->id())->get();

        // QRコードのURLを予約ごとに生成
        $reservations->each(function ($reservation) {
            $reservation->url = route('checkin', ['reservation_id' => $reservation->id]);
        });

        // ユーザーのお気に入り店舗情報を取得
        $favoriteStores = Store::whereHas('favorites', function($query) {
            $query->where('user_id', auth()->id());
        })->with(['region', 'genre'])->get();

        return view('mypage', compact('reservations', 'favoriteStores'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 予約削除機能
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('mypage')->with('message', '予約が削除されました');
    }

    // 予約更新ページ表示
    public function edit($id)
    {
        $reservation = Reservation::find($id);

        $store = Store::find($reservation->store_id);
        $cards = Store::with(['region', 'genre'])->get();
        $regions = Region::all(); 
        $genres = Genre::all();

        return view('edit',compact('reservation','store','cards','regions','genres'));
    }

    // 予約更新機能
    public function update(ReservationRequest $request,$id)
    {
        $reservation = Reservation::find($id);
        $reservation->update([
            'date' => $request->date,
            'time' => $request->time,
            'number' => $request->number,
        ]);

        return redirect()->route('mypage')->with('success', '予約が更新されました');
    }

    // QRコード作成
    public function qrcode()
    {
        // 予約IDを含むURLを生成
        $url = route('checkin', ['reservation_id' => $reservation->id]);
        $encodedUrl = urlencode($url);
        
        return view('mypage', compact('url', 'reservation'));
    }

}
