<!DOCTYPE html>
<html lang="ja">
  <head>
    <!-- リセットCSS -->
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- flatpickrのCDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- flatpickrの月選択プラグイン -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/style.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@latest/dist/plugins/monthSelect/index.js"></script>
    <!-- flatpickrの日本語化追加スクリプト -->
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
    <!-- flatpickrのブルーテーマ追加スタイルシート -->
    <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
    <title>BokiPass</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
  </head>
  <body>
    <h1>合格体験記編集ページ</h1>
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
    <!-- 合格体験記再入力フォーム -->
    <form action="{{route('edit', ['post_id' => $post->id])}}" method="post">
      @csrf
      <div>
        <label for="pass_class">何級に合格しましたか？</label><br>
        <input type="radio" name="pass_class" id="pass_class" value="１" {{old('pass_class',$post->pass_class) == "１" ? 'checked' : ''}} checked>１級
        <input type="radio" name="pass_class" id="pass_class" value="２" {{old('pass_class',$post->pass_class) == "２" ? 'checked' : ''}}>２級
        <input type="radio" name="pass_class" id="pass_class" value="３" {{old('pass_class',$post->pass_class) == "３" ? 'checked' : ''}}>３級
        <input type="radio" name="pass_class" id="pass_class" value="初" {{old('pass_class',$post->pass_class) == "初" ? 'checked' : ''}}>初級
      </div>
      <div>
        <label for="pass_date">いつ合格しましたか？</label><br>
        <input type="text" name="pass_date" id="pass_date" value="{{old('pass_date',$post->pass_date)}}">
      </div>
      <div>
        <label for="test_style">どの試験方式でしたか？</label><br>
        <input type="radio" name="test_style" id="test_style" value="筆記試験" {{old('test_style',$post->test_style) == "筆記試験" ? 'checked' : ''}} checked>筆記試験
        <input type="radio" name="test_style" id="test_style" value="ネット試験" {{old('test_style',$post->test_style) == "ネット試験" ? 'checked' : ''}} >ネット試験
      </div>
      <div>
        <label for="nunber_times">受験回数は何回ですか？</label><br>
        <select name="nunber_times" id="nunber_times">
          <option value="１回" selected @if(old('nunber_times',$post->nunber_times)=='１回') selected  @endif>１回</option>
          <option value="２回" @if(old('nunber_times',$post->nunber_times)=='２回') selected  @endif>２回</option>
          <option value="３回" @if(old('nunber_times',$post->nunber_times)=='３回') selected  @endif>３回</option>
          <option value="４回" @if(old('nunber_times',$post->nunber_times)=='４回') selected  @endif>４回</option>
          <option value="５回以上" @if(old('nunber_times',$post->nunber_times)=='５回以上') selected  @endif>５回以上</option>
        </select>
      </div>
      <div>
        <label for="study_period">勉強期間(時間)はどれくらいでしたか？</label><br>
        <textarea name="study_period" id="study_period" cols="50" rows="5"placeholder="記載例：何ヶ月間や合計何時間など。平日は何時間で休日は何時間など。">{{old('study_period',$post->study_period)}}</textarea>
        <small class="form-text text-muted">191文字まで</small>
      </div><br>
      <div>
        <label for="study_method">どのような勉強法でしたか？</label><br>
        <textarea name="study_method" id="study_method" cols="50" rows="5" placeholder="記載例：独学or通信講座or通学？通信講座や通学ならスクール名など。その他具体的な勉強法。">{{old('study_method',$post->study_method)}}</textarea>
        <small class="form-text text-muted">191文字まで</small>
      </div><br>
      <div>
        <label for="books_used">使用した教材は何ですか？</label><br>
        <textarea name="books_used" id="books_used" cols="50" rows="5" placeholder="記載例：教材やWebサービスの名前。それらの特徴など。">{{old('books_used',$post->books_used)}}</textarea>
        <small class="form-text text-muted">191文字まで</small>
      </div><br>
      <div>
        <label for="advice">合格の秘訣や受験生へアドバイスをお願いします。</label><br>
        <textarea name="advice" id="advice" cols="50" rows="5" placeholder="記載例：おすすめの学習方法や受験上の注意点など。">{{old('advice',$post->advice)}}</textarea>
        <small class="form-text text-muted">191文字まで</small>
      </div><br>
      <button type="submit" onClick="return double()">更新</button>
    </form>
    <a href="{{route('show', ['post_id' => $post->id])}}">戻る</a>
    <script>
      'use strict';
      // 合格年月をどのブラウザでも統一できるようにflatpickrを導入
      flatpickr(document.getElementById('pass_date'), {
        plugins: [
          new monthSelectPlugin({
            dateFormat: "20y年m月",
          })
        ],
        locale: 'ja',
        maxDate: "today"
      });
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