@extends('layouts.app')

@section('content')
<div class="container">
    <h1>購入ページ</h1>
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
            </ul>
            <form action="{{ route('purchase.store', $item->id) }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-success">購入を確定する</button>
            </form>
        </div>
    </div>
</div>
@endsection
