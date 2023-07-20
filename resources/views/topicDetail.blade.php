<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
       <title>おうちのおくすり-投稿詳細</title>
       <link rel="stylesheet" type="text/css" href="{{ asset('css/base.css')}}">
       <meta name="viewport" content="width=device-width,initial-scale=1">
       <meta name="csrf-token" content="{{ csrf_token() }}">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

  <body>
    <!-- ヘッダー　-->
    @include('header')

     @csrf
     @foreach($topics as $topic)
     {{-- <form method="post" action="{{ route('topicDetail') }}" novalidate enctype="multipart/form-data"> --}}
      <div class="confirm">
          <div class="contact-wrapper">
              <h2>投稿詳細</h2>
              <div class="form">
                  <label class="form-exp">
                      一覧に戻りたい場合は戻るを押してください。
                  </label>
                
                  <label class="confirm-item">No</label>
                  <div>{{ $topic->id }}</div>

                  <label class="confirm-item">title</label>
                  <div>{{ $topic->title }}</div>
                  
                  <label class="confirm-item">画像</label>
                  <div class="confirm-pic">
                  <img src="{{ asset('/'.$topic->pic_main) }}" width="200" height="130">

                  {{-- <label class="confirm-item">その他画像1</label> --}}
                  <img src="{{ asset('/'.$topic->pic_sub1) }}" width="200" height="130">

                  {{-- <label class="confirm-item">その他画像2</label> --}}
                  <img src="{{ asset('/'.$topic->pic_sub2) }}" width="200" height="130">
                  </div>

                  <label class="confirm-item">内容</label>
                  <p class="content_confirm">
                      {!! nl2br(e( $topic->content )) !!}
                      {{-- <input name="content" value="{{ $contact->content }}" type="hidden"> --}}
                      {{-- <div>{{ $contact->content }}</div> --}}
                  </p><!-- 入力内容 -->
                  {{-- <div class="list-button">
                    <div class="like-container">
                        <button id="like-button" class="good-button">いいね！ </button>
                        <div class="like-content">
                            <span id="like-count">0</span>
                        </div>
                    </div>
                </div> --}}
                  @endforeach

                  <div class="confirm-btn">
                      <button class="submit_back" id="back" type="button" onClick="history.back()">戻 &nbsp; る</button>
                  </div>
              </div>
    {{-- </form> --}}
  </body>
</html>