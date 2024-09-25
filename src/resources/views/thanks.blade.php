@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ご購入いただきありがとうございます。</h1>
    <p>購入が確定しました。マイページで詳細を確認できます。</p>
    <a href="{{ route('profile.mypage') }}" class="btn btn-primary">マイページへ</a>
</div>
@endsection
