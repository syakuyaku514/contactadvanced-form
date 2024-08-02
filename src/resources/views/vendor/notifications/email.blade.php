@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else

# @lang('こんにちは')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
@php
    $color = $color ?? 'primary';
@endphp
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else

{{ config('app.name') }}より
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
    
@lang(
    "もし、「:actionText」ボタンがうまく機能しない場合は、以下のURLをブラウザのURL欄にコピー&ペーストしてアクセスして下さい。
    [:actionURL](:actionURL)",
    [
        'actionText' => $actionText,
        'actionURL' => $actionUrl,
    ]
)
@endslot
@endisset
@endcomponent