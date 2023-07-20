<!DOCTYPE html>
<html>

<head>
    <title>編集画面</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/base.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/home.js') }}"></script>
    <script src="https://kit.fontawesome.com/e6ec3a2baa.js" crossorigin="anonymous"></script>
</head>

<!-- ヘッダー　-->
<div class="contact-header">
  @include('admin-header')
</div>

<!-- 編集画面 -->
<div class="edit">
    <div class="edit-wrapper">
        <h2>編集</h2>
        <div class="edit-form">
          @foreach($topics as $topic)
            <form method="post" action="{{ route('adminTopicEditComplete',['id'=>$topic->id]) }}" enctype="multipart/form-data" novalidate>
                @csrf
                <p class="form-text">編集完了後、更新ボタンを押してください。</p>

                <label class="edit-item">氏名<span>*</span></label>
                @if ($errors->has('name'))
                <span>{{$errors->first('name')}}</span>
                @endif
                <input type="text" class="edit-text" name="name" value="{{ old('name', $topic->name) }}" required>

                <label class="edit-item">タイトル<span>*</span></label>
                @if ($errors->has('title'))
                <span>{{$errors->first('title')}}</span>
                @endif
                <input type="text" class="edit-text" name="title" value="{{ old('title', $topic->title) }}" required>

                {{-- <label class="form-item">メイン画像</label>
                @if ($errors->has('pic_main'))
                <span>{{ $errors->first('pic_main') }}</span>
                @endif
                @if($topic->pic_main !== '')
                <img src="{{ asset('/'.$topic->pic_main) }}"  width="200" height="130">
                @endif
                <input type="file" class="edit-text" name="pic_main" value="{{ old('pic_main') }}" required>

                <label class="form-item">サブ画像1</label>
                @if ($errors->has('pic_sub1'))
                <span>{{ $errors->first('pic_sub1') }}</span>
                @endif
                @if($topic->pic_sub1 !== '')
                <img src="{{ asset('/'.$topic->pic_sub1) }}"  width="200" height="130">
                @endif
                <input type="file" class="edit-text" name="pic_sub1" value="{{ old('pic_sub1') }}" required>

                <label class="form-item">サブ画像2</label>
                @if ($errors->has('pic_sub2'))
                <span>{{ $errors->first('pic_sub2') }}</span>
                @endif
                @if($topic->pic_sub2 !== '')
                <img src="{{ asset('/'.$topic->pic_sub2) }}"  width="200" height="130">
                @endif
                <input type="file" class="edit-text" name="pic_sub2" value="{{ old('pic_sub2') }}" required> --}}



                <label class="edit-item">お問い合わせ内容<span>*</span></label>
                @if ($errors->has('content'))
                <span>{{$errors->first('content')}}</span>
                @endif
                <textarea class="edit-text__body" name="content">{{ old('content', $topic->content) }}</textarea>
                <input type="hidden" name="id" value="@empty(old('id')){{ $topic->id }}@else{{ old('id') }}@endempty">
                @endforeach
                <input type="submit" id="submit" name="" value="更 新">
            </form>
        </div>
    </div>
</div>