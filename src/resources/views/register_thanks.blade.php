@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="card thankscard">
    <p class="tanks">会員登録ありがとうございます</p>

    <a class="thanksbackbtn" href="/login">ログインする</a>
</div>
@endsection
