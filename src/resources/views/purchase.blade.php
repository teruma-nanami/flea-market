@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/purchase.css') }}" />
@endsection

@section('content')
  <div class="container flex__inner">
    <div class="__inner">
      <div class="item__inner flex__inner">
        <div class="img__inner">
          <img src="{{ $item->image_url }}" class="img-fluid" alt="{{ $item->title }}">
        </div>
        <div class="desc__inner">
          <p class="">商品名: {{ $item->title }}</p>
          <p class="">価格: ¥{{ number_format($item->price, 2) }}</p>
        </div>
      </div>
      <div class="item__inner">
				<p>支払い方法</p>
        <form action="{{ route('purchase.store', $item->id) }}" method="POST" class="mt-3">
          @csrf
          <div class="form__text">
            <select name="payment_method" id="payment_method" required>
              <option value="convenience_store">コンビニ払い</option>
              <option value="credit_card">クレジットカード払い</option>
            </select>
          </div>
        </form>
      </div>
      <div class="item__inner">
        <p>配送先</p>
        <p>{{ auth()->user()->post_code }}</p>
        <p>{{ auth()->user()->address }}</p>
        <p>{{ auth()->user()->building }}</p>
        <a href="{{ route('address.edit', ['id' => $item->id]) }}">配送先変更</a>
      </div>
    </div>
    <div class="__inner">
      <p>金額: ¥{{ number_format($item->price, 2) }}</p>
      <p>支払い方法: {{ session('payment_method', '未選択') }}</p>
			<form action="{{ route('purchase.store', $item->id) }}" method="POST" class="form">
				@csrf
				<button type="submit" class="">購入を確定する</button>
			</form>
    </div>
  </div>
@endsection
