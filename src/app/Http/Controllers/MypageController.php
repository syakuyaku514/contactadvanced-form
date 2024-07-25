<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Reservation;
use App\Models\Favorite;

class MypageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ユーザーの予約情報を取得
        $reservations = Reservation::with('store')->where('user_id', auth()->id())->get();

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
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('mypage')->with('message', '予約が削除されました');
    }

}
