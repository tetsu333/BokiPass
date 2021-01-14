<!DOCTYPE html>
<html lang="ja">
  <head>
    <!-- リセットCSS -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>BokiPass</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
  </head>
  <body>
    <h1>合格体験記詳細ページ</h1>
    <!-- 入力エラーがある場合は表示 -->
    @if($errors->any())
      <div>
        <ul>
          @foreach($errors->all() as $message)
            <li style="color:red;">{{ $message }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <!-- ゲストかユーザーかをチェックし、合格体験記を投稿した本人(ユーザー)のみ編集・削除が可能 -->
    @guest
      @else
        @if(auth()->user()->id == $post->user_id)
          <form action="{{route('edit', ['post_id' => $post->id])}}" method="get">
            @csrf
            <button type="submit" onClick="return double()">編集</button>
          </form>

          <form action="{{route('delete', ['post_id' => $post->id])}}" method="post">
            @csrf
            <button type="submit" id="deletebtn" onClick="return check()">削除</button>
          </form>
        @endif
    @endguest
    <!-- 合格体験記詳細を表示 -->
    <h2>合格体験記 No{{$post->id}}</h2>
    <h2>日商簿記検定{{$post->pass_class}}級合格</h2>
    <p style="font-weight:  bold;">投稿者</p>
    <p>{{$post->user_name}}さん(id:{{$post->user_id}})</p>
    <p style="font-weight:  bold;">合格年月</p>
    <p>{{$post->pass_date}}</p>
    <p style="font-weight:  bold;">受験方式</p>
    <p>{{$post->test_style}}</p>
    <p style="font-weight:  bold;">受験回数</p>
    <p>{{$post->nunber_times}}</p>
    <p style="font-weight:  bold;">勉強期間（時間）</p>
    <p>{{$post->study_period}}</p>
    <p style="font-weight:  bold;">勉強法</p>
    <p>{{$post->study_method}}</p>
    <p style="font-weight:  bold;">使用した教材</p>
    <p>{{$post->books_used}}</p>
    <p style="font-weight:  bold;">合格した秘訣や受験生へのアドバイス</p>
    <p>{{$post->advice}}</p>
    <p style="font-weight:  bold;">投稿日</p>
    <p>{{$post->created_at->format('Y.m.d')}}</p>
    <p style="font-weight:  bold;">コメント</p>
    <!-- ゲストかユーザーかをチェックし、ユーザーならコメントが可能 -->
    @guest
        <div>
          <p>ログインするとコメントができます。</p>
          <a href="{{ route('login') }}">ログイン</a>
          <a href="{{ route('register') }}">新規登録</a>
        </div>
      @else
        <form action="{{route('commentCreate', ['post_id' => $post->id])}}" method="post">
          @csrf
          <div>
            <textarea name="body" cols="40" rows="5" placeholder="ここにコメントを書いてください">{{old('body')}}</textarea>
          </div>
          <button type="submit" onClick="return double()">コメントする</button>
        </form>
    @endguest
    <!-- 全てのコメントを表示・ゲストかユーザーかをチェックし、コメントした本人(ユーザー)のみ削除が可能 -->
    @foreach($comments as $comment)
      <div style="border:1px solid black; display:inline-block; width:300px;">
          <p>id:{{$comment->user_id}} {{$comment->user_name}}　{{$comment->created_at->format('Y.m.d H:i')}}</p>
          <p>{{$comment->body}}</p>
        @guest
          @else
            @if(auth()->user()->id == $comment->user_id)
              <form action="{{route('commentDelete', ['post_id' => $post->id])}}" method="post">
                @csrf
                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                <button type="submit" onClick="return check()">削除</button>
              </form>
            @endif
        @endguest
      </div>
      <br>
    @endforeach
    <a href="{{route('timeline')}}">戻る</a>
    <script>
      'use strict'; 
      //削除ボタンを押すと再確認する。
      function check(){
        if(confirm('本当に削除しますか？')){ // 確認ダイアログを表示
          return true; // 「OK」時は削除を実行
        }else{
          alert('キャンセルされました'); // 警告ダイアログを表示
          return false; // 「キャンセル」時は削除を中止
        }
      }
      //クリック連打防止
      var set=0; //クリック数を判断するための変数を定義
      function double() {
        if(set==0){
          set=1;  //１クリック目は変数setに１を代入するだけ
        } else {
          alert("只今処理中です。\nそのままお待ちください。"); //２クリック目はアラートを表示
          return false; //２クリック目は中止
        }
      }
    </script>
  </body>
</html>