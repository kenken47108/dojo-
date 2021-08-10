<?php

$con = mysqli_connect('127.0.0.1', 'root', 'yamaken0407');
if (!$con) {
    exit('データベースに接続できませんでした。');
  }
//（）内の情報でログインできるmysqlに接続しmysqliのクラスを取得。クラスを「＄con」と定義する  
//$conがfalse値であればデータベースに接続できませんでした。という文字を表示する

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


$suji= $_REQUEST ['bango'];
$character= $_REQUEST ['todohuken'];
$kana= $_REQUEST ['yomigana'];
//

if((preg_match("/^[ぁ-んー]+$/u",$kana))and(preg_match("/^[0-9]+$/u",$suji ))and((preg_match("/^[一-龠]+$/u",$character ))))
mysqli_query( $con, "insert into nihon(num,kanji,yomi)
values($suji,'$character','$kana')");
//kanaがひらがなかつsujiが数字かつtodohukenが漢字であればnum,kanji,yomiカラムにsuji,character,kanaの値を入れる。
else
{exit('入力データが不適切です。');}
//上記以外の条件であれば「入力データが不適切です」と表示する。


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




