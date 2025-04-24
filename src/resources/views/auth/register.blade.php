@extends('layouts.application')

@section('content')
  <div class="container">
    <h2>会員登録</h2>
    <form action="/register" method="post" class="form">
      @csrf
      <div class="form__inner">
        <div class="form__inner-text">
          <label for="name">ユーザー名
            <input type="text" name="name" placeholder="Username" value="{{ old('name') }}"></label>
        </div>
        <div class="form__error">
          @error('name')
            {{ $message }}
          @enderror
        </div>
        <div class="form__inner-text">
          <label for="email">メールアドレス
            <input type="text" name="email" placeholder="email" value="{{ old('email') }}"></label>
        </div>
        <div class="form__error">
          @error('email')
            {{ $message }}
          @enderror
        </div>
        <div class="form__inner-text">
          <label for="password">パスワード
            <input type="password" name="password" placeholder="password"></label>
        </div>
        <div class="form__error">
          @error('password')
            {{ $message }}
          @enderror
        </div>
        <div class="form__inner-text">
          <label for="password_confirmation">確認用パスワード
            <input type="password" name="password_confirmation" placeholder="password_confirmation"></label>
        </div>
        <div class="form__button">
          <button type="submit">登録する</button>
        </div>
      </div>
    </form>
    <div class="login__link">
      <p><a href="{{ asset('login') }}">ログインはこちら</a></p>
    </div>
  </div>
@endsection
