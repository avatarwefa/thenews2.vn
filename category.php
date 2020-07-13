<?php
if (isset($_GET["idTL"]))
{
	$idTL = $_GET["idTL"];
	settype($idTin,"int");
}
else
{
	$idTL = 0;
}
	require "lib/dbCon.php";
	require "lib/trangchu.php";
	$conn = MyConnect();
	ob_start();
	session_start();
	$page_number = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>The News | Thể Loại</title>
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
<link rel="stylesheet" type="text/css" href="styles/category.css">
<link rel="stylesheet" type="text/css" href="styles/category_responsive.css">


<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script type="text/javascript">

	var page_number = 0;
 	$(document).ready(function()
{
	$('#btnNext').click(function()
	{

		$('#category_section').load('pages/category_loadmore.php',{idTL: <?php echo $idTL ?>, page_number: ++page_number  });
	})
	
});

 	$(document).ready(function()
{
	$('#btnPrevious').click(function()
	{
		if(page_number == 0)
		{
			alert('Đây đã là trang đầu tiên!');
			return false;
		}
		$('#category_section').load('pages/category_loadmore.php',{idTL: <?php echo $idTL ?>, page_number: --page_number });
	})
	
});
 	
 </script>

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
							<form action="#" method="post">
								<input type="search" class="header_search_input"  required="required" placeholder="Type to Search...">

								<img class="header_search_icon" src="images/search.png" alt="" name="btnSearch" type="submit">
								<button  value="Search"  class="btn btn-outline-secondary" id="icon_search_web" type="button" >Tìm</button>
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
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/logo.jpg" data-speed="0.8"></div>
	</div>
	
	<!-- Page Content -->

	<div class="page_content">
		<div class="container">
			<div class="row row-lg-eq-height">

				<!-- Main Content -->

				<div class="col-lg-9">
					<div class="main_content">

						<!-- Category -->

						<div class="category">
							<div class="section_panel d-flex flex-row align-items-center justify-content-start">
								<div class="section_title"><?php
								if ($idTL == 0)
								{
									echo "Tổng Hợp";
								}
								else
								{
								 echo view_TenTheLoai($idTL)['TenTL'];
								}
								 ?></div>
								
								
								<div class="section_tags ml-auto">
									<ul>

										<!-- Ajax Right Here -->
										<li  <?php if($idTL == 0) echo 'class="active"' ?>><a href="category.php">all</a></li>
										<?php

										$list_theloai = DanhSachTheLoai1();
										while($row_list_theloai = mysqli_fetch_array($list_theloai))
											{

										?>
										<li <?php if($idTL==$row_list_theloai['idTL']) echo 'class="active"' ?>><a type="button" id="btnCategory" href="category.php?idTL=<?php echo $row_list_theloai['idTL'] ?>"> <?php echo $row_list_theloai['TenTL'] ?> </a></li>
										<?php
											}
										?>
									</ul>
								</div>
								<div class="section_panel_more">
									<ul>
										<li>more
											<ul>
												<?php

										$list_theloai2 = DanhSachTheLoai2();
										while($row_list_theloai2 = mysqli_fetch_array($list_theloai2))
											{

										?>
												<li><a href="category.php?idTL=<?php echo $row_list_theloai2['idTL'] ?>"><?php echo $row_list_theloai2['TenTL'] ?></a></li>
												<?php
													}
												?>
											</ul>
										</li>
									</ul>
								</div>
							</div>
							<div class="section_content" id="category_section">
								<div class="grid clearfix">
									<?php
										$TinMoiNhat_10tin = TinMoiNhat_TheoTheLoai($idTL);
										$row_TinMoiNhat_10tin = mysqli_fetch_all($TinMoiNhat_10tin);
										$runner_10tin = 0;
										# code...
									?>

									


									<?php
									 while ($runner_10tin<28)
									 {
									?>
									<div class="card card_largest_with_image grid-item">
										<img class="card-img-top" src="<?php if (strpos($row_TinMoiNhat_10tin[$runner_10tin][4], 'tintuc') == false) 
											{
							    				echo 'upload/tintuc/';
											}
												echo $row_TinMoiNhat_10tin[$runner_10tin][4]
									
												 
													   ?>" alt="https://www.rbs.ca/wp-content/themes/rbs/images/news-placeholder.png">
										<div class="card-body">
											<div class="card-title"><a href="post.php?idTin=<?php echo $row_TinMoiNhat_10tin[$runner_10tin][0] ?>"><?php echo $row_TinMoiNhat_10tin[$runner_10tin][1] ?></a></div>
											<p class="card-text"><?php echo $row_TinMoiNhat_10tin[$runner_10tin][3] ?></p>
											<small class="post_meta"><a href="#"><?php $row_tenloaitin = Generate_TenLoaiTin($row_TinMoiNhat_10tin[$runner_10tin][8]);
										echo $row_tenloaitin['Ten']; ?></a><span><?php echo $row_TinMoiNhat_10tin[$runner_10tin][5]; $runner_10tin++; ?></span></small>
										</div>
									</div>
									<!-- Small Card Without Image -->
									<div class="card card_default card_small_no_image grid-item">
										<div class="card-body">
											<div class="card-title card-title-small"><a href="post.php<?php echo $row_TinMoiNhat_10tin[$runner_10tin][0] ?>"><?php echo $row_TinMoiNhat_10tin[$runner_10tin][1] ?></a></div>
											<small class="post_meta"><a href="#"><?php $row_tenloaitin = Generate_TenLoaiTin($row_TinMoiNhat_10tin[$runner_10tin][8]);
										echo $row_tenloaitin['Ten']; ?><?php echo $row_TinMoiNhat_10tin[$runner_10tin][5]; $runner_10tin++; ?></span></small>
										</div>
									</div>

									<!-- Small Card With Background -->
									<div class="card card_default card_small_with_background grid-item">
										<div class="card_background" style="background-image:url('<?php if (strpos($row_TinMoiNhat_10tin[$runner_10tin][4], 'tintuc') == false) 
											{
							    				echo 'upload/tintuc/';
											}
												echo $row_TinMoiNhat_10tin[$runner_10tin][4]
									
												 
													   ?>')"></div>
										<div class="card-body">
											<div class="card-title card-title-small"><a href="post.php?idTin=<?php echo $row_TinMoiNhat_10tin[$runner_10tin][0] ?>"><?php echo $row_TinMoiNhat_10tin[$runner_10tin][1] ?></a></div>
											<small class="post_meta"><a href="#"><?php $row_tenloaitin = Generate_TenLoaiTin($row_TinMoiNhat_10tin[$runner_10tin][8]);
										echo $row_tenloaitin['Ten']; ?></a><span><?php echo $row_TinMoiNhat_10tin[$runner_10tin][5]; $runner_10tin++; ?></span></small>
										</div>
									</div>

									<!-- Small Card With Image -->
									<div class="card card_small_with_image grid-item">
										<img class="card-img-top" src="<?php if (strpos($row_TinMoiNhat_10tin[$runner_10tin][4], 'tintuc') == false) 
				{
    				echo 'upload/tintuc/';
				}
					echo $row_TinMoiNhat_10tin[$runner_10tin][4]
		
					 
						   ?>" alt="">
										<div class="card-body">
											<div class="card-title card-title-small"><a href="post.php?idTin=<?php echo $row_TinMoiNhat_10tin[$runner_10tin][0] ?>"><?php echo $row_TinMoiNhat_10tin[$runner_10tin][1] ?></a></div>
											<small class="post_meta"><a href="#"><?php $row_tenloaitin = Generate_TenLoaiTin($row_TinMoiNhat_10tin[$runner_10tin][8]);
										echo $row_tenloaitin['Ten']; ?></a><span><?php echo $row_TinMoiNhat_10tin[$runner_10tin][5]; $runner_10tin++; ?></span></small>
										</div>
									</div>

									<?php
										}
									?>


									<!-- Small Card With Image -->
									

								</div>
							</div>
						</div>

					</div>


					
						<div class="load_more">
							
							<div id="load_more" style="float: left;margin-bottom: 50px;" class="load_more_button text-center trans_200"><button type="button" id="btnPrevious" class="btn btn-light">Trước</button></div>
							<div id="load_more" style="float: right; margin-bottom: 50px;" class="load_more_button text-center trans_200"><button type="button" id="btnNext" class="btn btn-light">Tiếp</button></div>
						</div>


				</div>

				<!-- Sidebar -->

				<div class="col-lg-3">
					<div class="sidebar">
						<div class="sidebar_background"></div>

						<!-- Top Stories -->

						<div id="SearchResult">
							<!-- Top Stories -->
						<div class="sidebar_section">
								<div class="sidebar_title_container">
									<div class="sidebar_title">Tin được quan tâm</div>
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

								<?php
								$runner_topstories = 0;
								while($runner_topstories<3)
								{

									?>
									<!-- Top Stories Slider Item -->
									<div class="owl-item">

										<?php
										$topstories = TinXemNhieuNhat($runner_topstories*6);
										while ( $row_topstories = mysqli_fetch_array($topstories)) 
										{
													# code...

											?>
											<!-- Sidebar Post -->
											<div class="side_post">
												<a href="post.php?idTin=<?php echo $row_topstories['idTin']?>">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="side_post_image"><div><img src="<?php if (strpos($row_topstories[4], 'tintuc') == false) 
														{
															echo 'upload/tintuc/';
														}
														echo $row_topstories[4]
														

														?>" alt=""></div></div>
														<div class="side_post_content">
															<div class="side_post_title"><?php echo $row_topstories[1] ?></div>
															<small class="post_meta"><?php $row_tenloaitin = Generate_TenLoaiTin($row_topstories['idLT']);
										echo $row_tenloaitin['Ten']; ?></a><span><?php echo $row_topstories[5]; ?></span></small>
														</div>
													</div>
												</a>
											</div>

											<?php
											
										}
										?>



									</div>

									<?php 

									$runner_topstories++ ;
								}

								?>


							</div>
						</div>
					</div>



					<!-- Login/Signup -->
					<div class="sidebar_section newest_videos">
							<div class="sidebar_title_container">
								<div class="sidebar_title">Login/Signup</div>
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
										<?php
										if (!isset($_SESSION[
											'idUser']))
										{
											require('login/login.php');
										}
										else
										{
											require('login/hello.php');
										}
										?>
										<!-- Newest Videos Slider Item -->
										

										<!-- Newest Videos Slider Item -->
										

											

										

									</div>
								</div>
							</div>
						</div>

						<!-- Advertising -->

						<?php
							$QuangCao1 = QuangCao(1);
							$row_QuangCao = mysqli_fetch_all($QuangCao1);
						?>

						<div class="sidebar_section">
							<div class="advertising">
								<div class="advertising_background" style="background-image:url(<?php echo $row_QuangCao[0][4] ?>)"></div>
								<div class="advertising_content d-flex flex-column align-items-start justify-content-end">
									<div class="advertising_perc">SALE</div>
									<div class="advertising_link"><a href="<?php echo $row_QuangCao[0][3] ?>"> <?php echo $row_QuangCao[0][2] ?></a></div>
								</div>
							</div>
						</div>


						<!-- Advertising 2 -->

						<div class="sidebar_section">
							<div class="advertising_2">
								<div class="advertising_background" style="background-image:url(<?php echo $row_QuangCao[1][4] ?>)"></div>
								<div class="advertising_2_content d-flex flex-column align-items-center justify-content-center">
									<div class="advertising_2_link"><a href="<?php echo $row_QuangCao[1][3] ?>"> <span><?php echo $row_QuangCao[1][2] ?> </span></a></div>
								</div>
							</div>
						</div>

						<!-- Future Events -->
						<?php
						$calendarList = json_decode(file_get_contents('https://www.googleapis.com/calendar/v3/calendars/vi.vietnamese%23holiday%40group.v.calendar.google.com/events?key=AIzaSyDmJxrtjp0Us2y09ORhdaHhRzFdPBoygr4'));
						$today_dt = date("Y-m-d");
						$calendar= array();
						foreach($calendarList->items as $item)
						{
							if ($item->start->date >= $today_dt)
							{
								array_push($calendar, $item);
							}
						}


						?>

						<div class="sidebar_section future_events">
							<div class="sidebar_title_container">
								<div class="sidebar_title">Sự kiện/ Ngày lễ</div>
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

											<?php
											$runner_national_holiday = 0;
											while($runner_national_holiday<4)
											{
											?>
											<!-- Future Events Post -->
											<div class="side_post">
												<a href="post.php">
													<div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
														<div class="event_date d-flex flex-column align-items-center justify-content-center">
															<div class="event_day"><?php echo date('d', strtotime($calendar[$runner_national_holiday]->start->date)); ?></div>
															<div class="event_month"><?php echo date('m', strtotime($calendar[$runner_national_holiday]->start->date)); ?></div>
														</div>
														<div class="side_post_content">
															<div class="side_post_title"><?php echo $calendar[$runner_national_holiday]->summary;  ?> </div>
															<small class="post_meta"><span><?php echo $calendar[$runner_national_holiday]->creator->displayName ?></span></small>
														</div>
													</div>
												</a>
											</div>
											<?php
											$runner_national_holiday++;
											}
											?>

											

										</div>

										<!-- Future Events Slider Item -->
										<div class="owl-item">

											<!-- Future Events Post -->
											<div class="side_post">
												<a href="post.php">
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
												<a href="post.php">
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
												<a href="post.php">
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
												<a href="post.php">
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

						<div class="sidebar_section">
									<div class="advertising_2">
										<div class="advertising_background" style="background-image:url(<?php echo $row_QuangCao[2][4] ?>)"></div>
										<div class="advertising_2_content d-flex flex-column align-items-center justify-content-center">
											<div class="advertising_2_link"><a href="<?php echo $row_QuangCao[2][3] ?>"> <span><?php echo $row_QuangCao[2][2] ?> </span></a></div>
										</div>
									</div>
								</div>
								<div class="sidebar_section">
									<div class="advertising_2">
										<div class="advertising_background" style="background-image:url(<?php echo $row_QuangCao[3][4] ?>)"></div>
										<div class="advertising_2_content d-flex flex-column align-items-center justify-content-center">
											<div class="advertising_2_link"><a href="<?php echo $row_QuangCao[3][3] ?>"> <span><?php echo $row_QuangCao[3][2] ?> </span></a></div>
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
						<div class="footer_logo"><a href="#">TheNews</a></div>
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
<script src="js/category.js"></script>
</body>
</html>