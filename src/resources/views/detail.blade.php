@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $item->title }}</h1>
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $item->image_url }}" class="img-fluid" alt="{{ $item->title }}">
        </div>
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item"><strong>商品名:</strong> {{ $item->title }}</li>
                <li class="list-group-item"><strong>説明:</strong> {{ $item->description }}</li>
                <li class="list-group-item"><strong>価格:</strong> ¥{{ number_format($item->price, 2) }}</li>
                <li class="list-group-item"><strong>カテゴリー:</strong> {{ $item->category->name }}</li>
                <li class="list-group-item"><strong>出品者:</strong> {{ $item->user->name }}</li>
                <li class="list-group-item"><strong>郵便番号:</strong> {{ $item->user->post_code }}</li>
                <li class="list-group-item"><strong>住所:</strong> {{ $item->user->address }}</li>
                <li class="list-group-item"><strong>建物名:</strong> {{ $item->user->building }}</li>
                <li class="list-group-item"><strong>出品日時:</strong> {{ $item->created_at }}</li>
                <li class="list-group-item"><strong>更新日時:</strong> {{ $item->updated_at }}</li>
                <li class="list-group-item"><strong>ステータス:</strong> {{ $item->is_sold ? '売却済み' : '販売中' }}</li>
            </ul>
            @if(!$item->is_sold)
                <a href="{{ route('purchase.show', $item->id) }}" class="btn btn-primary mt-3">購入する</a>
            @endif
        </div>
    </div>
</div>
@endsection
