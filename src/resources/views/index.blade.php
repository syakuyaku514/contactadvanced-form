@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<script src="{{ asset('js/like.js') }}"></script>
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
        <form action="{{ route('store.favorite', $card->id) }}" method="post">
        @csrf
          <button type="submit">
            @if (Auth::user()->favorites()->where('store_id', $card->id)->exists())
                ❤️ お気に入り解除
            @else
                🤍 お気に入り
            @endif
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
</div>
@endsection