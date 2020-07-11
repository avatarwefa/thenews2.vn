
<?php
//Chuyển hướng k bị lỗi
// ob_start();
// session_start();
	// echo $_SESSION["idGroup"];
	// if(!isset($_SESSION["idUser"]) || $_SESSION["idGroup"] != 1){
	// 	header("location:../index.php");
	// }
	//ket noi csdl
// require "../lib/dbCon.php";
// require "../lib/quantri.php";


require "../lib/dbCon.php";
// require "lib/trangchu.php";
$conn = MyConnect();
ob_start();
session_start();
?>
<?php 
if(isset($_POST["btnSignout"]))
{
	unset($_SESSION["idUser"]);
	unset($_SESSION["Username"]);
	unset($_SESSION["Password"]);
	unset($_SESSION["HoTen"]);
	unset($_SESSION["Email"]);
	unset($_SESSION["idGroup"]);
	header("location:../index.php");
}
    //header("Location:index.php")
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
<!-- <script type="text/javascript">
	$(document).ready(function (e){
		$("#frmEnquiry").on('submit',(function(e){
			e.preventDefault();
			$('#loader-icon').show();
			var valid;	
			valid = validateContact();
			if(valid) {
				$.ajax({
					url: "mail-send.php",
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data){
						$("#mail-status").html(data);
						$('#loader-icon').hide();
					},
					error: function(){} 	        

				});
			}
		}));

		function validateContact() {
			var valid = true;	
			$(".demoInputBox").css('background-color','');
			$(".info").html('');
			$("#userName").removeClass("invalid");
			$("#userEmail").removeClass("invalid");
			$("#subject").removeClass("invalid");
			$("#content").removeClass("invalid");

			if(!$("#userName").val()) {
				$("#userName").addClass("invalid");
				$("#userName").attr("title","Required");
				valid = false;
			}
			if(!$("#userEmail").val()) {
				$("#userEmail").addClass("invalid");
				$("#userEmail").attr("title","Required");
				valid = false;
			}
			if(!$("#userEmail").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
				$("#userEmail").addClass("invalid");
				$("#userEmail").attr("title","Invalid Email");
				valid = false;
			}
			if(!$("#subject").val()) {
				$("#subject").addClass("invalid");
				$("#subject").attr("title","Required");
				valid = false;
			}
			if(!$("#content").val()) {
				$("#content").addClass("invalid");
				$("#content").attr("title","Required");
				valid = false;
			}

			return valid;
		}

	});
</script>
-->

<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta name="description" content="" />
	<meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title>Newsletter</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/png" href="favicon.png"/>
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  

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
				<a class="navbar-brand" href="">
					TRANG QUẢN TRỊ
				</a>
				 <div class="text-danger">Xin chào <?php echo $_SESSION["FULL_NAME"] ?></div>
			</div>

			<div class="right-div">
				<form method="post">
					<button class="btn btn-primary" name="btnSignout">
						LOG ME OUT
					</button>
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
							<li><a href="index.php" >TRANG CHỦ</a></li>
							<li><a href="quanLythanhVien.php">QUẢN LÝ THÀNH VIÊN</a></li>
							<li><a href="quanLyKhoaHoc.php" >QUẢN LÝ KHÓA HỌC </a></li>
							<li><a href="quanLyBaiHoc.php" >QUẢN LÝ BÀI HỌC </a></li>
							<li><a href="">NEWSLETTER</a></li>
							<li><a href="quanLyLichTrinh.php" >QUẢN LÝ LỊCH HỌC </a></li>

							<!-- <li><a href="./listQuangCao.php">QUẢN lÝ QUẢNG CÁO</a></li> -->
						</ul>
					</div>
				</div>

			</div>
		</div>
	</section>
	<br />
	<div class="container" style="background: #20c997">
		<div class="row">
			<div class="col-md-8" style="margin:0 auto; float:none;">
				<h3 align="center">Thông Báo Đến Đọc giả</h3>
				<br /><hr>
				<h4 align="center">Nhập Thông Tin Hộp Thư</h4><br />
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
</body>
</html>