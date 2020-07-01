<?php 

require "../../lib/dbCon.php";
require "../../lib/trangchu.php";
$connect = MyConnect();
ob_start();
session_start();
 $sql = "DELETE FROM users WHERE idUser = '".$_POST["idUser"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Xoá dữ liệu';  
 }  
 ?>