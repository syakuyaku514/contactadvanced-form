@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<p>
登録ありがとうございます
</p>

<div class="header-nav__item">
  <a class="header-nav__link" href="/login">ログインする</a>
</div>
@endsection
