@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="register__content">

  <div class="card">
    <div class="card__imgframe">
      <div class="register-form__heading">
        <h2 class="logintitle">Registration</h2>
      </div>
    </div>

    <div class="form__group-content">
      <div class="form__error">
        @error('name')
        {{ $message }}
        @enderror
      </div>
    </div>

    <div class="form__group-content">
      <div class="form__error">
        @error('email')
        {{ $message }}
        @enderror
      </div>
    </div>

    <div class="form__group-content">
      <div class="form__error">
        @error('password')
        {{ $message }}
        @enderror
      </div>
    </div>

  <form class="form" action="/register" method="post">
    @csrf
    <div class="form__group">
      <div class="form__group-title">
        <img src="{{ asset('img/personicon.png')}}" alt="ユーザーアイコン" width="25" height="25">
        <input class="inputform" type="text" name="name" placeholder="Username" value="{{ old('name') }}" />
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <img src="{{ asset('img/emailicon.png')}}" alt="メールアイコン" width="25" height="25">
        <input class="inputform" type="email" name="email" placeholder="Email" value="{{ old('email') }}" />
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <img src="{{ asset('img/keyicon.png')}}" alt="メールアイコン" width="25" height="25">
        <input class="inputform" type="password" name="password" placeholder="Password" />
      </div>
    </div>

    <div class="form__button">
      <button class="form__button-submit" type="submit">登録</button>
    </div>
  </form>
  </div>
</div>
@endsection