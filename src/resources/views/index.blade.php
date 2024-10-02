@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<script src="{{ asset('js/like.js') }}"></script>
<!-- 検索用のJavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enterキーが押されたらフォーム送信
    const keywordInput = document.querySelector('.indexform_inp');
    keywordInput.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // デフォルトのEnterキー動作を無効化
            document.querySelector('.indexform').submit(); // フォームを送信
        }
    });

    // 地域やジャンルのドロップダウンが変更されたらフォーム送信
    const regionSelect = document.querySelector('#region');
    const genreSelect = document.querySelector('#genre');

    regionSelect.addEventListener('change', function() {
        document.querySelector('.indexform').submit(); // フォームを送信
    });

    genreSelect.addEventListener('change', function() {
        document.querySelector('.indexform').submit(); // フォームを送信
    });
});
</script>
@endsection

@section('content')
<div class="attendance__alert">
  <!-- メッセージ機能 -->
</div>

<div>
  <form action="/search" method="POST" class="indexform">
  @csrf
  <div class="serachbox">
    <div class="select-container">
      <select name="region" id="region" class="region">
        <option value="">All area</option>
        @foreach($regions as $region)
          <!-- 選択されたregionの保持 -->
          <option value="{{ $region->id }}" {{ (old('region') == $region->id || request('region') == $region->id) ? 'selected' : '' }}>
            {{ $region->region }}
          </option>
        @endforeach
      </select>
      <div class="arrow"></div>
    </div>

    <div class="select-container">
      <select name="genre" id="genre" class="genre">
        <option value="">All genre</option>
        @foreach($genres as $genre)
          <!-- 選択されたgenreの保持 -->
          <option value="{{ $genre->id }}" {{ (old('genre') == $genre->id || request('genre') == $genre->id) ? 'selected' : '' }}>
            {{ $genre->genre }}
          </option>
        @endforeach
      </select>
      <div class="arrow"></div>
    </div>
    <div class="indexform_img">
      <!-- 検索キーワードの値を保持 -->
      <input type="text" name="keyword" value="{{ old('keyword', request('keyword')) }}" placeholder="Search..." class="indexform_inp">
    </div>
    <!-- <button type="submit" class="serachbox_btn">Search</button> -->
  </div>
  </form>
</div>              

<div class="cards">
@foreach($cards as $card)
<div class="card">
  <div class="card__imgframe">
    @if (strpos($card->image, 'images/') !== false)
        <img src="{{ asset('storage/' . $card->image) }}" alt="{{ $card->store }}" class="cardimg">
    @else
        <img src="{{ asset($card->image) }}" alt="{{ $card->store }}" class="cardimg">
    @endif
  </div>
  <div class="card__textbox">
    <div class="card__titletext">
      <p class="storename">{{ $card->store }}</p>
    </div>
    <div class="card__overviewtext">
      <div class="cardtag">
        <p class="tag">#{{ $card->region->region }}</p>
        <p class="tag">#{{ $card->genre->genre }}</p>
      </div>
      <div class="cardbtn">
        <a href="{{ route('store.detail', $card->id)}}" class="linkbtn">詳しく見る</a>
        <form action="{{ route('store.favorite', $card->id) }}" method="post">
        @csrf
          <button type="submit" class="hartbtn">
            @if (Auth::check() && Auth::user()->favorites()->where('store_id', $card->id)->exists())
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
@endsection