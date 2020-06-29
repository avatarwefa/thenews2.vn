<?php  

 $connect = mysqli_connect("localhost", "root", "", "thenews");  
  
echo $sql = "INSERT INTO users(HoTen,Username,Password,Email,idGroup) VALUES('".$_POST["HoTen"]."', '".$_POST["Username"]."','".md5($_POST["Password"])."','".$_POST["Email"]."','".$_POST["idGroup"]."')";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Thêm dữ liệu';  
 }  
 ?> 