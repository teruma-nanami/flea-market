@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>マイページ</h1>
    <div class="user-info">
      <img src="{{ auth()->user()->image_url }}" class="img-fluid rounded-circle" alt="{{ auth()->user()->name }}">
      <h2>{{ auth()->user()->name }}</h2>
      <a href="{{ route('profile.show') }}" class="btn btn-primary">プロフィール編集</a>
    </div>
    <div class="tabs">
      <button class="tab-link active" data-tab="my-items">出品した商品</button>
      <button class="tab-link" data-tab="purchased-items">購入した商品</button>
    </div>
    <div class="tab-content">
      <div id="my-items" class="tab-pane active">
        <div class="row">
          @foreach ($myItems as $item)
            <div class="col-md-4">
              <div class="card mb-4">
                <img src="{{ $item->image_url }}" class="card-img-top" alt="{{ $item->title }}">
                <div class="card-body">
                  <h5 class="card-title">{{ $item->title }}</h5>
                  <a href="{{ route('item.show', $item->id) }}" class="btn btn-primary">詳細を見る</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div id="purchased-items" class="tab-pane">
        <div class="row">
          @foreach ($purchasedItems as $item)
            <div class="col-md-4">
              <div class="card mb-4">
                <img src="{{ $item->image_url }}" class="card-img-top" alt="{{ $item->title }}">
                <div class="card-body">
                  <h5 class="card-title">{{ $item->title }}</h5>
                  <a href="{{ route('item.show', $item->id) }}" class="btn btn-primary">詳細を見る</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
