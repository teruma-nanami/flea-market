@extends('layouts.application')

@section('content')
  <div class="container">
    <h2>ログイン</h2>
    <form action="/login" method="post" class="form">
      @csrf
      <div class="form__inner">
        <div class="form__inner-text">
          <label for="email">メールアドレス
            <input type="text" name="email" placeholder="email"></label>
        </div>
        <div class="form__error">
          @error('email')
            {{ $message }}
          @enderror
        </div>
        <div class="form__inner-text">
          <label for="password">パスワード
            <input type="password" name="password" placeholder="Password"></label>
        </div>
        <div class="form__error">
          @error('password')
            {{ $message }}
          @enderror
        </div>
        <div class="form__inner-check">
          <label for="remember_me">
            <input id="remember_me" type="checkbox" name="remember"><span> ログイン状態を保存する</span>
          </label>
        </div>
        <div class="form__button">
          <button type="submit">ログインする</button>
        </div>
      </div>
    </form>
    <div class="login__link">
      <p>
        <a href="{{ asset('forgot-password') }}">パスワードを忘れてしまった方はこちら</a>
      </p>
      <p>
        <a href="{{ asset('register') }}">会員登録はこちら</a>
      </p>
    </div>
  </div>
@endsection
