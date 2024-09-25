@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>メインページ</h1>
    <div class="tabs">
      <button class="tab-link active" data-tab="all-products">すべての商品</button>
      @auth
        <button class="tab-link" data-tab="favorite-products">お気に入り</button>
      @endauth
    </div>
    <div class="item__inner">
      <div id="all-products" class="tab-pane active">
        <div class="row">
          @foreach ($items as $item)
            <div class="item__card">
              <a href="{{ route('item.show', $item->id) }}" class="btn btn-primary"><img src="{{ $item->image_url }}" class="card-img-top" alt="{{ $item->title }}"></a>
              <h5 class="card-title">{{ $item->title }}</h5>
            </div>
          @endforeach
        </div>
      </div>
      @auth
        <div id="favorite-products" class="tab-pane">
          <div class="row">
            @foreach ($favorites as $item)
            <div class="item__card">
              <a href="{{ route('item.show', $item->id) }}" class="btn btn-primary"><img src="{{ $item->image_url }}" class="card-img-top" alt="{{ $item->title }}"></a>
              <h5 class="card-title">{{ $item->title }}</h5>
            </div>
            @endforeach
          </div>
        </div>
      @endauth
    </div>
  </div>
@endsection
