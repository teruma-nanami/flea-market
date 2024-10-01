@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/thanks.css') }}" />
@endsection

@section('content')
<div class="container">
    <h2>ご購入いただきありがとうございます</h2>
    <p>購入が確定しました。マイページで詳細を確認できます。</p>
    <p><a href="{{ route('profile.mypage') }}" class="btn btn-primary">マイページへ</a></p>
</div>
@endsection
