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
        <p>ブランド</p>
        <p>¥{{ number_format($item->price, 0) }}(税込)</p>
        <div class="count__inner flex__inner">
          <div class="favorite__icon">
            <img src="/img/star-icon.png" alt="">
            <p>5</p>
          </div>
          <div class="comment__icon">
            <img src="/img/comment-icon.png" alt="">
            <p>5</p>
          </div>
        </div>
        @if (!$item->is_sold)
          <p class="buy__button--stock"><a href="{{ route('purchase.show', $item->id) }}" class="">購入手続きへ</a></p>
        @else
          <p class="buy__button--sold">購入されました</p>
        @endif
        <h3>商品説明</h3>
        <p>{{ $item->description }}</p>
        <h3>商品の情報</h3>
        <table>
          <tbody>
            <tr>
              <th>カテゴリー</th>
              <td class="category__table-text">{{ $item->category->name }}</td>
            </tr>
            <tr>
              <th>商品の状態</th>
              <td>{{ $item->status }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
