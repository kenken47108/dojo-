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
//文字コードをuft８に設定し、結果（true,false）を$resultに入れる
//$resultがなければデータベースに接続できませんでした。という文字を表示する


//if (isset ( $_REQUEST ['user'] ))
$kensaku= $_REQUEST ['user'];
//kensakuを'user'と定義する。（userはtest4.phpで定義したtext欄に入れた値のこと）

$result = mysqli_query( $con,"SELECT * FROM Nihon where kanji='$kensaku' or num='$kensaku' or yomi='$kensaku' ");
//resultに上記でログインしたデータベースの中のnihonのテーブルからkanji列=kensaku,num列=kensaku,yomi列=kensakuのいずれかの条件を満たす行の値すべてを格納する。
?>


<table border='1'>
<tr>
<th>ナンバー</th>
<th>都道府県名</th>
<th>フリガナ</th>
</tr>


<?php
foreach($result as $row){
//resultに格納されているデータを一つずつrowに入れて処理する
?>
    <tr>
    <td><?php echo $row['num']; 
    //rowに格納されたnum行を表示する
    ?></td>
    <td><?php echo $row['kanji']; 
    //rowに格納されたkanji行を表示
    ?></td>
    <td><?php echo $row['yomi']; 
    //rowに格納されたyomi行を表示する
    ?></td>
  
    </tr>    

    <?php
}
?>




