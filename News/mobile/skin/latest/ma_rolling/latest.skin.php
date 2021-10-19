<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>
 <!-- Owl Carousel Assets -->
    <link href="<?=$latest_skin_url?>/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="<?=$latest_skin_url?>/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="<?=$latest_skin_url?>/assets/js/google-code-prettify/prettify.css" rel="stylesheet">

    <script src="<?=$latest_skin_url?>/owl-carousel/owl.carousel.js"></script>

			<div id="owl-demo" class="owl-carousel">
				<?php for ($i=0; $i<count($list); $i++) {
				$noimage = "$latest_skin_url/images/notitle.jpg";
				$list[$i][file] =get_file($bo_table, $list[$i][wr_id]);
				$imagepath = $list[$i][file][0][path]."/".$list[$i][file][0][file];
				if($list[$i][file][0][file] ){$img_text=$imagepath;}else{$img_text=$noimage;}
			?>
                <div class="item"><img src="<?=$img_text?>" ></div>
				<? } ?>
              </div>

	<style>
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }
    </style>


    <script>
    $(document).ready(function() {
      $("#owl-demo").owlCarousel({

      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem : true

      // "singleItem:true" is a shortcut for:
      // items : 1, 
      // itemsDesktop : false,
      // itemsDesktopSmall : false,
      // itemsTablet: false,
      // itemsMobile : false

      });
    });
    </script>

    <script src="<?=$latest_skin_url?>/assets/js/bootstrap-collapse.js"></script>
    <script src="<?=$latest_skin_url?>/assets/js/bootstrap-transition.js"></script>
    <script src="<?=$latest_skin_url?>/assets/js/bootstrap-tab.js"></script>

    <script src="<?=$latest_skin_url?>/assets/js/google-code-prettify/prettify.js"></script>
    <script src="<?=$latest_skin_url?>/assets/js/application.js"></script>
