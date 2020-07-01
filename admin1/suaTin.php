<?php
	ob_start();
	session_start();
 $_SESSION["idGroup"];
	if(!isset($_SESSION["idUser"]) || $_SESSION["idGroup"] != 1){
		header("location:../index.php");
	}
	
	require "../lib/dbCon.php";
	require "../lib/quantri.php";
	
	
?>
<?php
	$idTin = $_GET["idTin"];
	settype($idTin, "int");
	$row_tin = ChiTietTin($idTin);
?>
<?php 
	if(isset($_POST["btnSua"])){
		$TieuDe 	= $_POST["TieuDe"];
		$TieuDe_KhongDau = changeTitle($TieuDe);
		$TomTat 	= $_POST["TomTat"];
		$urlHinh 	= $_POST["urlHinh"];
		$Content 	= $_POST["Content"];
		$idLT 		= $_POST["idLT"];
			settype($idLT, "int");
		$idTL 		= $_POST["idTL"];
			settype($idTL, "int");
		$TinNoiBat 	= $_POST["TinNoiBat"];
		$AnHien 	= $_POST["AnHien"];
			settype($AnHien, "int");
		$conn 		= myConnect();
		$qr 		= "UPDATE tin SET
						TieuDe = '$TieuDe',
						TieuDe_KhongDau = '$TieuDe_KhongDau',
						TomTat = '$TomTat',
						urlHinh = '$urlHinh',
						Content = '$Content',
						idLT = '$idLT',
						idTL = '$idTL',
						TinNoiBat = '$TinNoiBat',
						AnHien = '$AnHien'
						WHERE idTin = '$idTin'
		";
		mysqli_query($conn, $qr);
		header("location:listTin.php");	
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
	
	
	
	
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
	<script type="text/javascript">
	function BrowseServer( startupPath, functionData ){
		var finder = new CKFinder();
		finder.basePath = 'ckfinder/'; //Đường path nơi đặt ckfinder
		finder.startupPath = startupPath; //Đường path hiện sẵn cho user chọn file
		finder.selectActionFunction = SetFileField; // hàm sẽ được gọi khi 1 file được chọn
		finder.selectActionData = functionData; //id của text field cần hiện địa chỉ hình
		//finder.selectThumbnailActionFunction = ShowThumbnails; //hàm sẽ được gọi khi 1 file thumnail được chọn	
		finder.popup(); // Bật cửa sổ CKFinder
	} //BrowseServer

	function SetFileField( fileUrl, data ){
		document.getElementById( data["selectActionData"] ).value = fileUrl;
	}
	function ShowThumbnails( fileUrl, data ){	
		var sFileName = this.getSelectedFile().name; // this = CKFinderAPI
		document.getElementById( 'thumbnails' ).innerHTML +=
		'<div class="thumb">' +
		'<img src="' + fileUrl + '" />' +
		'<div class="caption">' +
		'<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
		'</div>' +
		'</div>';
		document.getElementById( 'preview' ).style.display = "";
		return false; // nếu là true thì ckfinder sẽ tự đóng lại khi 1 file thumnail được chọn
	}
	</script>
	
	
	

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
                            <li><a href="./listTin.php" class="menu-top-active">QUẢN LÝ TIN TỨC</a></li>
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
				
					<table width="1000" border="0" align="center"  class="table table-striped table-bordered table-hover">
					  <tr>
						<td><form id="form1" name="form1" method="post" action="">
						  <table width="700" border="1" class="table table-striped table-bordered table-hover">
							<tr>
							  <td colspan="2" style="text-align: center;background-color: #123751;color: white">SỬA TIN</td>
							  </tr>
							<tr>
							  <td>TieuDe</td>
							  <td><label for="TieuDe"></label>
								<input value="<?php echo $row_tin["TieuDe"]?>" name="TieuDe" id="TieuDe" /></td>
							</tr>
							<tr>
							  <td>TomTat</td>
							  <td><label for="TomTat"></label>
								<textarea name="TomTat" id="TomTat" cols="45" rows="5"><?php echo $row_tin["TomTat"]?></textarea></td>
							</tr>
							<tr>
							  <td>urlHinh</td>
							  <td><label for="urlHinh"></label>
								<input value="<?php echo $row_tin["urlHinh"]?>" type="text" name="urlHinh" id="urlHinh" />
								<input onclick="BrowseServer('Images:/','urlHinh')" type="button" name="btnChonFile" id="btnChonFile" value="Chọn hình" /></td>
							</tr>
							<tr>
							  <td>Content</td>
							  <td><label for="Content"></label>
								<textarea name="Content" id="Content" cols="45" rows="5"><?php echo $row_tin["Content"]?></textarea>
								<script type="text/javascript">
								var editor = CKEDITOR.replace( 'Content',{
									uiColor : '#9AB8F3',
									language:'vi',
									skin:'v2',	
									filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?Type=Images',
									filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?Type=Flash',
									filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
									filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

									toolbar:[
									['Source','-','Save','NewPage','Preview','-','Templates'],
									['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],
									['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
									['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
									['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
									['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
									['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
									['Link','Unlink','Anchor'],
									['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
									['Styles','Format','Font','FontSize'],
									['TextColor','BGColor'],
									['Maximize', 'ShowBlocks','-','About']
									]
								});		
								</script>
								</td>
							</tr>
							<tr>
							  <td>idTL</td>
							  <td><label for="idTL"></label>
								<select name="idTL" id="idTL">
									<?php 
										$theloai = DanhSachTheLoai();
										while($row_theloai = mysqli_fetch_array($theloai)){
									?>
									<option <?php if($row_tin['idTL'] == $row_theloai['idTL']) echo "selected = 'selected'"; ?> value="<?php echo $row_theloai["idTL"]?>" ><?php echo $row_theloai["TenTL"]?></option>
									<?php 
										}
									?>
								</select></td>
							</tr>
							<tr>
							  <td>idLT</td>
							  <td><label for="idLT"></label>
								<select name="idLT" id="idLT">
									<?php 
										$loaitin = DanhSachLoaiTin();
										while($row_loaitin = mysqli_fetch_array($loaitin)){
									?>
									<option <?php if($row_tin['idLT'] == $row_loaitin['idLT']) echo "selected = 'selected'"; ?> value="<?php echo $row_loaitin["idLT"]?>"><?php echo $row_loaitin["Ten"] ?></option>
									<?php 
										}
									?>
								</select></td>
							</tr>
							<tr>
							  <td>TinNoiBat</td>
							  <td><p>
								<label>
								  <input <?php if($row_tin["TinNoiBat"] == 1 ) echo "checked = 'checked'" ?> type="radio" name="TinNoiBat" value="1" id="TinNoiBat_0" />
								  Nổi bật</label>
								<br />
								<label>
								  <input <?php if($row_tin["TinNoiBat"] == 0 ) echo "checked = 'checked'" ?> type="radio" name="TinNoiBat" value="0" id="TinNoiBat_1" />
								  Bình thường</label>
								<br />
							  </p></td>
							</tr>
							<tr>
							  <td>AnHien</td>
							  <td><p>
								<label>
								  <input <?php if($row_tin["AnHien"] == 1 ) echo "checked = 'checked'" ?> type="radio" name="AnHien" value="1" id="AnHien_0" />
								  Hiện</label>
								<br />
								<label>
								  <input <?php if($row_tin["AnHien"] == 0 ) echo "checked = 'checked'" ?> type="radio" name="AnHien" value="0" id="AnHien_1" />
								  Ẩn</label>
								<br />
							  </p></td>
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
