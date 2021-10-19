<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

/*
bxSlider : http://bxslider.com/

<?php
$hp_banner_link = "main_banner"; // 게시판이름
$hp_div_width 	= "840";  // slider 삽입공간 px
$hp_img_width 	= $hp_div_width-10;  // 이미지 폭 px = slider 삽입공간 px - 10px
$hp_img_height 	= "430";  // 이미지 높이 px
$hp_title_view	= "1";  // 타이틀 보기 = 1, 안보기 = 2

echo "<div style='width:".$hp_div_width."px'>";
echo latest("hp5_bxslider_01", $hp_banner_link, 15, 25, 1, "$hp_img_width,$hp_img_height,$hp_title_view");
if ($is_admin) { echo "<a href='". G5_BBS_URL ."/board.php?bo_table=". $hp_banner_link ."'>이미지 관리하기 (이미지: 가로 ".$hp_img_width."px, 세로 ".$hp_img_height."px)</a>"; }
echo "</div>";
?>

*/


//옵션분리
list($n_thumb_width, $n_thumb_height, $n_title_view) = explode(",", $options);

if (!$n_thumb_width) {
	$n_thumb_width = 175;  //썸네일 가로 크기
	$n_thumb_height = 103; //썸네일 세로 크기
}

if (!$n_title_view) {
	$n_title_view = 1;
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>
<link rel="stylesheet" href="<?php echo $latest_skin_url; ?>/jquery.bxslider.css">
<script src="<?php echo $latest_skin_url ?>/jquery.bxslider.min.js"></script>

<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->
    <ul class="bxslider">
    <?php 
	$open_url2 = "none";
	$open_url2_link = "";
	
	for ($i=0; $i<count($list); $i++) {  
			// 링크
			$href = G5_BBS_URL."/board.php?bo_table=$bo_table";
			$open_url1 = $href."&wr_id=".$list[$i]['wr_id']; // 게시물의 첫번째 링크값	
			$open_url2 = $href."&wr_id=".$list[$i]['wr_id']; 
			if ($open_url1 == "" || $open_url2 == "none") { 
				//$open_url2_link = "<a href='". $list[$i]['href'] ."'>";
				$open_url2 = "none";
			} else {
				$str2 = substr($open_url1,0,4);
				if ($str2 == "http") { 
					$open_url1 = $open_url1;
					$open_url2_link = "<a href='". $open_url1 ."'>";
				} else {
					$open_url1 = "http://" . $open_url1;
					$open_url2_link = "<a href='". $open_url1 ."'>";
				}
				
				if ($open_url2 == "_blank") {
					$open_url2_link = "<a href='". $open_url1 ."' target='_blank'>";
				} elseif ($open_url2 == "_self") {
					$open_url2_link = "<a href='". $open_url1 ."' target='_blank'>";
				//} elseif ($open_url2 == "none") {
				} else {
					$open_url1_link = "";
					$open_url2_link = "<a href='". $open_url1 ."'>";
				}
			}
	?>
        <li><?php 
            echo $open_url2_link;
            
            $n_thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $n_thumb_width, $n_thumb_height);
            // 스넵이미지 생성하고 뷰어 시킨다.
            $n_noimg = $latest_skin_url."/img/notitle.jpg";
            // 이미지가 없을경우의 이미지 위치
            if($n_thumb['src']) {
                $img_content = '<img src="'.$n_thumb['src'].'" width="'.$n_thumb_width.'" height="'.$n_thumb_height.'" title="'. $list[$i]['wr_subject'].'">';
            } else {
                $img_content = '<img src="'.$n_noimg.'" width="'.$n_thumb_width.'" height="'.$n_thumb_height.'" title="'. $list[$i]['wr_subject'] .'">';
            }
            echo $img_content;
            
            if ($open_url2 == "none") { } else { echo "</a>"; } 
			
            $open_url2 = "none";
			$open_url2_link = "";
        ?></li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li>게시물이 없습니다.</li>
    <?php }  ?>
    </ul>

<script>
$('.bxslider').bxSlider({
  auto: true,
  <?php if ($n_title_view == 1) { ?>
  captions: true,
  <?php } ?>
  slideWidth: 360,

  mode: 'fade'
});
</script>

<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->