<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/css/style.css">', 0);

?>

<!-- Thema내의 중복사용 주석 처리 -->
<!-- 
<link href="<?=$latest_skin_url?>/css/bootstrap.min.css" rel="stylesheet">
-->
<!-- Thema내의 중복사용 주석 처리 -->

	<link href="<?=$latest_skin_url?>/css/flexslider.css" rel="stylesheet" />
	<link href="<?=$latest_skin_url?>/css/style.css" rel="stylesheet">

<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->

<!-- Section: parallax -->	
	<div id="parallax" class="laB_home-section parallax text-light text-center" data-stellar-background-ratio="0.5">	
           <div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="testimonialslide clearfix flexslider">
							<ul class="slides">
                            
    <?php for ($i=0; $i<count($list); $i++) {  ?>

        <li>
            <?php
           
			echo "<a href=\"".$list[$i]['href']."\"><blockquote>";
            if ($list[$i]['is_notice'])
                echo "<strong><h4>".get_text(strip_tags($list[$i]['wr_content']))."</h4></strong>";
            else
                echo "<blockquote><h4><strong>".get_text(strip_tags($list[$i]['wr_content']))."</strong></h4><blockquote>";

			
            if ($list[$i]['comment_cnt'])
                echo $list[$i]['comment_cnt'];
	
			echo "<p class='la_subject'>".$list[$i]['subject']."</p>";
            echo "</blockquote></a>";
			
             ?>
        </li>

    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
		<li>게시물이 없습니다.</li>
    <?php }  ?>
                   
							</ul>
						</div>					
					</div>	
				</div>
            </div>
	</div>	


    
	<script src="<?=$latest_skin_url?>/js/jquery.flexslider-min.js"></script>
	<script src="<?=$latest_skin_url?>/js/stellar.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?=$latest_skin_url?>/js/custom.js"></script>
    



<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->