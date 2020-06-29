<?php  
 $connect = mysqli_connect("localhost", "root", "", "thenews");

 $idUser = $_POST["idUser"];
 $text = $_POST["text"];  
 $column_name = $_POST["column_name"];  
 $sql = "UPDATE users SET ".$column_name."='".$text."' WHERE idUser='".$idUser."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Update dữ liệu';  
 }  
 ?>