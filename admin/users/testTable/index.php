<html>  
      <head>  
           <title>Live Table Data Edit</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      </head>  
      <body>  
           <div class="container">  
                <br />  
                <br />  
                <br />  
                <div class="table-responsive">  
                     <h3 align="center">AJAX DATA TABLE</h3><br />
                     <p align="center"> Username Table Admin!</p>  
                     <div id="live_data"></div>                 
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      function fetch_data()  
      {  
           $.ajax({  
                url:"select.php",  
                method:"POST",  
                success:function(data){  
                     $('#live_data').html(data);  
                }  
           });  
      }  
      fetch_data();  
      $(document).on('click', '#btn_add', function(){  
           var HoTen = $('#HoTen').text();  
           var Username = $('#Username').text();  
           var Password = $('#Username').text();  
           var Email = $('#Email').text(); 
           var idGroup = $('#idGroup').text(); 
            
           // if(HoTen == '' || HoTen.length <2 || HoTen.length > 40)  
           // {  
           //      alert("Enter name with range of 5-40 characters");  
           //      return false;  
           // }  
           // if(idGroup == '' || isNaN(year))  
           // {  
           //      alert("Enter idGroup in NUMBER ");  
           //      return false;  
           // }  
           $.ajax({  
                url:"insert.php",  
                method:"POST",  
                data:{HoTen:HoTen, Username:Username,Password:Password,Email:Email,idGroup:idGroup},  
                dataType:"text",  
                success:function(data)  
                {  
                     alert(data);  
                     fetch_data();  
                }  
           })  
      });  
      function edit_data(idUser, text, column_name)  
      {  
           $.ajax({  
                url:"edit.php",  
                method:"POST",  
                data:{idUser:idUser, text:text, column_name:column_name},  
                dataType:"text",  
                success:function(data){  
                     alert(data);  
                }  
           });  
      }  
      $(document).on('blur', '.HoTen', function(){  
           var idUser = $(this).data("id1");  
           var HoTen = $(this).text(); 

           edit_data(idUser, HoTen, "HoTen");  
      });  
      $(document).on('blur', '.Username', function(){  
           var idUser = $(this).data("id2");  
           var Username = $(this).text();  
           edit_data(idUser, Username, "Username");  
      });  
      $(document).on('blur', '.Password', function(){  
           var idUser = $(this).data("id3");  
           var Password = $(this).text();  
           edit_data(idUser, Password, "Password");  
      }); 
      $(document).on('blur', '.Email', function(){  
           var idUser = $(this).data("id4");  
           var Email = $(this).text();  
           edit_data(idUser, Email, "Email");  
      }); 
      $(document).on('blur', '.idGroup', function(){  
           var idUser = $(this).data("id5");  
           var idGroup = $(this).text();  
           edit_data(id,idGroup, "idGroup");  
      });  
      $(document).on('click', '.btn_delete', function(){  
           var idUser=$(this).data("id6");  
           if(confirm("Bạn muốn xoá hàng này?"))  
           {  
                $.ajax({  
                     url:"delete.php",  
                     method:"POST",  
                     data:{idUser:idUser},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);  
                          fetch_data();  
                     }  
                });  
           }  
      });  
 });  
 </script>