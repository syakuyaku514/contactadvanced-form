<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rese</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <div class="header-utilities">
      
        <div class="hamburger-menu">
          <input type="checkbox" id="menu-btn-check">
          <label for="menu-btn-check" class="menu-btn"><span></span></label>
          <!--ここからメニュー-->
          <div class="menu-content">
            <nav>
              <ul class="header-nav">

                @if (Auth::check())
                @auth
                  <li class="header-nav__item">
                    <a class="header-nav__link" href="/">Home</a>
                  </li>
                  <li class="header-nav__item">
                    <form class="form" action="/logout" method="post">
                    @csrf
                      <button class="header-nav__button">Logout</button>
                    </form>
                  </li>
                  <li class="header-nav__item">
                    <a class="header-nav__link" href="/mypage">Mypage</a>
                  </li>
                @endauth
                @endif

                @guest
                <li class="header-nav__item">
                    <a class="header-nav__link" href="/">Home</a>
                  </li>

                <div class="header-nav__item">
                  <a class="header-nav__link" href="/register">Registration</a>
                </div>
  
                <div class="header-nav__item">
                  <a class="header-nav__link" href="/login">Login</a>
                </div>
                @endguest

              </ul>
            </nav>
          </div>
          <!--ここまでメニュー-->
        <a class="header__logo" href="/">
          Rese
        </a>

        @if (Auth::check())
        @auth
           <li class="header-nav__item">
              <Serach class="">All area</Serach>
            </li>
            <li class="header-nav__item">
              <Serach class="">All genre</Serach>
            </li>
            <li class="header-nav__item">
              <Serach class="">Serach...</Serach>
            </li>
        @endauth
        @endif
      </div>

        
        
      </div>
    </div>
  </header>

  <main class="appmain">
    @yield('content')
  </main>
</body>

</html>