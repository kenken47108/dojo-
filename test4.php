<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>アドレス帳</title>
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
//文字コードをuft８に設定し、結果（true,false）を$resultに入れる
//$resultがなければデータベースに接続できませんでした。という文字を表示する

$result = mysqli_query( $con,'SELECT * FROM Nihon order by num 
');
//Nihonというテーブルからすべての値を指定して、$resultに入れる
//$resultがなければデータベースに接続できませんでした。という文字を表示する

$row_count = $result->num_rows;
//レコード件数 結果の中からレコードの行数を抽出しrow_countと定義


while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$rows[] = $row;
}
//連想配列で取得　行数が結果の中から取り出した連想配列である限り、配列	$rows[]の中に$rowの値を格納する

$result->free();
//結果セットを解放

?>
</body>
</html>


<html>
<head>
<title>日本都道府県表</title>
<meta charset="utf-8">
</head>
<body>

レコード件数：<?php echo $row_count; ?>

<table border='1'>
<tr>
<th>ナンバー</th>
<th>都道府県名</th>
<th>フリガナ</th>
</tr>

<?php
foreach($rows as $row){
?>

<tr>
  <td><?php echo $row['num']; ?></td>
  <td><?php echo $row['kanji']; ?></td>
  <td><?php echo $row['yomi']; ?></td>

  </tr>

 

<?php
}
?>

<form action="kensaku.php" method="post">
    <input type="text" name="user"> <input type="submit" value="確定">
</form>





<!--
<form action="test4.php" method=get>
    <div class="search-box">
        <span class="search-box_label">種類:</span>
        <input type="text" name="text" value="1">
        <input type="submit">
       
    </div>
 
    </form>
 -->


</table>

</body>
</html>



















