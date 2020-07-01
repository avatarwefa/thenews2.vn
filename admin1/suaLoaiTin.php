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

<?php
$idLT = $_GET["idLT"];
settype($idLT, "int");
$row_loaitin = ChiTietLoaiTin($idLT);


?>

<?php
	if(isset($_POST["btnSua"])){
		$Ten = $_POST["Ten"];
		$Ten_KhongDau = changeTitle($Ten);
		$ThuTu = $_POST["ThuTu"];
			settype($dThuTu, "int");
		$AnHien = $_POST["AnHien"];
			settype($AnHien, "int");
		$idTL = $_POST["idTL"];
			settype($idTL, "int");
		$conn 	= myConnect();
		$qr		= "
			UPDATE loaitin SET
			Ten = '$Ten',
			Ten_KhongDau = '$Ten_KhongDau',
			ThuTu = '$ThuTu',
			AnHien = '$AnHien',
			idTL = '$idTL'
			WHERE idLT = '$idLT'
		";	
		mysqli_query($conn, $qr);
		header("location:listLoaiTin.php");
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
                            <li><a href="./listLoaiTin.php" class="menu-top-active">QUẢN LÝ LOẠI TIN </a></li>
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
					<td><form id="form1" name="form1" method="post" action="">
					  <table width="100%" border="1" class="table table-striped table-bordered table-hover">
						<tr>
						  <td colspan="2" style="text-align: center;background-color: #123751;color: white">SỬA LOẠI TIN</td>
						  </tr>
						<tr>
						  <td >Tên</td>
						  <td><label for="Ten"></label>
							<input value="<?php
							echo $row_loaitin["Ten"]
							?>" type="text" name="Ten" id="Ten" /></td>
						</tr>
						<tr>
						  <td>Thứ Tự</td>
						  <td><label for="ThuTu"></label>
							<input value="<?php
							echo $row_loaitin["ThuTu"]
							?>" type="text" name="ThuTu" id="ThuTu" /></td>
						</tr>
						<tr>
						  <td>Ẩn Hiện</td>
						  <td><p>
							<label>
							  <input <?php if($row_loaitin["AnHien"] == 1 ) echo "checked = 'checked'" ?> type="radio" name="AnHien" value="1" id="RadioGroup1_0" />
							  Hiện</label>
							<br />
							<label>
							  <input <?php if($row_loaitin["AnHien"] == 0 ) echo "checked = 'checked'" ?> type="radio" name="AnHien" value="0" id="RadioGroup1_1" />
							  Ẩn</label>
							<br />
						  </p></td>
						</tr>
						<tr>
						  <td>idTL</td>
						  <td><label for="idTL"></label>
							<select name="idTL" id="idTL">
							<?php
							$theloai = DanhSachTheLoai()
							;
							while($row_theloai = mysqli_fetch_array($theloai))
							{
							?>

							<option <?php if ($row_theloai["idTL"] == $row_loaitin["idTL"]) echo "selected = 'selected'"  ?> value="<?php echo $row_theloai["idTL"] ?>"><?php echo $row_theloai["TenTL"] ?> </option>

							<?php
							}
							?>
							</select></td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td><input type="submit" name="btnSua" id="btnSua" value="Sửa" /></td>
						</tr>
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
