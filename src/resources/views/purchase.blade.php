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
          <h2>{{ $item->title }}</h2>
          <p>¥{{ number_format($item->price, 0) }}(税込)</p>
        </div>
      </div>
      <div class="item__inner">
        <h3>支払い方法</h3>
        <form action="{{ route('purchase.store', $item->id) }}" method="POST">
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
        <h3>配送先</h3>
        <p>{{ auth()->user()->post_code }}</p>
        <p>{{ auth()->user()->address }}</p>
        <p>{{ auth()->user()->building }}</p>
        <a href="{{ route('address.edit', ['id' => $item->id]) }}">配送先変更</a>
      </div>
    </div>
    <div class="buy__inner">
      <table>
        <tr>
          <th>金額</th>
          <td>¥{{ number_format($item->price, 0) }}</td>
        </tr>
        <tr>
          <th>支払い方法</th>
          <td>コンビニ払い</td>
        </tr>
      </table>
      <form action="{{ route('purchase.store', $item->id) }}" method="POST" class="form">
        @csrf
        <button type="submit" class="form__button">購入する</button>
      </form>
    </div>
  </div>
@endsection
