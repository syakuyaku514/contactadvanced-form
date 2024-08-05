@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="card thankscard">
    <p class="tanks">Roseへの登録ありがとうございます</p>
    <p class="">メールアドレス確認のメールをお送りいたします</p>
    <p>メールアドレスが正しい場合は下記ボタンよりログインください</p>

    <a class="thanksbackbtn" href="/login">ログインする</a>
</div>
@endsection
