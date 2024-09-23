@extends('layouts.app')

@section('content')
  <div class="container">
    <h2>プロフィール更新</h2>
    <form action="{{ route('profile.update') }}" method="POST" class="form" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <div class="form__text">
        <label for="name">名前</label>
        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required>
      </div>

      <div class="form__text">
        <label for="post_code">郵便番号</label>
        <input type="text" name="post_code" id="post_code" value="{{ old('post_code', auth()->user()->post_code) }}"
          required>
      </div>

      <div class="form__text">
        <label for="address">住所</label>
        <input type="text" name="address" id="address" value="{{ old('address', auth()->user()->address) }}"
          required>
      </div>

      <div class="form__text">
        <label for="building">建物名</label>
        <input type="text" name="building" id="building" value="{{ old('building', auth()->user()->building) }}">
      </div>

      <div class="form__text">
        <label for="image_url">プロフィール画像</label>
        <input type="file" name="image_url" id="image_url">
      </div>

      <button type="submit" class="form__button">更新</button>
    </form>
  </div>
@endsection
