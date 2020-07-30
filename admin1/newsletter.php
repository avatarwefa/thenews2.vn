<?php
//Chuyển hướng k bị lỗi
	ob_start();
	session_start();
	//
	if(!isset($_SESSION["idUser"]) || $_SESSION["idGroup"] != 1){
		header("location:../index.php");
	}
	//ket noi csdl
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






<style>


	#frmEnquiry {
		border-top: #F0F0F0 2px solid;
		background: #FAF8F8;
		padding: 15px 30px;
	}

	#frmEnquiry div {
		margin-bottom: 20px;
	}

	#frmEnquiry div label {
		margin-left: 5px
	}

	.demoInputBox {
		padding: 10px;
		border: #F0F0F0 1px solid;
		border-radius: 4px;
		background-color: #FFF;
		width: 100%;
	}

	.demoInputBox:focus {
		outline:none;
	}

	.error {
		background-color: #FF6600;
		border: #AA4502 1px solid;
		padding: 5px 10px;
		color: #FFFFFF;
		border-radius: 4px;
	}

	.success {
		background-color: #9fd2a1;
		border: #91bf93 1px solid;
		padding: 5px 10px;
		color: #3d503d;
		border-radius: 4px;
		cursor: pointer;
		font-size: 0.9em;
	}

	.info {
		font-size: .8em;
		color: #FF6600;
		letter-spacing: 2px;
		padding-left: 5px;
	}

	.btnAction {
		background-color: #263327;
		border: 0;
		padding: 10px 40px;
		color: #FFF;
		border: #F0F0F0 1px solid;
		border-radius: 4px;
		cursor:pointer;
	}
	.btnAction:focus {
		outline:none;
	}
	.invalid {
		background: #fbf2f2;
		border: #e8e0e0 1px solid;
	}
</style>
<script src="newsletter/jquery-3.2.1.min.js" type="text/javascript"></script>












<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

            <div class="right-div" >
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
                            <li><a href="./listQuangCao.php">QUẢN lÝ QUẢNG CÁO</a></li>
							<li><a href="./newsletter.php" class="menu-top-active">NEWSLETTER</a></li>
                            

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
     <!-- MENU SECTION END-->
    <div class="content-wrapper">
		
		
		
		
		
       <div class="container" style="background: #31afd5">
		<div class="row" style="width: auto">
			<div class="col-md-8" style="margin:0 auto; float:none;">
				<h3 align="center" style="color: white">Thông Báo Đến Đọc giả</h3>
				<br /><hr>
				<h4 align="center" style="color: white">Nhập Thông Tin Hộp Thư</h4><br />
				<form id="frmEnquiry" method="post" enctype="multipart/form-data" action="mail-send.php">
					<div class="row">
						<div id="mail-status"></div>
						<div>
							<input
							type="text" name="userName" id="userName"
							class="demoInputBox" placeholder="Name" required>
						</div>
						<div>
							<input type="text" name="userEmail" id="userEmail"
							class="demoInputBox" placeholder="From Email..." required>
						</div>
						<div>
							<input type="text" name="subject" id="subject"
							class="demoInputBox" placeholder="Subject" required>
						</div>
						<div>
							<textarea name="content" id="content" class="demoInputBox"
							cols="60" rows="6" placeholder="Content" required></textarea>
						</div>
						<div>
							<label>Attachment</label><br /> <input type="file"
							name="attachment[]" class="demoInputBox" multiple="multiple">
						</div>

					</div><hr>
					<div id="loader-icon" style="display: none;">
						<img src="newsletter/LoaderIcon.gif" />
					</div>
					<div class="form-group" align="center">
						<input type="submit" value="Send" class="btnAction" />
					</div>
				</form>
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
