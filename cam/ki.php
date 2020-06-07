<?php
//1.  DB接続します xxxにDB名を入れます
try {
// mampの場合は注意です！違います！別途後ほど確認します！
$pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
//作ったテーブル名を書く場所  xxxにテーブル名を入れます pdoデータスに接続します
$stmt = $pdo->prepare("SELECT * FROM gs_ki_table ORDER BY id DESC");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる $resultの中に「カラム名」が入ってくるのでそれを表示させる例
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    // $view .= "<p>";
    // $view .= $result["id"].":".$result["booktext"];
    // $view .= "</p>";
    // GETデータ送信リンク作成
$view .='<p class="container">';
$view .='<a href="ki_view.php?id='.$result["id"].'">';
$view .= $result["indate"].":"."名前".$result["ki_name"];
$view .='<br>';
$view .='場所'.":".$result["ki_pl"];
$view .='</br>';
$view .='<br>';
$view .='紹介'.":".$result["ki_text"];
$view .='</br>';
$view .='</a>';
$view .='<br>';
$view .='</br>';
$view .='</p>';


  }

}
?>



<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <title>saketoate</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <!--header-->
    <header class="header">
      <!-- main visual -->
      <div class="main-visual">
        <h1 class="site-title">
          サケトアテタノシミタイ
          <span class="site-title__sub"
            >お気に入りのお酒と肴が見つかるサイト</span
          >
        </h1>
        
        <img src="image/top/sake03.png" alt="肴の画像" />
      </div>

      <div class="header-above">
        <div class="wrapper header-inner">
          <p class="logo logo-header">
            <a href="logout.php">ログアウト</a>
            <a href="newlog.php">マイページ</a>
            <!-- <a href="#"
              ><img
                src="images/header/header_logo.png"
                alt="Cheese Academy Tokyo"
            /></a> -->
          </p>
          <button class="btn btn-mobileMenu">Menu</button>
          <nav class="nav-outer">
            <ul class="nav clearfix">
              <li class="nav-item"><a href="#about">サケトアテタノシミタイとは？</a></li>
              <li class="nav-item"><a href="#course">活</a></li>
              <li class="nav-item"><a href="#news">マガジン</a></li>
              <li class="nav-item"><a href="#access">アクセス</a></li>
              <li class="nav-item"><a href="#contact">コンタクト</a></li>
              <li class="nav-item"><a href="ki.php">投稿</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </header>
    <!--//header-->
<!-- コメントフォーム -->
<div class="wrapper">
<div class="form-list">
    <form  method="post"  action="ki_insert.php" class=form>
    <dl class="form-item">  
<dt class="form-label">名前</dt>
<dd><input type="text" name="ki_name" placeholder="お名前" class="form-parts"></dd>
</dl>
<dl class="form-item"> 
<dt class="form-label">場所</dt>
<dd><input type="text" name="ki_pl" placeholder="自宅、店名" class="form-parts"></dd>
</dl>
<dl class="form-item form-item__textarea"> 
<dt class="form-label">コメント</dt>
<dd><textarea name="ki_text" id="" cols="30" rows="10" 
class="form-parts form-parts__textarea">お酒や食べ物について紹介</textarea></dd>
</dl>

<ul>
    <li>
        <input type="submit" id=btn-update vlue="登録" class="btn btn-submit">
        <a href="select.php" class="btn_m btn-submit">戻る</a>
    </li>
</ul>
</form>
</div>
</div>

<div class="wrapper">
    <div class="container "><?=$view?></div>

    </div>

<!--footer-->
<footer class="footer text-center">
      <div class="wrapper">
        <small class="copyrights"
          >copyrights 2016 Cheeese Academy Tokyo All RIghts Reserved.
        </small>
      </div>
    </footer>
    <!--// footer-->
    <!-- jqueryを使う時はここでCDNを読み込みます（必ず先に読み込む） -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- ここにjsを読み込みます -->
    <script src="js/app.js"></script>
  </body>
</html>