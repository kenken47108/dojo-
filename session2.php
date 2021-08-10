
<?php
$ID=$_REQUEST['id'];
$PASSWORD=$_REQUEST ['pass'];
//入力


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


$result = mysqli_query($con,"SELECT * FROM 個人情報 where ID ='$ID'");
foreach($result as $row)

if(!($row["ID"] == $ID)) {
  exit('IDに誤りがあります。');
}

if(!($row["password"] == $PASSWORD)){
exit('passwordに誤りがあります。');
}

//チェック

$result = mysqli_query( $con,"SELECT * FROM 個人情報 where ID ='$ID' and password='$PASSWORD' ");
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
?>

<form action="session3.php" method="post">
    <?php
             echo('password');
?>    
    <input type="text" name="pass2">
    <?php
             echo('name');
?>
    <input type="text" name="name">
     <input type="submit" value="変更">
</form>

　
<?php
session_start();
$_SESSION['id']=$ID;
//出力
?>





