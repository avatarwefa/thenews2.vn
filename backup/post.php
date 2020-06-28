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
	$idTin = 1;
}
CapNhatSoLanXemTin($idTin);

$tin = ChiTietTin($idTin);
$row_tin = mysqli_fetch_array($tin);
?>

<?php
if (isset($_POST["btnComment"]))
{
$id = $_SESSION['idUser'];
$hoten =  $_SESSION['Username'];
date_default_timezone_set('Asia/Ho_Chi_Minh');
$datetime = new DateTime();
$datetime=$datetime->format('Y-m-d H:i:s');
$comment = $_POST["txtComment"];

  $conn = myConnect();
  $qr = "
    INSERT INTO comment VALUES
    (null,'$hoten','$datetime','$comment','$idTin')
  ";
if(isset($_SESSION["idUser"]))
	{
    mysqli_query($conn, $qr);
	
    echo "<script type='text/javascript'>alert('Comment của bạn đã được đăng');</script>";
   	header('Location: '.$_SERVER['REQUEST_URI']);
  }
   else
  {
    echo "<script type='text/javascript'>alert('Hãy đăng nhập trước khi comment!');</script>";
  }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<title>Post</title>
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
<link rel="stylesheet" type="text/css" href="styles/post.css">
<link rel="stylesheet" type="text/css" href="styles/post_responsive.css">
</head>
<body>

<div class="super_container">

	<!-- Header -->

	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="header_content d-flex flex-row align-items-center justify-content-start">
						<div class="logo"><a href="#">TheNews</a></div>
						<nav class="main_nav">
							<ul>
								<li class="active"><a href="index.html">Home</a></li>
								<li><a href="#">Fashion</a></li>
								<li><a href="#">Gadgets</a></li>
								<li><a href="#">Lifestyle</a></li>
								<li><a href="#">Video</a></li>
								<li><a href="contact.html">Contact</a></li>
							</ul>
						</nav>
						<div class="search_container ml-auto">
							<div class="weather">
								<div class="temperature">+10°</div>
								<img class="weather_icon" src="images/cloud.png" alt="">
							</div>
							<form action="#">
								<input type="search" class="header_search_input" required="required" placeholder="Type to Search...">
								<img class="header_search_icon" src="images/search.png" alt="">
							</form>
							
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
				<li class="menu_mm"><a href="index.html">home</a></li>
				<li class="menu_mm"><a href="#">Fashion</a></li>
				<li class="menu_mm"><a href="#">Gadgets</a></li>
				<li class="menu_mm"><a href="#">Lifestyle</a></li>
				<li class="menu_mm"><a href="#">Video</a></li>
				<li class="menu_mm"><a href="contact.html">Contact</a></li>
			</ul>
		</nav>
	</div>
	
	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php if (strpos($row_tin['urlHinh'], 'tintuc') == false) 
				{
    				echo 'upload/tintuc/';
				}
					echo $row_tin['urlHinh']
		
					 
						   ?>" data-speed="0.8"></div>
		<div class="home_content">
			<div class="post_category trans_200"><a href="category.html" class="trans_200"><?php $row_tenloaitin = Generate_TenLoaiTin($row_tin['idLT']);
										echo $row_tenloaitin['Ten']; ?></a></div>
			<div class="post_title"><?php echo $row_tin['TieuDe']; ?></div>
		</div>
	</div>
	
	<!-- Page Content -->

	<div class="page_content">
		<div class="container">
			<div class="row row-lg-eq-height">

				<!-- Post Content -->

				<div class="col-lg-9">
					<div class="post_content">

						<!-- Top Panel -->
						<div class="post_panel post_panel_top d-flex flex-row align-items-center justify-content-start">
							<div class="author_image"><div><img src="images/author.jpg" alt=""></div></div>
							<div class="post_meta"><a href="#"><?php $row_tenloaitin = Generate_TenLoaiTin( $row_tin[8]);
										echo $row_tenloaitin['Ten']; ?></a><span><?php echo $row_tin['Ngay'] ?></span></div>
							<div class="post_share ml-sm-auto">
								<span>share</span>
								<ul class="post_share_list">
									<li class="post_share_item"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li class="post_share_item"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li class="post_share_item"><a href="#"><i class="fa fa-google" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>

						<!-- Post Body -->

						<div class="post_body">
							<figure>
								<img src="<?php if (strpos($row_tin['urlHinh'], 'tintuc') == false) 
				{
    				echo 'upload/tintuc/';
				}
					echo $row_tin['urlHinh']
		
					 
						   ?>" alt="">
								<figcaption><?php echo $row_tin['TomTat'] ?></figcaption>
							</figure>
							<?php echo $row_tin['Content'] ?>
							
							

							<!-- 
							<div class="post_tags">
								<ul>
									<li class="post_tag"><a href="#">Liberty</a></li>
									<li class="post_tag"><a href="#">Manual</a></li>
									<li class="post_tag"><a href="#">Interpretation</a></li>
									<li class="post_tag"><a href="#">Recommendation</a></li>
								</ul>
							</div>
						</div>
						Post Tags -->
						<!-- Bottom Panel -->
						<div class="post_panel bottom_panel d-flex flex-row align-items-center justify-content-start">
							<div class="author_image"><div><img src="images/author.jpg" alt=""></div></div>
							<div class="post_meta"><a href="#"><?php $tacgia = viewTacGia($row_tin['idUser']);
echo $tacgia['HoTen'] ?></a><span><?php echo $row_tin['Ngay'] ?></span></div>
							<div class="post_share ml-sm-auto">
								<span>share</span>
								<ul class="post_share_list">
									<li class="post_share_item"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li class="post_share_item"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li class="post_share_item"><a href="#"><i class="fa fa-google" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>

						<!-- Similar Posts -->
						<div class="similar_posts">
							<div class="post_comment_title">Tin liên quan</div>
							<div class="grid clearfix">
								<?php
								$tincungloai = TinCungLoaiTin($idTin,$row_tin['idLT']);
										while($row_tincungloai = mysqli_fetch_array($tincungloai))
										{
								?>
								<!-- Small Card With Image -->
								<div class="card card_small_with_image grid-item">
									<img class="card-img-top" src="<?php if (strpos($row_tincungloai['urlHinh'], 'tintuc') == false) 
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

							<!-- Post Comment -->
							<div class="post_comment">
								<div class="post_comment_title">Đăng bình luận</div>
								<div class="row">
									<div class="col-xl-8">
										<div class="post_comment_form_container">
											<form action="#" method="post">
												<textarea class="comment_text" name="txtComment" placeholder="Comment của bạn" required="required"></textarea>
												<button type="submit" name="btnComment" class="comment_button">Đăng bình luận</button>
											</form>
										</div>
									</div>
								</div>
							</div>

								<?php
									$comment = viewComment($idTin);
									$num_comment = mysqli_num_rows($comment);
								?>
							<!-- Comments -->
							<div class="comments">
								<div class="comments_title">Comments <span>(<?php echo $num_comment ?>)</span></div>
								<div class="row">
									<div class="col-xl-8">
										<div class="comments_container">
											<ul class="comment_list">
												<?php
													while ($row_comment = mysqli_fetch_array($comment))
													 {
														# code...
													
												?>
												<li class="comment">
													<div class="comment_body">
														<div class="comment_panel d-flex flex-row align-items-center justify-content-start">
															<div class="comment_author_image"><div><img style="width: 100%;" src="https://www.warmerwaters.co.uk/wp-content/uploads/2015/08/user-profile-icon.png" alt=""></div></div>
															<small class="post_meta"><a href="#"><?php echo $row_comment['hoten'] ?></a><span><?php echo $row_comment['datetime']  ?></span></small>
															<button type="button" class="reply_button ml-auto">Reply</button>
														</div>
														<div class="comment_content">
															<p><?php echo $row_comment['noidung'] ?></p>
														</div>
													</div>
												</li>
												<?php
													}
												?>
												
											</ul>
										</div>
									</div>
								</div>	
							</div>
						</div>
					</div>
					<div class="load_more">
						<div id="load_more" class="load_more_button text-center trans_200">Load More</div>
					</div>
				</div>
			</div>
				<!-- Sidebar -->

				<div class="col-lg-3">
					<div class="sidebar">
						<div class="sidebar_background"></div>

						<!-- Top Stories -->

						<div class="sidebar_section">
							<div class="sidebar_title_container">
								<div class="sidebar_title">Top Stories</div>
								<div class="sidebar_slider_nav">
									<div class="custom_nav_container sidebar_slider_nav_container">
										<div class="custom_prev custom_prev_top">
											<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
												<polyline fill="#bebebe" points="0,5.61 5.609,0 7,0 7,1.438 2.438,6 7,10.563 7,12 5.609,12 -0.002,6.39 "/>
											</svg>
										</div>
								        <ul id="custom_dots" class="custom_dots custom_dots_top">
											<li class="custom_dot custom_dot_top active"><span></span></li>
											<li class="custom_dot custom_dot_top"><span></span></li>
											<li class="custom_dot custom_dot_top"><span></span></li>
										</ul>
										<div class="custom_next custom_next_top">
											<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
												<polyline fill="#bebebe" points="6.998,6.39 1.389,12 -0.002,12 -0.002,10.562 4.561,6 -0.002,1.438 -0.002,0 1.389,0 7,5.61 "/>
											</svg>
										</div>
									</div>
								</div>
							</div>
							<div class="sidebar_section_content">

								<!-- Top Stories Slider -->
								<div class="sidebar_slider_container">
									<div class="owl-carousel owl-theme sidebar_slider_top">

										<!-- Top Stories Slider Item -->
										<div class="owl-item">

											<!-- Sidebar Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/top_1.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Sidebar Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/top_2.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Sidebar Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/top_3.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Sidebar Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/top_4.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

										</div>

										<!-- Top Stories Slider Item -->
										<div class="owl-item">

											<!-- Sidebar Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/top_1.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Sidebar Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/top_2.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Sidebar Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/top_3.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Sidebar Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/top_4.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

										</div>

										<!-- Top Stories Slider Item -->
										<div class="owl-item">

											<!-- Sidebar Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/top_1.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Sidebar Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/top_2.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Sidebar Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/top_3.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Sidebar Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/top_4.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

										</div>

									</div>
								</div>
							</div>
						</div>

						<!-- Advertising -->

						<div class="sidebar_section">
							<div class="advertising">
								<div class="advertising_background" style="background-image:url(images/post_17.jpg)"></div>
								<div class="advertising_content d-flex flex-column align-items-start justify-content-end">
									<div class="advertising_perc">-15%</div>
									<div class="advertising_link"><a href="#">How Did van Gogh’s Turbulent Mind</a></div>
								</div>
							</div>
						</div>

						<!-- Newest Videos -->

						<div class="sidebar_section newest_videos">
							<div class="sidebar_title_container">
								<div class="sidebar_title">Newest Videos</div>
								<div class="sidebar_slider_nav">
									<div class="custom_nav_container sidebar_slider_nav_container">
										<div class="custom_prev custom_prev_vid">
											<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
												<polyline fill="#bebebe" points="0,5.61 5.609,0 7,0 7,1.438 2.438,6 7,10.563 7,12 5.609,12 -0.002,6.39 "/>
											</svg>
										</div>
								        <ul id="custom_dots" class="custom_dots custom_dots_vid">
											<li class="custom_dot custom_dot_vid active"><span></span></li>
											<li class="custom_dot custom_dot_vid"><span></span></li>
											<li class="custom_dot custom_dot_vid"><span></span></li>
										</ul>
										<div class="custom_next custom_next_vid">
											<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
												<polyline fill="#bebebe" points="6.998,6.39 1.389,12 -0.002,12 -0.002,10.562 4.561,6 -0.002,1.438 -0.002,0 1.389,0 7,5.61 "/>
											</svg>
										</div>
									</div>
								</div>
							</div>
							<div class="sidebar_section_content">

								<!-- Sidebar Slider -->
								<div class="sidebar_slider_container">
									<div class="owl-carousel owl-theme sidebar_slider_vid">

										<!-- Newest Videos Slider Item -->
										<div class="owl-item">

											<!-- Newest Videos Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/vid_1.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Newest Videos Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/vid_2.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Newest Videos Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/vid_3.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Newest Videos Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/vid_4.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

										</div>

										<!-- Newest Videos Slider Item -->
										<div class="owl-item">

											<!-- Newest Videos Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/vid_1.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Newest Videos Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/vid_2.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Newest Videos Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/vid_3.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Newest Videos Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/vid_4.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

										</div>

										<!-- Newest Videos Slider Item -->
										<div class="owl-item">

											<!-- Newest Videos Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/vid_1.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Newest Videos Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/vid_2.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Newest Videos Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/vid_3.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Newest Videos Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="images/vid_4.jpg" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

										</div>

									</div>
								</div>
							</div>
						</div>

						<!-- Advertising 2 -->

						<div class="sidebar_section">
							<div class="advertising_2">
								<div class="advertising_background" style="background-image:url(images/post_18.jpg)"></div>
								<div class="advertising_2_content d-flex flex-column align-items-center justify-content-center">
									<div class="advertising_2_link"><a href="#">Turbulent <span>Mind</span></a></div>
								</div>
							</div>
						</div>

						<!-- Future Events -->

						<div class="sidebar_section future_events">
							<div class="sidebar_title_container">
								<div class="sidebar_title">Future Events</div>
								<div class="sidebar_slider_nav">
									<div class="custom_nav_container sidebar_slider_nav_container">
										<div class="custom_prev custom_prev_events">
											<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
												<polyline fill="#bebebe" points="0,5.61 5.609,0 7,0 7,1.438 2.438,6 7,10.563 7,12 5.609,12 -0.002,6.39 "/>
											</svg>
										</div>
								        <ul id="custom_dots" class="custom_dots custom_dots_events">
											<li class="custom_dot custom_dot_events active"><span></span></li>
											<li class="custom_dot custom_dot_events"><span></span></li>
											<li class="custom_dot custom_dot_events"><span></span></li>
										</ul>
										<div class="custom_next custom_next_events">
											<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
												<polyline fill="#bebebe" points="6.998,6.39 1.389,12 -0.002,12 -0.002,10.562 4.561,6 -0.002,1.438 -0.002,0 1.389,0 7,5.61 "/>
											</svg>
										</div>
									</div>
								</div>
							</div>
							<div class="sidebar_section_content">

								<!-- Sidebar Slider -->
								<div class="sidebar_slider_container">
									<div class="owl-carousel owl-theme sidebar_slider_events">

										<!-- Future Events Slider Item -->
										<div class="owl-item">

											<!-- Future Events Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="event_date d-flex flex-column align-items-center justify-content-center">
															<div class="event_day">13</div>
															<div class="event_month">apr</div>
														</div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Future Events Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="event_date d-flex flex-column align-items-center justify-content-center">
															<div class="event_day">27</div>
															<div class="event_month">apr</div>
														</div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Future Events Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="event_date d-flex flex-column align-items-center justify-content-center">
															<div class="event_day">02</div>
															<div class="event_month">may</div>
														</div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Future Events Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="event_date d-flex flex-column align-items-center justify-content-center">
															<div class="event_day">09</div>
															<div class="event_month">may</div>
														</div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

										</div>

										<!-- Future Events Slider Item -->
										<div class="owl-item">

											<!-- Future Events Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="event_date d-flex flex-column align-items-center justify-content-center">
															<div class="event_day">13</div>
															<div class="event_month">apr</div>
														</div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Future Events Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="event_date d-flex flex-column align-items-center justify-content-center">
															<div class="event_day">27</div>
															<div class="event_month">apr</div>
														</div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Future Events Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="event_date d-flex flex-column align-items-center justify-content-center">
															<div class="event_day">02</div>
															<div class="event_month">may</div>
														</div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Future Events Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="event_date d-flex flex-column align-items-center justify-content-center">
															<div class="event_day">09</div>
															<div class="event_month">may</div>
														</div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

										</div>

										<!-- Future Events Slider Item -->
										<div class="owl-item">

											<!-- Future Events Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="event_date d-flex flex-column align-items-center justify-content-center">
															<div class="event_day">13</div>
															<div class="event_month">apr</div>
														</div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Future Events Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="event_date d-flex flex-column align-items-center justify-content-center">
															<div class="event_day">27</div>
															<div class="event_month">apr</div>
														</div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Future Events Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="event_date d-flex flex-column align-items-center justify-content-center">
															<div class="event_day">02</div>
															<div class="event_month">may</div>
														</div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

											<!-- Future Events Post -->
											<div class="side_post">
												<a href="post.html">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="event_date d-flex flex-column align-items-center justify-content-center">
															<div class="event_day">09</div>
															<div class="event_month">may</div>
														</div>
														<div class="side_post_content">
															<div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
															<small class="post_meta">Katy Liu<span>Sep 29</span></small>
														</div>
													</div>
												</a>
											</div>

										</div>

									</div>
								</div>
							</div>
						</div>

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
						<div class="footer_logo"><a href="#">avision</a></div>
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
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
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
<script src="js/post.js"></script>
</body>
</html>