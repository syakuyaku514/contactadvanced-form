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

        @if (request()->is('/'))
            <div class="header-search">
              <form action="/search" method="GET">
                <select name="area">
                  <option value="">All area</option>
                  <option value="area1">大阪府</option>
                  <option value="area2">東京都</option>
                  <option value="area3">福岡県</option>
                </select>
                <select name="genre">
                  <option value="">All genre</option>
                  <option value="genre1">イタリアン</option>
                  <option value="genre2">ラーメン</option>
                  <option value="genre3">居酒屋</option>
                  <option value="genre3">寿司</option>
                  <option value="genre3">焼肉</option>
                </select>
                <div>
                  <img src="{{ asset('img/magnifying-glass.png')}}" alt="虫眼鏡" class="heart">
                  <input type="text" name="keyword" placeholder="Search...">
                </div>
                <button type="submit">Search</button>
              </form>
            </div>
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