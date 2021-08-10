<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>日本の都道府県</title>
</head>
<body>
<?php

$con = mysqli_connect('127.0.0.1', 'root', 'yamaken0407');
if (!$con) {
    exit('データベースに接続できませんでした。');
  }
//（）内の情報でログインできるmysqlに接続し接続IDを取得。接続IDを「＄con」と定義する  
//$conがなければデータベースに接続できませんでした。という文字を表示する

  $result = mysqli_select_db($con,'s');
  if (!$result) {
    exit('データベースを選択できませんでした。');
  }
//上記で定義した接続IDのmysqlから[ｓ]というデータベースを選択し、結果（true,false）を$resultに入れる
//$resultがなければデータベースに接続できませんでした。という文字を表示する
  
$result = mysqli_query($con,'SET NAMES utf8');
if (!$result) {
  exit('文字コードを指定できませんでした。');
}
//文字コードをuft８に設定すし、結果（true,false）を$resultに入れる
//$resultがなければデータベースに接続できませんでした。という文字を表示する

$result = mysqli_query( $con,'SELECT * FROM Nihon');
//Nihonというテーブルからすべての値を指定して、$resultに入れる
//$resultがなければデータベースに接続できませんでした。という文字を表示する
    


?>
</body>
</html>



