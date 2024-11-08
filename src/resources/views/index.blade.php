@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
  <div class="container">
    <div class="tab__inner">
      <button class="tab__button active" data-tab="all-products">おすすめ</button>
      @auth
        <button class="tab__button" data-tab="favorite-products">マイリスト</button>
      @endauth
    </div>
  </div>
  <hr>
  <div class="container">
    <div id="all-products" class="item__inner active">
      @if ($query)
        @if ($items->isEmpty())
          <p>結果が見つかりませんでした。</p>
        @else
          @foreach ($items as $item)
            <div class="item__card">
              <a href="{{ route('item.show', $item->id) }}"><img src="{{ $item->image_url }}"
                  alt="{{ $item->title }}"></a>
              <p>{{ $item->title }}</p>
              @if ($item->is_sold)
                <div class="item__sold"><span>SOLD</span></div>
              @endif
            </div>
          @endforeach
        @endif
      @else
        @foreach ($items as $item)
          <div class="item__card">
            <a href="{{ route('item.show', $item->id) }}"><img src="{{ $item->image_url }}" alt="{{ $item->title }}"></a>
            <p>{{ $item->title }}</p>
            @if ($item->is_sold)
              <div class="item__sold"><span>SOLD</span></div>
            @endif
          </div>
        @endforeach
      @endif
    </div>
    @auth
      <div id="favorite-products" class="item__inner">
        @if ($query)
          @if ($favorites->isEmpty())
            <p>結果が見つかりませんでした。</p>
          @else
            @foreach ($favorites as $item)
              <div class="item__card"> <a href="{{ route('item.show', $item->id) }}"><img src="{{ $item->image_url }}"
                    alt="{{ $item->title }}"></a>
                <p>{{ $item->title }}</p>
                @if ($item->is_sold)
                  <div class="item__sold"><span>SOLD</span></div>
                @endif
              </div>
            @endforeach
          @endif
        @else
          @foreach ($favorites as $item)
            <div class="item__card">
              <a href="{{ route('item.show', $item->id) }}"><img src="{{ $item->image_url }}"
                  alt="{{ $item->title }}"></a>
              <p>{{ $item->title }}</p>
              @if ($item->is_sold)
                <div class="item__sold"><span>SOLD</span></div>
              @endif
            </div>
          @endforeach
        @endif
      </div>
    @endauth
  </div>
@endsection
