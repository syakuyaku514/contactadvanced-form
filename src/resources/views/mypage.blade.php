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

<h1 class="usertag">{{ Auth::user()->name }}さん</h1>

<div class="titletag">
  <h2>予約状況</h2>
  <h2>お気に入り店舗</h2>
</div>

<div class="content-container">
  
<div class="content-container">
  <div class="">
    @foreach($reservations as $reservation)
    <div class="iconcarda">
      <div class="reservation">
        <div class="aicontag">
          <img src="{{ asset('img/clock.png')}}" alt="時計アイコン" width="25" height="25" class="clock">
          <p class="texttag">予約</p>
          <form action="">
            @csrf
            <a href="{{ route('edit', ['id' => $reservation->id]) }}">
              <img src="{{ asset('img/menu.png') }}" alt="予約変更">
            </a>
          </form>
          <form method="post" action="{{ route('reservation.destroy', $reservation) }}">
            @csrf
            @method('delete')
            <button type="submit" onClick="return confirm('この予約を取消してよろしいですか？');" class="returnbtn">
              <img src="{{ asset('img/cross.png')}}" alt="✕" class="heart">
            </button>
          </form>
        </div>
        <div>
          <table>
            <tr>
              <th class="textcoler tabletag">
                <p>Shop</p>
              </th>
              <td class="textcoler tabletag">
                <p>{{ $reservation->store->store }}</p>
              </td>
            </tr>
            <tr>
              <th class="textcoler tabletag">
                <p>Date</p>
              </th>
              <td class="textcoler tabletag">
                <p>{{ $reservation->date }}</p>
              </td>
            </tr>
            <tr>
              <th class="textcoler tabletag">
                <p>Time</p>
              </th>
              <td class="textcoler tabletag">
                <p>{{ $reservation->time }}</p>
              </td>
            </tr>
            <tr>
              <th class="textcoler tabletag">
                <p>Number</p>
              </th>
              <td class="textcoler tabletag">
                <p>{{ $reservation->number }}人</p>
              </td>
            </tr>
            <tr>
              <th>QRコード</th>
              <td>{!! QrCode::generate($reservation->url) !!}</td>
            </tr>
          </table>
        </div>
        <!-- 支払いボタンの追加 -->
        <div class="payment-section">
          <a href="{{ route('payment.page', ['reservation' => $reservation->id]) }}" class="btn btn-primary">
            支払い
          </a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

  <div class="section-container">
    
    @foreach($favoriteStores as $store)
    <div class="card">
      <div class="card__imgframe">
        <img src="{{ asset($store->image) }}" alt="{{ $store->store }}" class="cardimg">
      </div>
      <div class="card__textbox">
        <div class="card__titletext">
          <p class="storename">{{ $store->store }}</p>
        </div>
      <div class="card__overviewtext">
      <div class="cardtag">
        <p class="tag">{{ $store->region->region }}</p>
        <p>#{{ $store->genre->genre }}</p>
      </div>
      <div class="cardbtn">
        <a href="{{ route('store.detail', $store->id) }}" class="linkbtn">詳しく見る</a>
        <form action="{{ route('store.favorite', $store->id) }}" method="post">
        @csrf
          <button type="submit" class="hartbtn">
            @if (Auth::check() && Auth::user()->favorites()->where('store_id', $store->id)->exists())
                <img src="{{ asset('img/redhart.png')}}" alt="ハート" class="heart">
            @else
                <img src="{{ asset('img/grayhart.png')}}" alt="ハート" class="heart">
            @endif
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach


  </div>
</div>
@endsection