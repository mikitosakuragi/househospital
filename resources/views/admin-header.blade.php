<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/home.js') }}"></script>
    <script src="https://kit.fontawesome.com/e6ec3a2baa.js" crossorigin="anonymous"></script>
  </head>

  <header>
    <div class="header-nav">
      <div class="header-logo">
        <a href="{{ route('admin') }}"><img src="{{asset('img/おうちのおくすり-logos_white.png')}}"></a>
      </div>
 
      <div class="menu1">
        <nav>
          <ul>
            <li class="menu-font"><a href="{{ route('adminTopic') }}">新規投稿</a></li>
            <li class="menu-font"><a href="{{ route('adminTopicList') }}">投稿編集</a></li>
            <li class="menu-font"><a href="{{ route('adminContact') }}">お問合せ一覧</a></li>
            <li class="menu-font"><a href="{{ route('adminLogout') }}">ログアウト</a></li>
          </ul>
        </nav>
      </div>

      <div class="user_id">{{ Auth::user()->name }}</div>

      <div class="humburger">
        <img class="humburger-btn" src="{{ asset('img/menu.png')}}">
      </div>

      <nav class="menu02">
        <ul>
          <li><a href="">{{ Auth::user()->name }}</a></li>
          <li><a href="{{ route('adminTopic') }}">新規投稿</a></li>
          <li><a href="{{ route('adminTopicList') }}">投稿編集</a></li>
          <li><a href="{{ route('adminContact') }}">お問合せ</a></li>
          <li><a href="{{ route('logout') }}">ログアウト</a></li>
        </ul>
      </nav> 

    </div>
  </header>

</html>