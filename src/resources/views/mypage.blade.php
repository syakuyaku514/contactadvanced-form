@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="attendance__alert">
  <!-- メッセージ機能 -->
  @if(session('message'))
  <div class="alert alert-success">{{session('message')}}</div>
  @endif
</div>

<h1>{{ Auth::user()->name }}さん</h1>

<h2>予約状況</h2>
@foreach($reservations as $reservation)
<div class="card">
  <div class="card__textbox">
    <div>
      <img src="{{ asset('img/clock.png')}}" alt="時計アイコン" width="25" height="25">
      予約（{{ $reservation->id }}）

      <form method="post" action="{{route('reservation.destroy', $reservation)}}">
        @csrf
        @method('delete')
        <button type="submit" onClick="return confirm('この予約を取消してよろしいですか？');">✕</button>
      </form>
    </div>
    <div>
      <table>
        <tr>
          <th>Shop</th>
          <td>{{ $reservation->store->store }}</td>
        </tr>
        <tr>
          <th>Date</th>
          <td>{{ $reservation->date }}</td>
        </tr>
        <tr>
          <th>Time</th>
          <td>{{ $reservation->time }}</td>
        </tr>
        <tr>
          <th>Number</th>
          <td>{{ $reservation->number }}人</td>
        </tr>
      </table>
    </div>
  </div>
</div>
@endforeach


@endsection