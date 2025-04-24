@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/thanks.css') }}" />
@endsection

@section('content')
<div class="container">
    <h1>出品が完了しました</h1>
    <p>商品が正常に出品されました。マイページで詳細を確認できます。</p>
    <p><a href="{{ route('profile.mypage') }}" class="btn btn-primary">マイページへ</a></p>
</div>
@endsection
