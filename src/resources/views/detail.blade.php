@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<div>
    <button><</button>
    <p>店名</p>
</div>
<div class="card">
    <p>ここに写真</p>

    <p>ここにタグ</p>
    <p>ここにタグ</p>

    <p>説明文</p>
</div>

<div class="card">
    <p>予約</p>

    <input type="day">
    <input type="text">
    <input type="text">

    <!-- インプットをここに表示 -->

    <button>予約する</button>
</div>

@endsection