<?php
//session_start();
//ob_start();

require "lib/dbCon.php";
require "lib/trangchu.php";
$conn = MyConnect();
ob_start();
session_start();
?>

<?php

if (isset($_POST["btnLogin"]))
{

  $user = $_POST["txtUser"];
  $pass = $_POST["txtPass"];

$qr1 = 
  "
    select * from users
    where users.Username = '$user'
    
  ";
	$result = mysqli_query($conn,$qr1);
  $row_user = mysqli_fetch_array($result);
  if ($user == $row_user['Username'] && md5($pass) == $row_user['Password'])
  {
  	$_SESSION['idUser']= $row_user['idUser'];
    $_SESSION["Username"] = $row_user['Username'];
    $fullname = $row_user['HoTen'];
    $_SESSION["Password"] = $row_user['Password'];
    $_SESSION["HoTen"] = $row_user['HoTen'];
    $_SESSION["Email"] =$row_user['Email'];
    $_SESSION["idGroup"] = $row_user['idGroup'];
        echo "<script> alert('Welcome $fullname');
window.setTimeout(function(){


    window.location.href = 'index.php';

}, 3000);
</script>";

  }
    

else
{
  echo "<script type='text/javascript'>alert('Đăng Nhập Thất Bại, Thử Lại Sau');</script>";

}
}

?>
<?php
if (isset($_POST["btnSignup"]))
{

    $flag = 0;
    $username = $_POST["txtUsername"];
    $password = $_POST["txtPassword"];
    $retypepassword = $_POST["txtRePassword"];
    $fullname = $_POST["txtFullName"];
    $email = $_POST["txtEmail"];
    $idgroup = 0;
    $qr1 = 
          "
            select * from users
            where users.Username = '$username' or users.Email = '$email'
            
          ";
  $result = mysqli_query($conn,$qr1);
    
if ($username == "" || $password == "" || $fullname == "")
{
    $flag = 1;
    echo "<script type='text/javascript'>alert('Hãy điền đủ các thông tin khi đăng kí, Cám ơn');</script>";
}
if ( $password != $retypepassword  && $flag == 0 )
{
    $flag = 1;
    echo "<script type='text/javascript'>alert('Mật khẩu bạn nhập cần trùng khớp nhau');</script>";
}
if (mysqli_num_rows($result) > 0 && $flag == 0)
{
        $flag = 1;
    echo "<script type='text/javascript'>alert('Tên đăng nhập đã có người sở hữu! Hãy thay bằng tên khác!');</script>";
}
if ($flag == 0)
{
	$password = md5($password);
 echo $qr = "
  INSERT INTO users VALUES
  (null, '$fullname','$username','$password', '$email' , '$idgroup')
  ";
 echo mysqli_query($conn,$qr);

  	$_SESSION["Username"] = $username;
    $_SESSION["Password"] = $password;
    $_SESSION["HoTen"] = $fullname;
    $_SESSION["Email"] =$email;
    $_SESSION["idGroup"] = $idgroup;

        echo "<script> alert('Đăng kí thành công $fullname! Bạn sẽ đăng nhập với tài khoản vừa tạo');
window.setTimeout(function(){


    window.location.href = 'index.php';

}, 3000);
</script>";

}

}
?>

<?php
if (isset($_POST["btnSignOut"]))
{
	unset($_SESSION["idUser"]);
	unset($_SESSION["Password"]);
	unset($_SESSION["Username"]);
	unset($_SESSION["Email"]);
	unset($_SESSION["HoTen"]);
	unset($_SESSION["idGroup"]);

	echo "<script> alert('Đăng xuất khỏi TheNews thành công!');
window.setTimeout(function(){


    window.location.href = 'index.php';

}, 3000);
</script>";
}
?>


<?php
	if(isset($_POST["btnManage"])){
		header("location:./admin1/index.php");
	}
?>

<!DOCTYPE html>
<php lang="en">
<head>
<title>TheNews</title>
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
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">

