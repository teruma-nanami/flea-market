@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/mypage.css') }}" />
@endsection

@section('content')
  <div class="container">
    <div class="profile__inner flex__inner">
      <img src="{{ auth()->user()->image_url }}" alt="{{ auth()->user()->name }}">
      <p>{{ auth()->user()->name }}</p>
      <p><a href="{{ route('profile.show') }}">プロフィール編集</a></p>
    </div>
    <div class="tab__inner">
      <button class="tab__button active" data-tab="my-items">出品した商品</button>
      <button class="tab__button" data-tab="purchased-items">購入した商品</button>
    </div>
  </div>
  <hr>
  <div class="container">
    <div id="my-items" class="item__inner active">
      @foreach ($myItems as $item)
        <div class="item__card">
          <a href="{{ route('item.show', $item->id) }}"><img src="{{ $item->image_url }}" alt="{{ $item->title }}"></a>
          <p class="card-title">{{ $item->title }}</p>
        </div>
      @endforeach
    </div>
    <div id="purchased-items" class="item__inner">
      @foreach ($purchasedItems as $item)
        <div class="item__card">
          <a href="{{ route('item.show', $item->id) }}"><img src="{{ $item->image_url }}" alt="{{ $item->title }}"></a>
          <p class="card-title">{{ $item->title }}</p>
        </div>
      @endforeach
    </div>
  </div>
@endsection
