<?php
session_start();
ob_start();

require "../lib/dbCon.php";
require "../lib/trangchu.php";


$tukhoa = $_POST['tukhoa'];



?>
<div class="sidebar_section">
  <div class="sidebar_title_container">
    <div class="sidebar_title">Kết Quả Tìm Kiếm</div>
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
      $runner_timkiem = 0;
      while($runner_timkiem<3)
      {

        ?>
        <!-- Top Stories Slider Item -->
        <div class="owl-item">

          <?php
          $searchresult = TimKiem($tukhoa,$runner_timkiem*3);
          while ( $row_searchresult = mysqli_fetch_array($searchresult)) 
          {
                          # code...

            ?>
            <!-- Sidebar Post -->
            <div class="side_post">
              <a href="post.php?idTin=$row_searchresult['idTin']">
                <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                  <div class="side_post_image"><div><img src="<?php if (strpos($row_searchresult[4], 'tintuc') == false) 
                  {
                    echo 'upload/tintuc/';
                  }
                  echo $row_searchresult[4]
                  

                  ?>" alt=""></div></div>
                  <div class="side_post_content">
                    <div class="side_post_title"><?php echo $row_searchresult[1] ?></div>
                    <small class="post_meta"><?php $tacgia = mysqli_fetch_array(viewTacGia($row_searchresult[6]));
                    echo $tacgia['HoTen'] ?></a><span><?php echo $row_searchresult[5]; ?></span></small>
                  </div>
                </div>
              </a>
            </div>

            <?php
            
          }
          ?>



        </div>

        <?php 

        $runner_timkiem++ ;
      }

      ?>


    </div>
  </div>
</div>
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