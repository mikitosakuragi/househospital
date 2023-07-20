<!DOCTYPE html>
<html>
 <head>
 <meta charset="UTF-8">
    <title>おうちのおくすり</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base.css')}}">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{-- <script src="{{ asset('js/topiclike.js') }}"></script> --}}
    <script src="{{ asset('js/_ajaxlike.js') }}"></script>
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"> --}}
 </head>

 {{-- @extends('layouts.app') --}}

 <script>
   document.addEventListener('DOMContentLoaded', () => {
       const likeButton = document.getElementById('like-button');
       const likeCount = document.getElementById('like-count');
       let count = 0;
       likeButton.addEventListener('click', () => {
           count++;
           likeCount.textContent = count;
       });
   });
   </script>


 <body>
    <!-- ヘッダー　-->
    @include('header')
    @csrf
    <div class="topic-list">
    {{-- <form method="post" action="{{ route('topicList') }}" novalidate enctype="multipart/form-data"> --}}
     <div class="confirm">
         <div class="contact-wrapper">
             <h2>投稿一覧</h2>
             <div class="form">
                 <label class="form-exp">
                     一覧に戻りたい場合は戻るを押してください。
                 </label>
                 <table class="database-table1">
                    <tr>
                      <th>タイトル</th>
                      <th>メイン画像</th>
                      <th>詳細</th>
                      {{-- <th>いいね</th>
                      <th>数</th> --}}
                      <th>登録日時</th>
                    </tr>
                    @foreach($topics as $topic)
                   
                    <tr>
                      <td>{{ $topic->title }}</td>
                      <td><img class="top-house" src="{{ asset('/'.$topic->pic_main) }}"></td>
                     <td><a href="{{ route('topicDetail',['id'=>$topic->id]) }}">詳細</a></td>
                      {{-- <td><button id="like-button" class="good-button" onclick="like({{$topic->id}})">いいね！ </button></td>
                        <td><div class="like-content"><span id="like-count">0</span>
                        </div></td> --}}
                        {{-- @if($topic->likes()->where('user_id', Auth::user()->id)->count() == 1)
                           <a href="{{ route('unlike', $topic) }}" class="btn btn-success btn-sm">
                              いいねを消す
                              <span class="badge">{{ $topic->likes->count() }}</span>
                           </a>
                        @else
                           <a href="{{ route('like', $topic) }}" class="btn btn-secondary btn-sm">
                              いいねをつける
                              <span class="badge">{{ $topic->likes->count() }}</span>
                           </a>
                        @endif  --}}
                        {{-- <div class="list-button">
                           <div class="like-container">
                              <button id="like-button" class="good-button">いいね </button>
                              <div class="like-content">
                                    <span id="like-count">0</span>
                                    <p>人</p>
                              </div>
                           </div> --}}
                      <td>{{ $topic->created_at }}</td>
                    </tr>
                    {{-- <table class="house-list">
                     <thead class="top-img">
                         <th></th>
                         <tr>
                             <td class="table-text1"><!-- トップ画像 -->
                                 <div><img class="top-house" src="{{ asset('/'.$topic->pic_main) }}"></div>
                             </td>
                         </tr>
                     </thead>
                 <tbody>
                         <tr>
                             <td class="list-title">タイトル</td>
                             <td class="table-text2">
                                 <div>{{ $topic->title }}</div>
                             </td>
                         </tr>
                         <tr>
                             <td class="list-title">登録日時</td>
                             <td class="table-text3"><!-- 間取り -->
                                 <div>{{ $topic->created_at }}</div>
                             </td>
                         </tr>
                     </tbody>
                  </table>
                  <div class="list-button">
                     <div class="like-container">
                        <button id="like-button" class="good-button">いいね </button>
                        <div class="like-content">
                              <span id="like-count">0</span>
                              <p>人</p>
                        </div>
                     </div>
                     <div class="detail-button">
                        <a class="detail-button" href="{{ route('topicDetail',['id'=>$topic->id]) }}">詳細を見る</a>
                     </div>
                  </div> --}}
                    @endforeach
                 </table>
            

                 <div class="confirm-btn">
                    <button class="submit_back" id="back" type="button" onClick="history.back()">戻 &nbsp; る</button>
                 </div>
             </div>
             
   {{-- </form> --}}
      </div>   


 </body>

</html>