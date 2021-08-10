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
$kesu= $_REQUEST ['sakujo'];
//kesuにsakujoを代入

if(preg_match("/^[ぁ-んー]+$/u",$kesu )){
 mysqli_query( $con,"delete from Nihon  where yomi='$kesu' ");
//kesuがひらがなであれば日本の表を消す。yomiがkesuの行については
}else if(preg_match("/^[一-龠]+$/u",$kesu )){
 mysqli_query( $con,"delete from Nihon  where kanji='$kesu' ");
//kesuが漢字であれば日本の表を消す。kanjiがkesuの行については
}else if(preg_match("/^[0-9]+$/u",$kesu )){
{ mysqli_query( $con,"delete from Nihon where num='$kesu' ");}
//それ以外であれば日本の表を消す。numがkesuであれば
}else
{exit('入力データが不適切です。');}
//上記以外であれば「入力データが不適切です」と表示する。




$result = mysqli_query( $con,"SELECT * FROM Nihon");
//resultにnihonの表からとったすべてを格納する

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
    //rowに格納されたnum列を表示する
    ?></td>
    <td><?php echo $row['kanji']; 
    //rowに格納されたkanji列を表示
    ?></td>
    <td><?php echo $row['yomi']; 
    //rowに格納されたyomi列を表示する
    ?></td>
  
    </tr>    

    <?php
}
?>




