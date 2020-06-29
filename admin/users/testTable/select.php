<?php  
 $connect = mysqli_connect("localhost", "root", "", "thenews");  
 $output = '';  
 $sql = "SELECT * FROM users ORDER BY idUser DESC";  
 $result = mysqli_query($connect, $sql);  
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">  
                <tr>  
                     <th width="5%">idUser</th>
                     <th width="20%">Họ Tên</th>
                     <th width="20%">Username</th> 
                     <th width="20%">Password</th> 
                     <th width="20%">Email</th>  
                     <th width="5%">idGroup</th>  
                     <th width="10%">Delete</th>  
                </tr>';  
 if(mysqli_num_rows($result) > 0)  
 {  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td>'.$row["idUser"].'</td>  
                     <td class="HoTen" data-id1="'.$row["idUser"].'" contenteditable>'.$row["HoTen"].'</td>  
                     <td class="Username" data-id2="'.$row["idUser"].'" contenteditable>'.$row["Username"].'</td>  
                     <td class="Password" data-id3="'.$row["idUser"].'" contenteditable>'.$row["Password"].'</td>  
                     <td class="Email" data-id4="'.$row["idUser"].'" contenteditable>'.$row["Email"].'</td>  
                     <td class="idGroup" data-id5="'.$row["idUser"].'" contenteditable>'.$row["idGroup"].'</td>  
                     <td><button type="button" name="delete_btn" data-id6="'.$row["idUser"].'" class="btn btn-xs btn-danger btn_delete">Delete</button></td>  
                </tr>  
           ';  
      }  
      $output .= '  
           <tr>  
                <td></td>  
                <td id="HoTen" contenteditable></td> 
                <td id="Username" contenteditable></td>
                <td id="Password" contenteditable></td>
                <td id="Email" contenteditable></td>
                <td id="idGroup" contenteditable></td>  
                <td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">Add</button></td>  
           </tr>  
      ';  
 }  
 else  
 {  
      $output .= '<tr>  
                          <td colspan="4">Data not Found</td>  
                     </tr>';  
 }  
 $output .= '</table>  
      </div>';  
 echo $output;  
 ?>