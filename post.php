<?php
require "lib/dbCon.php";
require "lib/trangchu.php";
$conn = MyConnect();
ob_start();
session_start();

if (isset($_GET["idTin"]))
{
	$idTin = $_GET["idTin"];
	settype($idTin,"int");
}
else
{
	$idTin = 1649;
}
CapNhatSoLanXemTin($idTin);

$tin = ChiTietTin($idTin);
$row_tin = mysqli_fetch_array($tin);
?>

<?php
if (isset($_POST["btnComment"]))
{
	if(isset($_SESSION['hoten']))
	{
		$hoten =   $_SESSION['hoten'];
		$email =  $_SESSION['Email'];
	}
	else
	{
$hoten =  $_POST['txtName'] ;
$email = $_POST['txtEmail'] ;
	}
date_default_timezone_set('Asia/Ho_Chi_Minh');
$datetime = new DateTime();
$datetime=$datetime->format('Y-m-d H:i:s');
$comment = $_POST['txtComment'];

  $conn = myConnect();
$qr = "
    INSERT INTO comment VALUES
    (null,'$hoten', '$email', '$datetime','$comment','$idTin')
  ";

if ($hoten == '' || $email == '')
	{
		echo "<script type='text/javascript'>alert('Hãy điền tên và email nếu bạn chưa đăng nhập!');</script>";

    
  }
   else
  {
mysqli_query($conn, $qr);
	
  echo "<script type='text/javascript'>alert('Comment của bạn đã được đăng');</script>";
  header('Location: '.$_SERVER['REQUEST_URI'].'#comment_section');
  }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $row_tin['TieuDe']; ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Demo project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="plugins/jquery.mb.YTPlayer-3.1.12/jquery.mb.YTPlayer.css">
<link rel="stylesheet" type="text/css" href="styles/post_nosidebar.css">
<link rel="stylesheet" type="text/css" href="styles/post_nosidebar_responsive.css">
</head>
<body>

<div class="super_container">

	<!-- Header -->

	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="header_content d-flex flex-row align-items-center justify-content-start">
						<div class="logo"><a href="index.php">TheNews</a></div>
						<nav class="main_nav">
							<ul>
								<li ><a href="index.php">Trang Chủ</a></li>
								<li class="active"><a href="category.php">Thể Loại</a></li>
								<li><a href="editProfile.php">Thông tin tài khoản</a></li>
								<li><a href="https://www.youtube.com/channel/UCabsTV34JwALXKGMqHpvUiA">Youtube</a></li>
								<li><a href="contact.php">Liên Hệ</a></li>
							</ul>
						</nav>
						<div class="search_container ml-auto">
							<div class="weather">
								<div class="temperature">
									<?php
									$weather = json_decode(file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=Thanh%20pho%20Ho%20Chi%20Minh&appid=88a357062c9eec802f23fed0459cf76c'));
							
									echo $weather->main->temp -273.15 .'°C ' .$weather->weather[0]->main;
									  ?></div>
								<img class="weather_icon" src="images/cloud.png" alt="">
							</div>
							
							
						</div>
						<div class="hamburger ml-auto menu_mm">
							<i class="fa fa-bars trans_200 menu_mm" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Menu -->

	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<div class="logo menu_mm"><a href="#">TheNews</a></div>
		<div class="search">
			<form action="#">
				<input type="search" class="header_search_input menu_mm" required="required" placeholder="Type to Search...">
				<img class="header_search_icon menu_mm" src="images/search_2.png" alt="">
			</form>
		</div>
		<nav class="menu_nav">
			<ul class="menu_mm">
				<li><a href="index.php">Trang Chủ</a></li>
				<li class="active"><a href="category.php">Thể Loại</a></li>
				<li><a href="editProfile.php">Thông tin tài khoản</a></li>
				<li><a href="https://www.youtube.com/channel/UCabsTV34JwALXKGMqHpvUiA">Youtube</a></li>
				<li><a href="contact.php">Liên Hệ</a></li>
			</ul>
		</nav>
	</div>
	
	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php if (strpos($row_tin['urlHinh'], 'tintuc') == false && strpos($row_tin['urlHinh'], 'http') == true) 
				{
    				echo 'upload/tintuc/';
				}
					echo $row_tin['urlHinh']
		
					 
						   ?>"  data-speed="0.8"></div>
		<div class="home_content">
			<div class="post_category trans_200"><a href="genre.php?idLT=<?php echo $row_tin['idLT'] ?>" class="trans_200"><?php $row_tenloaitin = Generate_TenLoaiTin($row_tin['idLT']);
										echo $row_tenloaitin['Ten']; ?></a></div>
			<div class="post_title"><?php echo $row_tin['TieuDe']; ?></div>
			<div class="post_author d-flex flex-row align-items-center justify-content-center">
				<div class="author_image"><div><img style="width: 100%;" src="https://www.warmerwaters.co.uk/wp-content/uploads/2015/08/user-profile-icon.png" alt=""></div></div>
				<div class="post_meta"><a href="#"><?php $tacgia = viewTacGia($row_tin['idUser']);
echo $tacgia['HoTen'] ?></a><span><?php echo $row_tin['Ngay'] ?></span></div>
			</div>
		</div>
	</div>
	
	<!-- Page Content -->

	<div class="page_content">
		<div class="container">
			<div class="row">

				<!-- Post Content -->

				<div class="col-lg-10 offset-lg-1">
					<div class="post_content">

						<!-- Post Body -->


						<div class="post_body">

							<figure>
								<img src="<?php if (strpos($row_tin['urlHinh'], 'tintuc') == false && strpos($row_tin['urlHinh'], 'http') == true) 
				{
    				echo 'upload/tintuc/';
				}
					echo $row_tin['urlHinh']
		
					 
						   ?>" alt="">
								<figcaption><?php echo $row_tin['TomTat'] ?></figcaption>
							</figure>

							

							<p class="post_p"><?php echo $row_tin['Content'] ?></p>
							

							<!-- 
							<div class="tags_share d-flex flex-row align-items-center justify-content-start">
								<div class="post_tags">
									<ul>
										<li class="post_tag"><a href="#">Liberty</a></li>
										<li class="post_tag"><a href="#">Manual</a></li>
										<li class="post_tag"><a href="#">Interpretation</a></li>
										<li class="post_tag"><a href="#">Recommendation</a></li>
									</ul>
								</div>
								<div class="post_share ml-sm-auto">
									<span>share</span>
									<ul class="post_share_list">
										<li class="post_share_item"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
										<li class="post_share_item"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
										<li class="post_share_item"><a href="#"><i class="fa fa-google" aria-hidden="true"></i></a></li>
									</ul>
								</div>
							</div>
						-->
								
						</div>
					</div>
				</div>

			</div>

			<div class="row">
				<div class="col">
					<!-- Similar Posts -->
					<div class="similar_posts">
						<div class="grid clearfix">

							<?php
								$tincungloai = TinCungLoaiTin($idTin,$row_tin['idLT']);
										while($row_tincungloai = mysqli_fetch_array($tincungloai))
										{
								?>

							<!-- Small Card With Image -->
							<div class="card card_small_with_image grid-item">
								<img class="card-img-top" src="<?php if (strpos($row_tincungloai['urlHinh'], 'tintuc') == false && strpos($row_tincungloai['urlHinh'], 'http') == true) 
				{
    				echo 'upload/tintuc/';
				}
					echo $row_tincungloai['urlHinh']
		
					 
						   ?>" alt="">
								<div class="card-body">
									<div class="card-title card-title-small"><a href="post.php?idTin=<?php echo $row_tincungloai['idTin'] ?>"><?php echo $row_tincungloai['TieuDe'] ?></a></div>
									<small class="post_meta"><a href="#"><?php $row_tenloaitin = Generate_TenLoaiTin($row_tincungloai[8]);
										echo $row_tenloaitin['Ten']; ?></a><span><?php echo $row_tin['Ngay'] ?></span></small>
								</div>
							</div>

							<?php
								}
							?>

							

						</div>
					</div>
					
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6 offset-lg-3">

					<!-- Post Comment -->
					<div class="post_comment">
						<div class="post_comment_title">Post Comment</div>
						<div class="post_comment_form_container">
							<form action="#" method="post">
								<input type="text" class="comment_input comment_input_name" name="txtName" placeholder="Your Name" >
								<input type="email" class="comment_input comment_input_email" placeholder="Your Email" name="txtEmail">
								<textarea class="comment_text" placeholder="Your Comment" name="txtComment" id="txtComment" required="required"></textarea>
								<button type="submit" name="btnComment" class="comment_button">Post Comment</button>
							</form>
						</div>
					</div>
					<?php
									$comment = viewComment($idTin);
									$num_comment = mysqli_num_rows($comment);
								?>

					<!-- Comments -->
					<div class="comments" id="comment_section">
						<div class="comments_title">Comments <span>(<?php echo $num_comment ?>)</span></div>
						<div class="comments_container">
							<ul class="comment_list">
								<?php
									while ($row_comment = mysqli_fetch_array($comment))
											{
											?>
								<li class="comment">
									<div class="comment_body">
										<div class="comment_panel d-flex flex-row align-items-center justify-content-start">
											<div class="comment_author_image"><div><img style="width: 100%;" src="https://www.warmerwaters.co.uk/wp-content/uploads/2015/08/user-profile-icon.png" alt=""></div></div>
											<small class="post_meta"><a href="#"><?php echo $row_comment['hoten'] ?></a><span><?php echo $row_comment['datetime']  ?></span></small>
										</div>
										<div class="comment_content">
											<p><?php echo $row_comment['noidung'] ?>.</p>
										</div>
									</div>
								</li>
								<?php
									}
								?>
							</ul>
						</div>
					</div>
					<div class="load_more">
						<div id="load_more" class="load_more_button text-center trans_200">Load More</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row row-lg-eq-height">
				<div class="col-lg-9 order-lg-1 order-2">
					<div class="footer_content">
						<div class="footer_logo"><a href="index.php">TheNews.vn</a></div>
						<div class="footer_social">
							<ul>
								<li class="footer_social_facebook"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li class="footer_social_twitter"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li class="footer_social_pinterest"><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
								<li class="footer_social_vimeo"><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
								<li class="footer_social_instagram"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<li class="footer_social_google"><a href="#"><i class="fa fa-google" aria-hidden="true"></i></a></li>
							</ul>
						</div>
						<div class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made by <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#" target="_blank">Từ Ngọc Huy</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
					</div>
				</div>
				<div class="col-lg-3 order-lg-2 order-1">
					<div class="subscribe">
						<div class="subscribe_background"></div>
						<div class="subscribe_content">
							<div class="subscribe_title">Subscribe</div>
							<form action="#">
								<input type="email" class="sub_input" placeholder="Your Email" required="required">
								<button class="sub_button">
									<svg version="1.1" id="link_arrow_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										 width="19px" height="13px" viewBox="0 0 19 13" enable-background="new 0 0 19 13" xml:space="preserve">
										<polygon fill="#FFFFFF" points="12.475,0 11.061,0 17.081,6.021 0,6.021 0,7.021 17.038,7.021 11.06,13 12.474,13 18.974,6.5 "/>
									</svg>
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/masonry/masonry.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/post_nosidebar.js"></script>
</body>
</html>