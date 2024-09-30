@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
  <div class="tab__container">
    <div class="tab__inner">
      <button class="tab__button active" data-tab="all-products">すべての商品</button>
      @auth
        <button class="tab__button" data-tab="favorite-products">お気に入り</button>
      @endauth
    </div>
  </div>
  <div class="container">
    <div id="all-products" class="item__inner active">
      @foreach ($items as $item)
        <div class="item__card">
          <a href="{{ route('item.show', $item->id) }}"><img src="{{ $item->image_url }}" alt="{{ $item->title }}"></a>
          <p class="card-title">{{ $item->title }}</p>
        </div>
      @endforeach
    </div>
    @auth
      <div id="favorite-products" class="item__inner">
        @foreach ($favorites as $item)
          <div class="item__card">
            <a href="{{ route('item.show', $item->id) }}"><img src="{{ $item->image_url }}" alt="{{ $item->title }}"></a>
            <p class="card-title">{{ $item->title }}</p>
          </div>
        @endforeach
      </div>
    @endauth
  </div>
  </div>
@endsection
