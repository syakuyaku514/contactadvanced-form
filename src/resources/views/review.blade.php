@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')

<div class="detailcard">
    <!-- 店舗詳細 -->
  <div>
    <div class="titlebox">
      <button type="button" onClick="history.back()" class="backbtn"><</button>
      <p class="store">{{ $store->store }}</p>
    </div>
    <div class="">
      <img src="{{ asset($store->image) }}" alt="{{ $store->store }}" class="detailimg">
      <div class="storedetail">
        <p>#{{ $store->region->region }}</p>
        <p>#{{ $store->genre->genre }}</p>
    </div>
        <p class="explanacard">{{ $store->overview }}</p>  
    </div>
  </div>

  <!-- レビューカード -->
  <div class="reservationcard">
    <p class="reservationcard_title">レビューを書く</p>
    <form action="{{ route('store.review', $store->id) }}" method="post">
        @csrf
        <ul class="cardlist">
            <li>
                <select name="star_rating" id="star_rating" required>
                        <option value="">評価を選択</option>
                        <option value="1">★☆☆☆☆</option>
                        <option value="2">★★☆☆☆</option>
                        <option value="3">★★★☆☆</option>
                        <option value="4">★★★★☆</option>
                        <option value="5">★★★★★</option>
                </select>
            </li>
            <li>
                <div class="">
                    <label for="body">コメント</label>
                    <textarea name="body" class="form-control" id="body" cols="30" rows="10"></textarea>
                </div>
            </li>
        </ul>

        <button type="submit" class="reservationbtn">送信する</button>
    </form>
  </div>
</div>

<p>この店舗のレビュー</p>

@if(session('message'))
  <div class="todo__alert--success">
    {{ session('message') }}
  </div>
@endif

  
<div>
@foreach($storeReviews as $storeReview)
<div class="review">
  <p>{{ $storeReview->user->name }}</p>
  <div>
    @for ($i = 0; $i < $storeReview->stars; $i++)
      <img src="{{ asset('img/star-yellow.png')}}" alt="黄色い星">
    @endfor
    @for ($i = $storeReview->stars; $i < 5; $i++)
      <img src="{{ asset('img/star-gray.png')}}" alt="灰色の星">
    @endfor
  </div>
  <p>{{ $storeReview->comment }}</p>
  @if(auth()->id() == $storeReview->user_id)
    <form action="{{ route('review.update', $storeReview->id) }}" method="post">
      @csrf
      @method('PATCH')
      <div>
        <select name="stars" id="stars" required>
          <option value="">評価を選択</option>
          <option value="1" {{ $storeReview->stars == 1 ? 'selected' : '' }}>★☆☆☆☆</option>
          <option value="2" {{ $storeReview->stars == 2 ? 'selected' : '' }}>★★☆☆☆</option>
          <option value="3" {{ $storeReview->stars == 3 ? 'selected' : '' }}>★★★☆☆</option>
          <option value="4" {{ $storeReview->stars == 4 ? 'selected' : '' }}>★★★★☆</option>
          <option value="5" {{ $storeReview->stars == 5 ? 'selected' : '' }}>★★★★★</option>
        </select>
        <input type="text" name="comment" value="{{ $storeReview->comment }}" required>
        <button type="submit">更新</button>
      </div>
    </form>
    <form action="{{ route('review.destroy', $storeReview->id) }}" method="post">
      @csrf
      @method('DELETE')
      <div>
        <button type="submit">削除</button>
      </div>
    </form>
  @endif
</div>
@endforeach
</div>


<script>
    //
</script>

@endsection