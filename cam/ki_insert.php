<?php

if(!isset($_POST["ki_name"])  ||  $_POST["ki_name"]==""){
    exit("ParameError!name!");
    }
    if(!isset($_POST["ki_pl"])  ||  $_POST["ki_pl"]==""){
    exit("ParameError!pltext!");
    }
    if(!isset($_POST["ki_text"])  ||  $_POST["ki_text"]==""){
    exit("ParameError!text!");
    }
    
//1. POSTデータ取得

//まず前のphpからデーターを受け取る（この受け取ったデータをもとにbindValueと結びつけるため）
$ki_name = $_POST["ki_name"];
$ki_pl  = $_POST["ki_pl"];
$ki_text = $_POST["ki_text"];

//2. DB接続します xxxにDB名を入力する
//ここから作成したDBに接続をしてデータを登録します xxxxに作成したデータベース名を書きます
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成 //ここにカラム名を入力する
//xxx_table(テーブル名)はテーブル名を入力します
$stmt = $pdo->prepare("INSERT INTO gs_ki_table(id, ki_name, ki_pl, ki_text,
indate )VALUES(NULL, :ki_name, :ki_pl, :ki_text, sysdate())");

$stmt->bindValue(':ki_name', $ki_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':ki_pl', $ki_pl, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':ki_text', $ki_text, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト 書くときにLocation: in この:　のあとは半角スペースがいるので注意！！
  header("Location: ki.php");
  exit;

}
?>
