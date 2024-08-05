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
    <div class="card-header">{{ __('ログインするにはメールアドレスを確認してください') }}</div>

    <div class="card-body">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('新しい認証リンクが送信されました。') }}
            </div>
        @endif

        {{ __('もしメールが届かない場合は、再送ボタンをクリックしてください。') }}
        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('再送する') }}</button>
        </form>
    </div>

</div>
@endsection