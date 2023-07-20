<!DOCTYPE html>
<html>
 <head>
 <meta charset="UTF-8">
    <title>おうちのおくすり-投稿編集-</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base.css')}}">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 </head>

 {{-- @extends('layouts.app') --}}

 <body>
    <!-- ヘッダー　-->
    @include('admin-header')
    <div class="database-wrapper"> 
      <div class="database">投稿編集</div>
      <table class="database-table">
        <tr>
          <th>ID</th>
          <th>氏名</th>
          <th>タイトル</th>
          <th>メイン画像</th>
          <th>サブ画像1</th>
          <th>サブ画像2</th>
          <th>お問い合わせ内容</th>
          <th>送信日時</th>
          <th>編集</th>
          <th>完了</th>
        </tr>
        @foreach($topics as $topic)
        <tr>
          <td>{{ $topic->id }}</td>
          <td>{{ $topic->name }}</td>
          <td>{{ $topic->title }}</td>
          {{-- <td>{{ $contact->pic_main }}</td> --}}
          <td><img class="top-house" src="{{ asset('/'.$topic->pic_main) }}"></td>
          <td><img class="top-house" src="{{ asset('/'.$topic->pic_sub1) }}"></td>
          <td><img class="top-house" src="{{ asset('/'.$topic->pic_sub2) }}"></td>
          <td>{{ $topic->content }}</td>
          <td>{{ $topic->created_at }}</td>
          {{-- <td><a href="/adminContactDetail/?id={{ $topic->id }}">詳細</a></td>  --}}
          <td><a href="{{ route('adminTopicEdit',['id'=>$topic->id]) }}">編集</a></td>
          <td><a href="{{ route('adminTopicDelete', ['id'=>$topic->id]) }}" type='submit' name='id' value="{{ $topic->id }}" onclick="return confirm('削除してよろしいですか？')">削除</a></td>
        </tr>
        @endforeach

      </table>
    </div>



 </body>

</html>