@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="attendance__alert">
  <!-- メッセージ機能 -->
</div>

<div class="cards">
@foreach($cards as $card)
<div class="card">
  <div class="card__imgframe">
    <img src="{{ asset($card->image) }}" alt="{{ $card->store }}" class="cardimg">
  </div>
  <div class="card__textbox">
    <div class="card__titletext">
      <p>{{ $card->store }}</p>
    </div>
    <div class="card__overviewtext">
      <div class="cardtag">
        <p>#{{ $card->region->region }}</p>
        <p>#{{ $card->genre->genre }}</p>
      </div>
      <div class="cardbtn">
        <a href="{{ route('store.detail', $card->id)}}">詳しく見る</a>
        <p>ハート</p>
      </div>
    </div>
  </div>
</div>
@endforeach
</div>

<!-- @guest
  <div class="card">
  <div class="card__imgframe"></div>
  <div class="card__textbox">
    <div class="card__titletext">
      タイトルがはいります。タイトルがはいります。
    </div>
    <div class="card__overviewtext">
      概要がはいります。概要がはいります。概要がはいります。概要がはいります。
    </div>
  </div>
</div>
@endguest -->


@endsection