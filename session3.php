<?php
$NAME= $_REQUEST ['name'];
$PASS2= $_REQUEST ['pass2'];


session_start();
//入力





//チェック


$con = mysqli_connect('127.0.0.1', 'root', 'yamaken0407');
if (!$con) {
  exit('データベースに接続できませんでした。');
}

$result = mysqli_select_db($con,'s');
if (!$result) {
  exit('データベースを選択できませんでした。');
}
  
$result = mysqli_query($con,'SET NAMES utf8');
if (!$result) {
  exit('文字コードを指定できませんでした。');
}

mysqli_query($con,"update 個人情報 set name='".$NAME."' where ID='".$_SESSION['id']."'");
mysqli_query($con,"update 個人情報 set password='".$PASS2."' where ID='".$_SESSION['id']."'");

$result = mysqli_query($con,"SELECT * FROM 個人情報 where ID='".$_SESSION['id']."'");

//処理



?>
<table border='1'>
<tr>
<th>ID</th>
<th>パスワード</th>
<th>名前</th>
</tr>


<?php
foreach($result as $row){
?>
    <tr>
    <td><?php echo $row['ID']; 
    ?></td>
    <td><?php echo $row['password']; 
    ?></td>
    <td><?php echo $row['name']; 
    ?></td>
  
    </tr>    

    <?php
}
//出力
?>

<form action="session1.php" method="post">
    <?php
             echo('ログアウト');
?>    
    <input type="submit">

   <?php
    session_destroy();
    ?>