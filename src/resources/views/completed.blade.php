@extends('layouts.app')

@section('content')
<div class="container">
    <h1>出品が完了しました。</h1>
    <p>商品が正常に出品されました。マイページで詳細を確認できます。</p>
    <a href="{{ route('profile.mypage') }}" class="btn btn-primary">マイページへ</a>
</div>
@endsection
