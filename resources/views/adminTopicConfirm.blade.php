<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
       <title>おうちのおくすり-投稿確認</title>
       <link rel="stylesheet" type="text/css" href="{{ asset('css/base.css')}}">
       <meta name="viewport" content="width=device-width,initial-scale=1">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <!-- ヘッダー　-->
    @include('admin-header')

    <form method="post" action="{{ route('adminTopicComplete') }}">
      @csrf
      <div class="confirm">
          <div class="contact-wrapper">
              <h2>お問い合わせ</h2>
              <div class="form">
                  <label class="form-exp" >
                      下記の内容をご確認の上送信ボタンを押してください。<br>
                      内容を訂正する場合は戻るを押してください。
                  </label>
                  <label class="confirm-item">氏名</label>
                  {{ $inputs['name'] }}
                  <input name="name" value="{{ $inputs['name'] }}" type="hidden">

                  <label class="confirm-item">タイトル</label>
                  {{ $inputs['title'] }}
                  <input name="title" value="{{ $inputs['title'] }}" type="hidden">

                  <label class="confirm-item">メイン画像</label>
                  <img src="{{ $data['read_main_path'] }}" width="200" height="130">
                  {{-- <img src="{{ $data['main_path'] }}"> --}}
                  {{-- <input name="pic_main" value="{{ $inputs['pic_main'] }}" type="hidden"> --}}
                  <input name="pic_main" value="{{ $data['read_main_path'] }}" type="hidden">

                  <label class="confirm-item">その他画像1</label>
                  <img src="{{ $data['read_sub1_path'] }}" width="200" height="130">
                  {{-- <input name="pic_sub1" value="{{ $inputs['pic_sub1'] }}" type="hidden"> --}}
                  <input name="pic_sub1" value="{{ $data['read_sub1_path'] }}" type="hidden">

                  <label class="confirm-item">その他画像2</label>
                  <img src="{{ $data['read_sub2_path'] }}" width="200" height="130">
                  {{-- <input name="pic_sub2" value="{{ $inputs['pic_sub2'] }}" type="hidden"> --}}
                  <input name="pic_sub2" value="{{ $data['read_sub2_path'] }}" type="hidden">

                  <label class="confirm-item">お問い合わせ内容</label>
                  <p class="content_confirm">
                      {!! nl2br(e( $inputs['content'] )) !!}
                      <input name="content" value="{{ $inputs['content'] }}" type="hidden">
                  </p><!-- 入力内容 -->

                  <div class="confirm-btn">
                      <button class="send-confirm" id="send-confirm" type="submit" name="action" value="send">送 &nbsp; 信</button>
                      <button class="submit_back" id="back" type="submit" name="action" value="back">戻 &nbsp; る</button>
                  </div>
              </div>
  </form>
  </body>
</html>