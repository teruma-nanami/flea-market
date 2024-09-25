@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>商品出品</h1>
    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label for="image_url">商品画像</label>
        <input type="file" name="image_url" id="image_url" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="name">商品名</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
      </div>

      <div class="form-group">
        <label for="categories">カテゴリー</label>
        <select name="categories[]" id="categories" class="form-control" multiple required>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="condition">商品の状態</label>
        <select name="condition" id="condition" class="form-control" required>
          <option value="new">新品</option>
          <option value="used">中古</option>
        </select>
      </div>

      <div class="form-group">
        <label for="price">価格</label>
        <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
      </div>

      <div class="form-group">
        <label for="description">商品の説明</label>
        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
      </div>

      <button type="submit" class="btn btn-primary">出品する</button>
    </form>
  </div>
@endsection
