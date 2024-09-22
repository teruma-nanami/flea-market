<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  @yield('css')
  <title>Rese</title>
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <h1>
        <a href="/" class="header__logo">Rese</a>
      </h1>
      <button class="header__sp" id="menuButton">
        <span class="sp-only">Menu</span>
      </button>
      <div class="header__nav" id="navMenu">
        <button class="header__close" id="closeButton">&times;</button>
        <ul>
          <li><a href="{{ asset('login') }}">Login</a></li>
          <li><a href="{{ asset('register') }}">Registration</a></li>
          <li><a href="{{ asset('forgot-password') }}">Reset</a></li>
        </ul>
      </div>
    </div>
  </header>
  <main>
    @yield('content')
  </main>
  <footer class="footer">
    <div class="footer__inner">Rese, inc.</div>
  </footer>
  <script src="{{ asset('js/humberger.js') }}"></script>
</body>

</html>
