<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Reservation;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Store::with(['region', 'genre'])->get();
        return view ('index',compact('cards'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $store = Store::with(['region','genre'])->find($id);

        $cards = Store::with(['region', 'genre'])->get();

        return view('detail',compact('store','cards'));
    }

    public function create(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('login_required', 'ログインしてください');
        }
        
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|string',
            'number' => 'required|integer|min:1',
        ]);

        $reservation = new Reservation();
        $reservation->user_id = auth()->id(); // 現在のユーザーIDを取得
        $reservation->store_id = $id; // ここで $id を使用
        $reservation->date = $request->input('date');
        $reservation->time = $request->input('time');
        $reservation->number = $request->input('number');
        $reservation->save();

        return redirect()->route('done')->with('success', '予約が完了しました');
    }

}
