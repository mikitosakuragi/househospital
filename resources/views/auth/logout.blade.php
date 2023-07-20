{{-- <div>
  <h1>ログアウト画面です。</h1>
</div>

<div>
  <nav>
      <ul>
          <li><a href="{{ route('login') }}">ログインはこちら</a></li>
      </ul>
  </nav>
</div> --}}

<!DOCTYPE html>
<html>

<head>
    <title>送信完了</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/home.js') }}"></script>
    <script src="https://kit.fontawesome.com/e6ec3a2baa.js" crossorigin="anonymous"></script>
</head>

<!-- ヘッダー　-->
<div class="contact-header">
    @include('header-login')
</div>

<!-- 問い合わせフォーム　-->
<div class="contact">
    <div class="contact-wrapper">
        <h2>ログアウト完了</h2>
        <div class="form">
            <p class="form-exp">
                ご利用いただきありがとうございました。<br>
                またのご利用をお待ちしております。
            </p>
            <a href="{{ route('login') }}">ログイン画面へ戻る</a>
        </div>
    </div>
</div>
</form>