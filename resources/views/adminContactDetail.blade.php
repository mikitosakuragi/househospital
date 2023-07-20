<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
       <title>おうちのおくすり-お問合せ詳細</title>
       <link rel="stylesheet" type="text/css" href="{{ asset('css/base.css')}}">
       <meta name="viewport" content="width=device-width,initial-scale=1">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <!-- ヘッダー　-->
    @include('admin-header')

     @csrf
     @foreach($contacts as $contact)
     <form method="post" action="{{ route('adminContactDetail') }}" novalidate enctype="multipart/form-data">
      <div class="confirm">
          <div class="contact-wrapper">
              <h2>お問い合わせ詳細 - 問合せID:{{ $contact->id }} -</h2>
              <div class="form">
                  <label class="form-exp">
                      一覧に戻りたい場合は戻るを押してください。
                  </label>
                
                  <label class="confirm-item">問合せID</label>
                  {{-- {{ $inputs['id'] }} --}}
                  <div>{{ $contact->id }}</div>
                
                  <label class="confirm-item">氏名</label>
                  <div>{{ $contact->name }}</div>

                  <label class="confirm-item">フリガナ</label>
                  <div>{{ $contact->kana }}</div>

                  <label class="confirm-item">電話番号</label>
                  <div>{{ $contact->tel }}</div>

                  <label class="confirm-item">メールアドレス</label>
                  <div>{{ $contact->email }}</div>

                  <label class="confirm-item">希望連絡方法</label>
                  <div>{{ $contact->contactway }}</div>

                  <label class="confirm-item">タイトル</label>
                  <div>{{ $contact->title }}</div>

                  <label class="confirm-item">画像1枚目</label>
                  <img src="{{ asset('/'.$contact->pic_main) }}" width="500" height="300">

                  <label class="confirm-item">画像2枚目</label>
                  <img src="{{ asset('/'.$contact->pic_sub1) }}" width="500" height="300">

                  <label class="confirm-item">画像3枚目</label>
                  <img src="{{ asset('/'.$contact->pic_sub2) }}" width="500" height="300">

                  <label class="confirm-item">お問い合わせ内容</label>
                  <p class="content_confirm">
                      {!! nl2br(e( $contact->content )) !!}
                      {{-- <input name="content" value="{{ $contact->content }}" type="hidden"> --}}
                      {{-- <div>{{ $contact->content }}</div> --}}
                  </p><!-- 入力内容 -->
                  @endforeach

                  <div class="confirm-btn">
                      {{-- <button class="send-confirm" id="send-confirm" type="submit" name="action" value="send">送 &nbsp; 信</button> --}}
                      {{-- <button class="submit_back" id="back" type="submit" name="action" value="back">戻 &nbsp; る</button> --}}
                      {{-- <button class="submit_back" id="back" type="button" name="action" value="back">戻 &nbsp; る</button> --}}
                      <button class="submit_back" id="back" type="button" onClick="history.back()">戻 &nbsp; る</button>
                  </div>
              </div>
    </form>
  </body>
</html>