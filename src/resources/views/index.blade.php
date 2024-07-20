@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="attendance__alert">
  <!-- メッセージ機能 -->
</div>

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

@guest
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
@endguest


@endsection