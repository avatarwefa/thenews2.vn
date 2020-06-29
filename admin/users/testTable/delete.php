<?php  
 $connect = mysqli_connect("localhost", "root", "", "thenews");  
 $sql = "DELETE FROM users WHERE idUser = '".$_POST["idUser"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Xoá dữ liệu';  
 }  
 ?>