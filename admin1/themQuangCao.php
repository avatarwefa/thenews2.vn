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
	if(isset($_POST["btnThem"])){
		$vitri 	= $_POST["vitri"];	
			settype($vitri, "int");
		$MoTa 	= $_POST["MoTa"];
		$Url 	= $_POST["Url"];
		$urlHinh = $_POST["urlHinh"];
		$conn 	 = myConnect();
		$qr 	 = "
			INSERT INTO quangcao
			VALUES(null, '$vitri','$MoTa','$Url','$urlHinh',0)
		";
		mysqli_query($conn, $qr);
		header("location:listQuangCao.php");
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
                             
                            <li><a href="./listTheLoai.php">QUẢN LÝ THỂ LOẠI</a></li>
                            <li><a href="./listLoaiTin.php" >QUẢN LÝ LOẠI TIN </a></li>
                            <li><a href="./listTin.php">QUẢN LÝ TIN TỨC</a></li>
                            <li><a href="./listQuangCao.php" class="menu-top-active">QUẢN lÝ QUẢNG CÁO</a></li>

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
				
					<table width="1000" border="1" class="table table-striped table-bordered table-hover">
						<tr>
						  <td colspan="2" style="text-align: center;background-color: #123751;color: white">THÊM QUẢNG CÁO</td>
						  </tr>
						<tr>
						  <td width="491">vitri</td>
						  <td width="493"><p>
							<label>
							  <input type="radio" name="vitri" value="1" id="vitri_0" />
							  Vị trí 1</label>
							<br />
							<label>
							  <input type="radio" name="vitri" value="2" id="vitri_1" />
							  Vị trí 2</label>
							<br />
						  </p></td>
						</tr>
						<tr>
						  <td>MoTa</td>
						  <td><label for="MoTa"></label>
							<input type="text" name="MoTa" id="MoTa" />            <label for="textfield"></label></td>
						</tr>
						<tr>
						  <td>Url</td>
						  <td><label for="Url"></label>
							<input type="text" name="Url" id="Url" /></td>
						</tr>
						<tr>
						  <td>urlHinh</td>
						  <td><label for="urlHinh"></label>
							<input type="text" name="urlHinh" id="urlHinh" /></td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td><input name="btnThem" type="submit" id="btnThem" value="Thêm" /></td>
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
