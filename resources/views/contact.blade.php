<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
       <title>おうちのおくすり-お問合せ</title>
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
        <h2>お問合せ</h2>
        <div class="form">
          <h3>下記の項目をご記入の上送信ボタンを押してください</h3>

          <form method="post" action="{{ route('confirm') }}" novalidate enctype="multipart/form-data">
            @csrf
            <p>
              <label class="form-exp">送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。<br>
                なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。<br>
                <span>*</span>は必須項目となります。<br>
              </label>
            </p>

            <label class="form-item">氏名<span>*</span></label>
            @if($errors->has('name'))
            <span>{{ $errors->first('name') }}</span>
            @endif
            <input type="text" name="name" value="{{ $formInputs['name'] ?? '' }}" placeholder="山田太郎" class="item-text" required>

            <label class="form-item">フリガナ<span>*</span></label>
            @if($errors->has('kana'))
            <span>{{ $errors->first('kana') }}</span>
            @endif
            <input type="text" name="kana" value="{{ $formInputs['kana'] ?? '' }}" placeholder="ヤマダタロウ" class="item-text" required>

            <label class="form-item">電話番号</label>
            @if ($errors->has('tel'))
            <span>{{ $errors->first('tel') }}</span>
            @endif
            <input type="tel" name="tel" value="{{ $formInputs['tel'] ?? '' }}" placeholder="09012345678" class="item-text">

            <label class="form-item">メールアドレス<span>*</span></label>
            @if ($errors->has('email'))
            <span>{{ $errors->first('email') }}</span>
            @endif
            <input type="email" name="email" value="{{ $formInputs['email'] ?? '' }}" placeholder="test@test.co.jp" class="item-text" required>

            <label class="form-item">希望連絡方法<span>*</span></label>
            @if ($errors->has('contactway'))
            <span>{{ $errors->first('contactway') }}</span>
            @endif
            <select name="contactway" class="item-choice" value="{{ $formInputs['contactway'] ?? '' }}">
              <option value="希望なし">選択してください</option>
              <option value="電話" @if(old('contactway')==='電話') selected @endif>電話</option>
              <option value="メール" @if(old('contactway')==='メール') selected @endif>メール</option>
            </select>

            {{--  --}}

            <label class="form-item">タイトル<span>*</span></label>
            @if ($errors->has('title'))
            <span>{{ $errors->first('title') }}</span>
            @endif
            <input type="text" name="title" value="{{ $formInputs['title'] ?? '' }}" placeholder="タイトルを入力してください" class="item-text" required>

            <label class="form-item">画像1枚目<span>*</span></label>
            @if ($errors->has('pic_main'))
            <span>{{ $errors->first('pic_main') }}</span>
            @endif
            {{-- <img src="{{asset('storage/contactPic').$pic_main->image}}" alt=""> --}}
            {{--  <img src=" {{ $data['read_main_path'] }}" width=25%> --}}
            <input type="file" name="pic_main" value="{{ old('pic_main') }}" placeholder="" class="item-pic" required>
 
            <label class="form-item">画像2枚目<span>*</span></label>
            @if ($errors->has('pic_sub1'))
            <span>{{ $errors->first('pic_sub1') }}</span>
            @endif
            {{-- <img src=" {{ $data['read_sub1_path'] }}" width=25%> --}}
            <input type="file" name="pic_sub1" value="{{ old('pic_sub1') }}" placeholder="" class="item-pic" required>

            <label class="form-item">画像3枚目<span>*</span> </label>
            @if ($errors->has('pic_sub2'))
            <span>{{ $errors->first('pic_sub2') }}</span>
            @endif
            {{-- <img src=" {{ $data['read_sub2_path'] }}" width=25%> --}}
            <input type="file" name="pic_sub2" value="{{ old('pic_sub2') }}" placeholder="" class="item-pic" required>

            <h3>お問い合わせ内容をご記入ください<span>*</span></h3>
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