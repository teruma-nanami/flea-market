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
          <form action="{{ route('favorite.toggle', $item->id) }}" method="POST">
            @csrf
            <div class="favorite__icon" data-item-id="{{ $item->id }}">
                <img src="/img/star-icon.png" alt="お気に入り" class="favorite-icon">
                <p>{{ $item->favorites->count() }}</p>
            </div>
        </form>
          <div class="comment__icon">
            <img src="/img/comment-icon.png" alt="">
            <p>{{ $item->comments->count() }}</p>
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
        <div class="comment__section">
          <h3>コメント({{ $item->comments->count() }})</h3>
          <div class="comment__inner">
            @foreach ($item->comments as $comment)
              <div class="comment__text flex__inner">
                <div class="comment__image">
                  <img src="{{ $comment->user->image_url }}" alt="{{ $comment->user->name }}">
                </div>
                <p>{{ $comment->user->name }}</p>
              </div>
              <p class="comment__content">{{ $comment->content }}</p>
            @endforeach
          </div>
          <form action="{{ route('comments.store', $item->id) }}" method="POST" class="form">
            @csrf
            <p>商品へのコメント</p>
            <div class="form__inner-text">
              <textarea name="content" rows="8" required></textarea>
              <button type="submit">コメントを送信する</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
@endsection
