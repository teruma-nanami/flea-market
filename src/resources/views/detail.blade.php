@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('content')
  <div class="container">
    <div class="flex__inner">
      <div class="img__inner">
        <img src="{{ $item->image_url }}" alt="{{ $item->title }}">
      </div>
      <div class="desc__inner">
        <h2>{{ $item->title }}</h2>
        <h3 class="list-group-item"><strong>価格:</strong> ¥{{ number_format($item->price, 2) }}</h3>
        @if (!$item->is_sold)
          <p class="buy__button--stock"><a href="{{ route('purchase.show', $item->id) }}" class="">購入手続きへ</a></p>
        @else
          <p class="buy__button--sold">購入されました</p>
        @endif
        <h3>商品説明</h3>
        <p class="list-group-item"><strong>説明:</strong> {{ $item->description }}</p>
        <h3>商品の情報</h3>
        <p class="list-group-item">カテゴリー: {{ $item->category->name }}</p>
        <p class="list-group-item">商品の状態: {{ $item->status }}</p>
      </div>
    </div>
  </div>
  </div>
@endsection
