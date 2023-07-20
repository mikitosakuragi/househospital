<!DOCTYPE html>
<html>
 <head>
 <meta charset="UTF-8">
    <title>おうちのおくすり</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base.css')}}">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 </head>

 {{-- @extends('layouts.app') --}}

 <body>
    <!-- ヘッダー　-->
    @include('admin-header')
    <div class="database-wrapper"> 
      <div class="database">お問合せ一覧</div>
      <table class="database-table">
        <tr>
          <th>ID</th>
          <th>氏名</th>
          <th>フリガナ</th>
          <th>電話番号</th>
          <th>メールアドレス</th>
          <th>連絡希望方法</th>
          <th>タイトル</th>
          <th>画像1枚目</th>
          <th>画像2枚目</th>
          <th>画像3枚目</th>
          <th>お問い合わせ内容</th>
          <th>送信日時</th>
          <th>詳細</th>
          <th>完了</th>
        </tr>
        @foreach($contacts as $contact)
        <tr>
          <td>{{ $contact->id }}</td>
          <td>{{ $contact->name }}</td>
          <td>{{ $contact->kana }}</td>
          <td>{{ $contact->tel }}</td>
          <td>{{ $contact->email }}</td>
          <td>{{ $contact->contactway }}</td>
          <td>{{ $contact->title }}</td>
          {{-- <td>{{ $contact->pic_main }}</td> --}}
          <td><img class="top-house" src="{{ asset('/'.$contact->pic_main) }}"></td>
          <td><img class="top-house" src="{{ asset('/'.$contact->pic_sub1) }}"></td>
          <td><img class="top-house" src="{{ asset('/'.$contact->pic_sub2) }}"></td>
          <td>{{ $contact->content }}</td>
          <td>{{ $contact->created_at }}</td>
          {{-- <td><a href="/adminContactDetail/?id={{ $contact->id }}">詳細</a></td>  --}}
          <td><a href="{{ route('adminContactDetail',['id'=>$contact->id]) }}">詳細</a></td>
          <td><a href="{{ route('adminContactDelete', ['id'=>$contact->id]) }}" type='submit' name='id' value="{{ $contact->id }}" onclick="return confirm('削除してよろしいですか？')">削除</a></td>
        </tr>
        @endforeach

      </table>
    </div>

    <form method="post" action="{{ route('export') }}" novalidate enctype="multipart/form-data">
      @csrf
      <div>
        <button type="submit" id="excel" class="btn btn-primary">
        問合せデータを出力する
        </button>
    </div>

    </form>



 </body>

</html>