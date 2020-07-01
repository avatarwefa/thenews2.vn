<?php  
require "../../lib/dbCon.php";
require "../../lib/trangchu.php";
$connect = MyConnect();
ob_start();
session_start();

 $idUser = $_POST["idUser"];
 $text = $_POST["text"];  
 $column_name = $_POST["column_name"];
 // if ($column_name = 'Password')
 // {
 // 	$text = md5($text);
 // }  
 $sql = "UPDATE users SET ".$column_name."='".$text."' WHERE idUser='".$idUser."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Update dữ liệu';  
 }  
?>