<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
       <title>おうちのおくすり-投稿</title>
       <link rel="stylesheet" type="text/css" href="{{ asset('css/base.css')}}">
       <meta name="viewport" content="width=device-width,initial-scale=1">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

    

    <body>
    {{-- <div>
      <h1>問合せ画面です。</h1>
    </div> --}}

    <!-- ヘッダー　-->
    @include('header')

    <div class="contact">
      <div class="contact-wrapper">
        <h2>投稿</h2>
        <div class="form">
          <h3>下記の項目をご記入の上送信ボタンを押してください</h3>

          <form method="post" action="{{ route('confirm') }}" novalidate enctype="multipart/form-data">
            @csrf
            <p>
              <label class="form-exp">
                <span>*</span>は必須項目となります。<br>
              </label>
            </p>

            <label class="form-item">氏名<span>*</span></label>
            @if($errors->has('name'))
            <span>{{ $errors->first('name') }}</span>
            @endif
            <input type="text" name="name" value="{{ $formInputs['name'] ?? '' }}" placeholder="山田太郎" class="item-text" required>

            <label class="form-item">タイトル<span>*</span></label>
            @if ($errors->has('title'))
            <span>{{ $errors->first('title') }}</span>
            @endif
            <input type="text" name="title" value="{{ $formInputs['title'] ?? '' }}" placeholder="タイトルを入力してください" class="item-text" required>

            <label class="form-item">メイン画像</label>
            @if ($errors->has('pic_main'))
            <span>{{ $errors->first('pic_main') }}</span>
            @endif
            {{-- <img src="{{asset('storage/contactPic').$pic_main->image}}" alt=""> --}}
            {{--  <img src=" {{ $data['read_main_path'] }}" width=25%> --}}
            <input type="file" name="pic_main" value="{{ old('pic_main') }}" placeholder="" class="item-pic" required>
 
            <label class="form-item">その他画像1</label>
            @if ($errors->has('pic_sub1'))
            <span>{{ $errors->first('pic_sub1') }}</span>
            @endif
            {{-- <img src=" {{ $data['read_sub1_path'] }}" width=25%> --}}
            <input type="file" name="pic_sub1" value="{{ old('pic_sub1') }}" placeholder="" class="item-pic" required>

            <label class="form-item">その他画像2</label>
            @if ($errors->has('pic_sub2'))
            <span>{{ $errors->first('pic_sub2') }}</span>
            @endif
            {{-- <img src=" {{ $data['read_sub2_path'] }}" width=25%> --}}
            <input type="file" name="pic_sub2" value="{{ old('pic_sub2') }}" placeholder="" class="item-pic" required>

            <h3>内容をご記入ください<span>*</span></h3>
            @if ($errors->has('content'))
            <span>{{ $errors->first('content') }}</span>
            @endif
            <textarea type="text" name="content" id="content" required>{{ $formInputs['content'] ?? '' }}</textarea>

            <button type="submit" name="submit" id="submit">送 &nbsp; 信</button>

          </form>

        </div>

      </div>

    </div>

  
   </body>
</html>