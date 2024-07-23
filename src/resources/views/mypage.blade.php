@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="attendance__alert">
  <!-- メッセージ機能 -->
</div>

<h1>{{ Auth::user()->name }}さん</h1>

<h2>予約状況</h2>
@foreach($reservations as $reservation)
<div class="card">
  <div class="card__textbox">
    <div>
      <img src="{{ asset('img/clock.png')}}" alt="時計アイコン" width="25" height="25">
      予約（{{ $reservation->id }}）

      <button>✕</button>
    </div>
    <div>
      <table>
        <tr>
          <th>Shop</th>
          <td>{{ $reservation->store->store }}</td>
        </tr>
        <tr>
          <th>Date</th>
          <td>{{ $reservation->date }}</span></td>
        </tr>
        <tr>
          <th>Time</th>
          <td>{{ $reservation->time }}</span></td>
        </tr>
        <tr>
          <th>Number</th>
          <td>{{ $reservation->number }}人</span></td>
        </tr>
      </table>
    </div>
  </div>
</div>
@endforeach
@endsection