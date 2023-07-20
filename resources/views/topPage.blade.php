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
    @include('header')
   <div class="concept">
      <h1>あなたの大切な家を守る<br>手助けに。</h1>
      <h3>風邪を引いたとき、薬を飲む。<br>そんな特効薬のような存在を目指し、
      <br>このサイトを立ち上げました。</h3>   
  </div> 

  <div class="top-navi">
   <button type="button" name="submit" id="top"><a href="{{ route('topicList') }}">投稿を見る</a></button>
   <button type="button" name="submit" id="top2"><a href="{{ route('contact') }}">お問い合わせはこちら</a></button>
  </div>


 </body>

</html>