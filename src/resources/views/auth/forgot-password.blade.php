@extends('layouts.application')

@section('content')
  <div class="container">
    <h2>パスワード再設定</h2>
    <form method="POST" action="{{ route('password.email') }}" class="form">
      @csrf
      <div class="form__inner">
        <p>パスワードを忘れてしまった場合、メールアドレスを入力してください。</p>
        <div class="form__inner-text">
          <label for="email">メールアドレス</label>
          <input id="email" type="email" name="email" placeholder="email" required autofocus>
        </div>
        <div class="form__button">
          <button type="submit">送信</button>
        </div>
      </div>
    </form>
    <div class="login__link">
      <p>
        <a href="{{ asset('login') }}">ログインはこちら</a>
      </p>
      <p>
        <a href="{{ asset('register') }}">会員登録はこちら</a>
      </p>
    </div>
  </div>
@endsection
