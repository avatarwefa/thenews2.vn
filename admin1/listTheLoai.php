<?php
//Chuyển hướng k bị lỗi
	ob_start();
	session_start();
	//echo $_SESSION["idGroup"];

	if(!isset($_SESSION["idUser"]) || $_SESSION["idGroup"] != 1){
		header("location:../index.php");
	}
	//ket noi csdl
	require "../lib/dbCon.php";
	require "../lib/quantri.php";
	
?>

	<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>FREE RESPONSIVE HORIZONTAL ADMIN</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <div class="navbar navbar-inverse set-radius-zero" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">
					
                    TRANG QUẢN TRỊ
					
                </a>

            </div>

            <div class="right-div">
                <a href="#" class="btn btn-info pull-right">LOG ME OUT</a>
            </div>
        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="../index.php" >TRANG CHỦ</a></li>
                             
                            <li><a href="./listTheLoai.php" class="menu-top-active">QUẢN LÝ THỂ LOẠI</a></li>
                            <li><a href="./listLoaiTin.php" >QUẢN LÝ LOẠI TIN </a></li>
                            <li><a href="./listTin.php">QUẢN LÝ TIN TỨC</a></li>
                            <li><a href="./listQuangCao.php">QUẢN lÝ QUẢNG CÁO</a></li>
                            

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
     <!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
				
               	<div class="table-responsive">
				
					
					
					<table width="1000" border="1" align="center" class="table table-striped table-bordered table-hover">
					  <tr>
						<td><table width="100%" border="1" class="table table-striped table-bordered table-hover">
						  <tr>
							<td colspan="6" style="text-align: center;background-color: #123751;color: white">DANH SÁCH THỂ LOẠI</td>
							</tr>
						  <tr>
							<td>idTL</td>
							<td>TenTL</td>
							<td>TeenTL_KhongDau</td>
							<td>ThuTu</td>
							<td>AnHien</td>
							<td><a href="themTheLoai.php">Thêm</a></td>
						  </tr>
						  <?php
						  $theloai= DanhSachTheLoai();
						  while ($row_theloai = mysqli_fetch_array($theloai))
						  {
							  ob_start();
						  ?>
						  <tr>
							<td>{idTL}</td>
							<td>{TenTL}</td>
							<td>{TenTL_KhongDau}</td>
							<td>{ThuTu}</td>
							<td>{AnHien}</td>
							<td><a href="suaTheLoai.php?idTL={idTL}">Sửa</a>-<a onclick = "return confirm('Bạn có chắc là muốn xoá thể loại')" href="xoaTheLoai.php?idTL={idTL}">Xoá</a></td>
						  </tr>
						  <?php
						  $s = ob_get_clean();
						  $s = str_replace("{idTL}", $row_theloai{"idTL"}, $s);
						  $s = str_replace("{TenTL}", $row_theloai{"TenTL"}, $s);
						  $s = str_replace("{TenTL_KhongDau}", $row_theloai{"TenTL_KhongDau"}, $s);
						  $s = str_replace("{ThuTu}", $row_theloai{"ThuTu"}, $s);
						  $s = str_replace("{AnHien}", $row_theloai{"AnHien"}, $s);
						  echo $s;
						  }
						  ?>
						</table>      <br /></td>
					  </tr>
					</table>
				
					
				</div>   
				
            </div>

        </div>
             <div class="row">
            <div class="col-md-12">
               
                            </div>

        </div>
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <section class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   &copy; Thực tập công nghệ phần mềm | 2019-2020 
                </div>

            </div>
        </div>
    </section>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
