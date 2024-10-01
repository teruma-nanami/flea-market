@extends('layouts.app')


@section('css')
  <link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
@endsection

@section('content')
  <div class="container">
    <h2>プロフィール更新</h2>
    <form action="{{ route('profile.update') }}" method="POST" class="form" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <div class="flex__inner">
        <div class="img__inner">
          <img src="{{ auth()->user()->image_url }}" alt="{{ auth()->user()->name }}">
        </div>
        <div class="form__inner-text">
          <input type="file" name="image_url" id="image_url" placeholder="画像を選択する">
        </div>
      </div>

      <div class="form__inner-text">
        <label for="name">名前</label>
        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required>
      </div>

      <div class="form__inner-text">
        <label for="post_code">郵便番号</label>
        <input type="text" name="post_code" id="post_code" value="{{ old('post_code', auth()->user()->post_code) }}"
          required>
      </div>

      <div class="form__inner-text">
        <label for="address">住所</label>
        <input type="text" name="address" id="address" value="{{ old('address', auth()->user()->address) }}"
          required>
      </div>

      <div class="form__inner-text">
        <label for="building">建物名</label>
        <input type="text" name="building" id="building" value="{{ old('building', auth()->user()->building) }}">
      </div>
      <div class="form__button">
        <button type="submit">更新する</button>
      </div>
    </form>
  </div>
@endsection
