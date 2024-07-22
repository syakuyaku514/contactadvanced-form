@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="attendance__alert">
  <!-- メッセージ機能 -->
</div>

<h1>{{ Auth::user()->name }}さん</h1>

<h2>予約状況</h2>
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

<h2>お気に入り店舗</h2>
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


@endsection