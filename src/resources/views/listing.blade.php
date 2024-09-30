@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/listing.css') }}" />
@endsection

@section('content')
  <div class="container">
    <h2>商品の出品</h2>
    <form action="{{ route('items.store') }}" method="POST" class="form" enctype="multipart/form-data">
      @csrf

      <div class="form__inner-text">
        <p>商品画像</p>
        <input type="file" name="image_url" required>
      </div>
      {{-- <div class="form__inner-text">
        <p>カテゴリー</p>
        <select name="categories[]" id="categories"  multiple size="{{ count($categories) }}" required>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div> --}}
      <h3>商品の詳細</h3>
      <div class="form__inner-text">
        <p>カテゴリー</p>
        <div class="category__container">
          @foreach ($categories as $category)
            <div class="category__item">
              <input type="checkbox" name="categories[]" value="{{ $category->id }}" id="category_{{ $category->id }}" class="category__checkbox">
              <label for="category_{{ $category->id }}">{{ $category->name }}</label>
            </div>
          @endforeach
        </div>
      </div>
      <div class="form__inner-text">
        <p>商品の状態</p>
        <select name="status" id="status"  required>
          <option value="">状態を選択してください</option>
          <option value="新品">新品</option>
          <option value="未使用に近い">未使用に近い</option>
          <option value="目立った汚れなし">目立った汚れなし</option>
          <option value="傷や汚れあり">傷や汚れあり</option>
          <option value="状態が悪い">状態が悪い</option>
        </select>
      </div>

      <h3>商品名と説明</h3>

      <div class="form__inner-text">
        <p>商品名</p>
        <input type="text" name="name" id="name"  value="{{ old('name') }}" required>
      </div>


      <div class="form__inner-text">
        <p>商品の説明</p>
        <textarea name="description" id="description" >{{ old('description') }}</textarea>
      </div>


      <div class="form__inner-text">
        <p>価格</p>
        <input type="text" name="price" id="price"  value="{{ old('price') }}" required>
      </div>

      <div class="form__button">
      <button type="submit">出品する</button>
    </div>
    </form>
  </div>
@endsection
