<?php
	ob_start();
	session_start();
	echo $_SESSION["idGroup"];

	if(!isset($_SESSION["idUser"]) || $_SESSION["idGroup"] != 1){
		header("location:../index.php");
	}
	
	require "../lib/dbCon.php";
	require "../lib/quantri.php";
	
	
?>
<?php
if (isset($_POST["btnLogOut"]))
{
	echo $_SESSION["idGroup"];
	unset($_SESSION["idUser"]);
	unset($_SESSION["Username"]);
	unset($_SESSION["HoTen"]);
	unset($_SESSION["idGroup"]);
	header("location:../index.php");
}
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
    <title>ADMIN</title>
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
                <a class="navbar-brand" href="index.php">
					
                    TRANG QUẢN TRỊ
					
                </a>

            </div>

            <div class="right-div">
                <form method="post" action="">
					<input  type="submit" name="btnLogOut" id="btnLogOut" class="btn btn-info pull-right" value = "Log out">
				</form>
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
                             
                            <li><a href="./listTheLoai.php">QUẢN LÝ THỂ LOẠI</a></li>
                            <li><a href="./listLoaiTin.php" >QUẢN LÝ LOẠI TIN </a></li>
                            <li><a href="./listTin.php">QUẢN LÝ TIN TỨC</a></li>
                            <li><a href="./listQuangCao.php" class="menu-top-active">QUẢN lÝ QUẢNG CÁO</a></li>
							<li><a href="./newsletter.php">NEWSLETTER</a></li>
                            

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
						<td><form id="form1" name="form1" method="post" action="">
						  <table width="1000" border="1" class="table table-striped table-bordered table-hover">
							<tr>
							  <td colspan="7" style="text-align: center;background-color: #123751;color: white">DANH SÁCH QUẢNG CÁO</td>
							  </tr>

							<tr>
							  <td>idQC</td>
							  <td>vitri</td>
							  <td>MoTa</td>
							  <td>Url</td>
							  <td>urlHinh</td>
							  <td>SoLanClick</td>
							  <td><a href="themQuangCao.php">Thêm</a></td>
							</tr>
							<?php 
								$quangcao = DanhSachQuangCao();
								while($row_quangcao = mysqli_fetch_array($quangcao)){
									ob_start();
							?>
							<tr>
							  <td>{idQC}</td>
							  <td>{vitri}</td>
							  <td>{MoTa}</td>
							  <td>{Url}</td>
							  <td>{urlHinh}</td>
							  <td>{SoLanClick}</td>
							  <td><a href="suaQuangCao.php?idQC={idQC}">Sửa</a> - <a onclick = "return confirm('Bạn có chắc muốn xóa không?')"href="xoaQuangCao.php?idQC={idQC}">Xóa</a></td>
							</tr>
							<?php
									$s	= ob_get_clean();
									$s 	= str_replace("{idQC}", $row_quangcao["idQC"], $s);
									$s 	= str_replace("{vitri}", $row_quangcao["vitri"], $s);
									$s 	= str_replace("{MoTa}", $row_quangcao["MoTa"], $s);
									$s 	= str_replace("{Url}", $row_quangcao["Url"], $s);
									$s 	= str_replace("{urlHinh}", $row_quangcao["urlHinh"], $s);
									$s 	= str_replace("{SoLanClick}", $row_quangcao["SoLanClick"], $s);
									echo $s;
								}
							?>
						  </table>
						</form></td>
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
