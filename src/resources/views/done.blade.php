@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')


<div class="card">
    <p>ご予約ありがとうございます</p>

    <a class="header-nav__link" href="/mypage">戻る</a>
</div>


@endsection