<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script type="text/javascript">
 	$(document).ready(function()
{
	$('#icon_search_web').click(function()
	{
		$('#SearchResult').load('plugins/search.php',{tukhoa: $('.header_search_input').val() });
	})
	
});

 	<?php
 		$list_theloai_ajax = DanhSachTheLoai();
 		
 		while($row_list_theloai_ajax = mysqli_fetch_array($list_theloai_ajax))
 		{

 	?>
 	$(document).ready(function()
{
	$('#btnCategory<?php echo $row_list_theloai_ajax['idTL'] ?>').click(function()
	{
		$('#category_ajax').load('pages/category_pagination.php',{idTL: <?php echo $row_list_theloai_ajax['idTL'] ?> });
	})
	
});

 	<?php
 		}
 	?>

 	<?php
 	?>

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
						<div class="logo"><a href="#">TheNews</a></div>
						<nav class="main_nav">
							<ul>
								<li class="active"><a href="index.php">Trang Chủ</a></li>
								<li><a href="category.php">Thể Loại</a></li>
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
		<div class="logo menu_mm"><a href="index.php">TheNews</a></div>
		<div class="search">
			<form action="#">
				<input type="search" class="header_search_input menu_mm" required="required" placeholder="Type to Search...">
				<img class="header_search_icon menu_mm" src="images/search_2.png" alt="">
			</form>
		</div>
		<nav class="menu_nav">
			<ul class="menu_mm">
				<li class="active"><a href="index.php">Trang Chủ</a></li>
				<li><a href="category.php">Thể Loại</a></li>
				<li><a href="editProfile.php">Thông tin tài khoản</a></li>
				<li><a href="https://www.youtube.com/channel/UCabsTV34JwALXKGMqHpvUiA">Youtube</a></li>
				<li><a href="contact.php">Liên Hệ</a></li>
			</ul>
		</nav>
	</div>
	
	<!-- Home -->

	<div class="home">
		
		<!-- Home Slider -->

		<div class="home_slider_container">
			<div class="owl-carousel owl-theme home_slider">
				
				<?php
				$tinhotnhat_batin = TinHotNhat_BaTin();
				$tinhotnhat_batin_phu = TinHotNhat_BaTin();
				$row_tieptheo = mysqli_fetch_all($tinhotnhat_batin_phu);
				
				$runner = 0; 
				while($row_tinhotnhat_batin = mysqli_fetch_array($tinhotnhat_batin))
				{
				
				?>

				<!-- Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url('<?php if (strpos($row_tinhotnhat_batin['urlHinh'], 'tintuc') == false) 
				{
    				echo 'upload/tintuc/';
				}
					echo $row_tinhotnhat_batin['urlHinh']
		
					 
						   ?>')">
						   	
						   </div>
						   <?php

										$row_tenloaitin = Generate_TenLoaiTin($row_tinhotnhat_batin['idLT']);
										echo $row_tenloaitin['Ten'];

										
							?>
					<div class="home_slider_content_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_slider_content">
										<div class="home_slider_item_category trans_200"><a href="category.php?<?php echo $row_tinhotnhat_batin['idTL'] ?>" class="trans_200">
											</a></div>
										<div class="home_slider_item_title">
											<a href="post.php?idTin=<?php echo $row_tinhotnhat_batin['idTin'] ?>"><?php echo $row_tinhotnhat_batin['TieuDe'] ?></a>
										</div>
										<div class="home_slider_item_link">
											<a href="post.php?idTin=<?php echo $row_tinhotnhat_batin['idTin'] ?>" class="trans_200"><?php echo $row_tinhotnhat_batin['TomTat'] ?>
												<svg version="1.1" id="link_arrow_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
													 width="19px" height="13px" viewBox="0 0 19 13" enable-background="new 0 0 19 13" xml:space="preserve">
													<polygon fill="#FFFFFF" points="12.475,0 11.061,0 17.081,6.021 0,6.021 0,7.021 17.038,7.021 11.06,13 12.474,13 18.974,6.5 "/>
												</svg>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Similar Posts -->
					<div class="similar_posts_container">
						<div class="container">
							<div class="row d-flex flex-row align-items-end">

								<?php
									$tinmoinhat_batin = TinMoiNhat_BaTin($runner*3);
									while($row_tinmoinhat_batin = mysqli_fetch_array($tinmoinhat_batin))
									{
								?>
								<!-- Similar Post -->
								<div class="col-lg-3 col-md-6 similar_post_col">
									<div class="similar_post trans_200">
										<a href="post.php?idTin=<?php echo $row_tinmoinhat_batin['idTin']; ?>"><?php echo $row_tinmoinhat_batin['TieuDe']; ?></a>
									</div>
								</div>

								<?php
								
									}
								?>

							</div>
						</div>
						<?php

							

						?>
						
						<div class="home_slider_next_container">
							<div class="home_slider_next" style="background-size:cover;background-image:url('<?php if (strpos($row_tieptheo[($runner+1)%3][4], 'tintuc') == false) 
				{
    				echo 'upload/tintuc/';
				}
					echo $row_tieptheo[($runner+1)%3][4]
		
					 
						   ?>' )">
								<div class="home_slider_next_background trans_400"></div>
								<div class="home_slider_next_content trans_400">
									<div class="home_slider_next_title">next</div>
									<div class="home_slider_next_link"> <?php echo $row_tieptheo[($runner+1)%3][1] ; ?></div>
								</div>
							</div>
						</div>

					</div>
				</div>

				<?php
				$runner = $runner+1;
					}
				?>

			</div>

			<div class="custom_nav_container home_slider_nav_container">
				<div class="custom_prev custom_prev_home_slider">
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
						<polyline fill="#FFFFFF" points="0,5.61 5.609,0 7,0 7,1.438 2.438,6 7,10.563 7,12 5.609,12 -0.002,6.39 "/>
					</svg>
				</div>
		        <ul id="custom_dots" class="custom_dots custom_dots_home_slider">
					<li class="custom_dot custom_dot_home_slider active"><span></span></li>
					<li class="custom_dot custom_dot_home_slider"><span></span></li>
					<li class="custom_dot custom_dot_home_slider"><span></span></li>
				</ul>
				<div class="custom_next custom_next_home_slider">
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
						<polyline fill="#FFFFFF" points="6.998,6.39 1.389,12 -0.002,12 -0.002,10.562 4.561,6 -0.002,1.438 -0.002,0 1.389,0 7,5.61 "/>
					</svg>
				</div>
			</div>

		</div>
	</div>
	
	<!-- Page Content -->

	<div class="page_content">
		<div class="container">
			<div class="row row-lg-eq-height">

				<!-- Main Content -->

				<div class="col-lg-9">
					<div class="main_content">

						<!-- Blog Section - Don't Miss -->

						<div class="blog_section" id="latest_news">
							<div class="section_panel d-flex flex-row align-items-center justify-content-start">
								<div class="section_title">Tin Mới Nhất</div>
								<div class="section_tags ml-auto">
									<ul>

										<!-- Ajax Right Here -->
										<li class="active"><a href="category.php?idTL=0">all</a></li>
										<?php

										$list_theloai = DanhSachTheLoai1();
										while($row_list_theloai = mysqli_fetch_array($list_theloai))
										{

											?>
											<li><a type="button" id="btnCategory<?php echo $row_list_theloai['idTL'] ?>" href="#latest_news"> <?php echo $row_list_theloai['TenTL'] ?> </a></li>
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
													<li><a type="button" id="btnCategory<?php echo $row_list_theloai2['idTL'] ?>" href="#latest_news"> <?php echo $row_list_theloai2['TenTL'] ?> </a></li>
													<?php
												}
												?>
											</ul>
										</li>
									</ul>
								</div>
							</div>
							<div class="section_content" id="category_ajax">
								<div class="grid clearfix">
									<?php
									$TinMoiNhat_10tin = TinMoiNhat_10tin();
									$row_TinMoiNhat_10tin = mysqli_fetch_all($TinMoiNhat_10tin);
									$runner_10tin = 0;
										# code...
									?>


									<!-- Largest Card With Image -->
									<div class="card card_largest_with_image grid-item">
										<img class="card-img-top" src="<?php if (strpos($row_TinMoiNhat_10tin[$runner_10tin][4], 'tintuc') == false) 
										{
											echo 'upload/tintuc/';
										}
										echo $row_TinMoiNhat_10tin[$runner_10tin][4]


										?>" alt="https://unsplash.com/@cjtagupa">
										<div class="card-body">
											<div class="card-title"><a href="post.php?idTin=<?php echo $row_TinMoiNhat_10tin[$runner_10tin][0] ?>"><?php echo $row_TinMoiNhat_10tin[$runner_10tin][1] ?></a></div>
											<p class="card-text"><?php echo $row_TinMoiNhat_10tin[$runner_10tin][3] ?></p>
											<small class="post_meta"><a href="#"><?php $row_tenloaitin = Generate_TenLoaiTin($row_TinMoiNhat_10tin[$runner_10tin][8]);
										echo $row_tenloaitin['Ten']; ?></a><span><?php echo $row_TinMoiNhat_10tin[$runner_10tin][5]; $runner_10tin++; ?></span></small>
										</div>
									</div>
									

									<?php
									while ($runner_10tin<9)
									{
										?>
										<!-- Small Card Without Image -->
										<div class="card card_default card_small_no_image grid-item">
											<div class="card-body">
												<div class="card-title card-title-small"><a href="post.php<?php echo $row_TinMoiNhat_10tin[$runner_10tin][0] ?>"><?php echo $row_TinMoiNhat_10tin[$runner_10tin][1] ?></a></div>
												<small class="post_meta"><a href="#"><?php $row_tenloaitin = Generate_TenLoaiTin($row_TinMoiNhat_10tin[$runner_10tin][8]);
										echo $row_tenloaitin['Ten']; ?></a><span><?php echo $row_TinMoiNhat_10tin[$runner_10tin][5]; $runner_10tin++; ?></span></small>
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
									

								</div>
							</div>
						</div>
						
						

						<!-- Blog Section - Videos -->
						<?php
							$API_key    = 'AIzaSyDmJxrtjp0Us2y09ORhdaHhRzFdPBoygr4';
							$channelID  = 'UCabsTV34JwALXKGMqHpvUiA';
							$maxResults = 4;

							$videoList = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelID.'&maxResults='.$maxResults.'&key='.$API_key.''));

						    //Embed video
						   
						?>

						<div class="blog_section" id="sectionVideo">
							<div class="section_panel d-flex flex-row align-items-center justify-content-start">
								<div class="section_title">Thời sự Video</div>
							</div>
							<div class="section_content">
								<div class="row">
									<div class="col">
										<div class="videos">
											<div class="player_container">
												<div id="P1" class="player" 
												     data-property="{videoURL:'2ScS5kwm7nI',containment:'self',startAt:0,mute:false,autoPlay:false,loop:false,opacity:1}">
												</div>
											</div>
											<div class="playlist">
												<div class="playlist_background"></div>
												<?php

													foreach($videoList->items as $item)
													{

												?>
												<!-- Video -->
												<div class="video_container video_command active" onclick="jQuery('#P1').YTPChangeVideo({videoURL: '<?php echo $item->id->videoId ?>', mute:false, addRaster:true})">
													<div class="video d-flex flex-row align-items-center justify-content-start">
														<div class="video_image"><div><img src="<?php echo $item->snippet->thumbnails->default->url ?>" alt=""></div><img class="play_img" src="<?php echo $item->snippet->thumbnails->default->url ?>" alt=""></div>
														<div class="video_content">
															<div class="video_title"><?php echo $item->snippet->title ?></div>
															<div class="video_info"><span></span><span><?php echo $item->snippet->publishedAt ?></span></div>
														</div>
													</div>
												</div>
												<?php
													}
												?>

												

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


						<!-- Blog Section - Tin Tức Thế Giới -->

						<div class="blog_section">
							<div class="section_panel d-flex flex-row align-items-center justify-content-start">
								<div class="section_title">Tin Tức Thế Giới</div>

								<div class="section_tags ml-auto">
									<ul>
										<?php
										$loaitin_theloai = DanhSachLoaiTin_Theo_TheLoai1(2);
										while($row_loaitin_theloai = mysqli_fetch_array($loaitin_theloai))
										{
										?>
										<li class="active"><a href="category.php"><?php echo $row_loaitin_theloai['Ten']  ?></a></li>

										<?php
										}
										?>
									</ul>
								</div>
								<div class="section_panel_more">
									<ul>
										<li>Xem Thêm
											<ul>
												<?php
										$loaitin_theloai = DanhSachLoaiTin_Theo_TheLoai2(2);
										while($row_loaitin_theloai = mysqli_fetch_array($loaitin_theloai))
										{
										?>
										<li><a href="category.php"><?php echo $row_loaitin_theloai['Ten']  ?></a></li>

										<?php
										}
										?>
												
											</ul>
										</li>
									</ul>
								</div>
							</div>
							<div class="section_content">
								<div class="grid clearfix">
									<?php
									$TinTheoTheLoai = TinTheoTheLoai(2);
									$runner_TinTheoTheLoai = 0;
									$row_TinTheoTheLoai = mysqli_fetch_all($TinTheoTheLoai);
									while ($runner_TinTheoTheLoai < 9) {
										# code...
									
									?>
									<!-- Large Card With Background -->
									<div class="card card_large_with_background grid-item">
										<div class="card_background" style="background-image:url('<?php if (strpos($row_TinTheoTheLoai[$runner_TinTheoTheLoai][4], 'tintuc') == false) 
										{
						    				echo 'upload/tintuc/';
										}
											echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][4]
								
											 
												   ?>')"></div>
										<div class="card-body">
											<div class="card-title"><a href="post.php?idTin=<?php echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][0] ?>"><?php echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][1] ?></a></div>
											<small class="post_meta"><a href="#"><?php $row_tenloaitin = Generate_TenLoaiTin($row_TinTheoTheLoai[$runner_TinTheoTheLoai][8]);
										echo $row_tenloaitin['Ten']; ?></a><span><?php echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][5]; $runner_TinTheoTheLoai++; ?></span></small>
										</div>
									</div>
									
									<!-- Large Card With Image -->
									<div class="card grid-item card_large_with_image">
										<img class="card-img-top" src="<?php if (strpos($row_TinTheoTheLoai[$runner_TinTheoTheLoai][4], 'tintuc') == false) 
										{
						    				echo 'upload/tintuc/';
										}
											echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][4]
								
											 
												   ?>" alt="">
										<div class="card-body">
											<div class="card-title"><a href="post.php?idTin=<?php echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][0] ?>"><?php echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][1] ?></a></div>
											<p class="card-text"><?php echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][3] ?></p>
											<small class="post_meta"><a href="#"><?php $row_tenloaitin = Generate_TenLoaiTin($row_TinTheoTheLoai[$runner_TinTheoTheLoai][8]);
										echo $row_tenloaitin['Ten']; ?></a><span><?php echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][5]; $runner_TinTheoTheLoai++; ?></span></small>
										</div>
									</div>

									<!-- Default Card With Image -->
									<div class="card card_small_with_image grid-item">
										<img class="card-img-top" src="<?php if (strpos($row_TinTheoTheLoai[$runner_TinTheoTheLoai][4], 'tintuc') == false) 
										{
						    				echo 'upload/tintuc/';
										}
											echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][4]
								
											 
												   ?>" alt="">
										<div class="card-body">
											<div class="card-title card-title-small"><a href="post.php?idTin=<?php echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][0] ?>"><?php echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][1] ?></a></div>
											<small class="post_meta"><a href="#"><?php $row_tenloaitin = Generate_TenLoaiTin($row_TinTheoTheLoai[$runner_TinTheoTheLoai][8]);
										echo $row_tenloaitin['Ten']; ?></a><span><?php echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][5]; $runner_TinTheoTheLoai++; ?></span></small>
										</div>
									</div>
									
									<!-- Default Card With Background -->

									<div class="card card_default card_default_with_background grid-item">
										<div class="card_background" style="background-image:url('<?php if (strpos($row_TinTheoTheLoai[$runner_TinTheoTheLoai][4], 'tintuc') == false) 
										{
						    				echo 'upload/tintuc/';
										}
											echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][4]
								
											 
												   ?>')"></div>
										<div class="card-body">
											<div class="card-title card-title-small"><a href="post.php?idTin=<?php echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][0] ?>"><?php echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][1]; $runner_TinTheoTheLoai++;?></a></div>
										</div>
									</div>

									<!-- Default Card No Image -->
									<div class="card card_default card_default_no_image grid-item">
										<div class="card-body">
											<div class="card-title card-title-small"><a href="post.php?idTin=<?php echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][0] ?>"><?php echo $row_TinTheoTheLoai[$runner_TinTheoTheLoai][1]; $runner_TinTheoTheLoai++; ?> </a></div>
										</div>
									</div>

									<?php
									}
									?>

								</div>
								
							</div>
						</div>





					<!--	
					</div>
					<div class="load_more">
						<div id="load_more" class="load_more_button text-center trans_200">Load More</div>
					</div>
				
-->
				<!-- Sidebar -->

				</div>
			</div>

				<div class="col-lg-3">
					<div class="sidebar">
						<div class="sidebar_background"></div>

						<!-- -->
						<div id="SearchResult" style="max-height: 75vh;">
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
				</div>
						</div>
						


						
					


						<!-- Newest login -->

						<div class="sidebar_section newest_videos" id="sectionSignIn" style="max-height: 55vh;">
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
								<div class="sidebar_slider_container" style="max-height: 30vh;">
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
		</div>
	</div>

	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row row-lg-eq-height">
				<div class="col-lg-9 order-lg-1 order-2">
					<div class="footer_content">
						<div class="footer_logo"><a href="#">TheNews.vn</a></div>
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
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#" target="_blank">Từ Ngọc Huy</a>
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
<script src="plugins/jquery.mb.YTPlayer-3.1.12/jquery.mb.YTPlayer.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/masonry/masonry.js"></script>
<script src="plugins/masonry/images_loaded.js"></script>
<script src="js/custom.js"></script>
</body>
</php>