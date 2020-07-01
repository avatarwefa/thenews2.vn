<?php
require "../lib/dbCon.php";
require "../lib/trangchu.php";
$conn = MyConnect();
ob_start();
session_start();
$idTL = isset($_POST['idTL']) ? (int)$_POST['idTL'] : false;
$page_number = isset($_POST['page_number']) ? (int)$_POST['page_number'] : false;

?>

<div class="grid clearfix">
	<?php
	$TinMoiNhat_10tin = TinMoiNhat_TheoTheLoai_30tin($idTL,30*$page_number);
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