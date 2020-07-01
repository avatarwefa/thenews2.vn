<?php  

require "../../lib/dbCon.php";
require "../../lib/trangchu.php";
$connect = MyConnect();
ob_start();
session_start();
  
$sql = "INSERT INTO users(HoTen,Username,Password,Email,idGroup) VALUES('".$_POST["HoTen"]."', '".$_POST["Username"]."','".md5($_POST["Password"])."','".$_POST["Email"]."','".$_POST["idGroup"]."')";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Thêm dữ liệu';  
 }  
 ?> 