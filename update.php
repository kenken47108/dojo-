<?php

$con = mysqli_connect('127.0.0.1', 'root', 'yamaken0407');
if (!$con) {
    exit('データベースに接続できませんでした。');
  }
//（）内の情報でログインできるmysqlに接続しmysqliのクラスを取得。クラスを「＄con」と定義する  
//$conがfalseであればばデータベースに接続できませんでした。という文字を表示する

  $result = mysqli_select_db($con,'s');
  if (!$result) {
    exit('データベースを選択できませんでした。');
  }
//上記で定義した接続IDのmysqlから[ｓ]というデータベースを選択し、結果（true,false）を$resultに入れる
//$resultがfalseであればデータベースに接続できませんでした。という文字を表示する
  
$result = mysqli_query($con,'SET NAMES utf8');
if (!$result) {
  exit('文字コードを指定できませんでした。');
}
//文字コードをuft８に設定し、結果（true,false）を$resultに入れる
//$resultがfalseであればデータベースに接続できませんでした。という文字を表示する


//if (isset ( $_REQUEST ['user'] ))
$kensaku= $_REQUEST ['original'];
$henko=$_REQUEST ['change'];
//kensakuを'user'と定義する。（userはtest5.phpで定義したtext欄その１に入れた値のこと）
//henkoを'change'と定義する。（changeはtest5.phpで定義したtext欄その2に入れた値のこと）


if((preg_match("/^[ぁ-んー]+$/u",$henko))and(preg_match("/^[ぁ-んー]+$/u",$kensaku ))){
 mysqli_query( $con,"update Nihon set yomi='$henko' where yomi='$kensaku' ");
//もしyomiカラムがkensakuと一致するかつhenko,kensakuがひらがなであればnihonのテーブルのyomiカラムをhenkoに変更する。
}else if((preg_match("/^[一-龠]+$/u",$henko ))and(preg_match("/^[一-龠]+$/u",$kensaku ))){
 mysqli_query( $con,"update Nihon set kanji='$henko' where kanji='$kensaku' ");
//もしkanjiカラムがkensakuと一致するかつhenko,kensakuが漢字であればnihonのテーブルのkanjiをhenkoに変更する。
}else if((preg_match("/^[0-9]+$/u",$kensaku ))and(preg_match("/^[0-9]+$/u",$kensaku ))){
{ mysqli_query( $con,"update Nihon set num='$henko' where num='$kensaku' ");}
//numがhenko,kensakuでありかつ、数字であればnumをhenkoにする。
}else 
{exit('入力データが不適切です。');}
//上記以外であれば「入力データが不適切です」と表示する。

$result = mysqli_query( $con,"SELECT * FROM Nihon where kanji='$henko' or num='$henko' or yomi='$henko'");
//kanjiがhenkoもしくはnumがhenkoもしくはyomiがhenkoの行について。resultにnihonのテーブルからとった要素を入れる。


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




