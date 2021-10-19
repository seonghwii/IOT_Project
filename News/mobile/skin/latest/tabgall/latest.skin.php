<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_LIB_PATH.'/thumbnail.lib.php'); // 탭라이브러리

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

$thumb_w = 137;  //썸네일 가로 크기
$thumb_h = 137; //썸네일 세로 크기
//$cont_txt_max = 90; //게시판 글 내용 최대 글자 수
?>
<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->

<div id="tabgall">
  <ul>
    <?php for ($i=0; $i<count($list); $i++) {  ?>
            <?php
			$content_max = cut_str(strip_tags($list[$i]['wr_content']), $cont_txt_max, '...');
            //echo $list[$i]['icon_reply']." ";
			echo "<li>";
			$li_thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_w, $thumb_h);
			$li_noimg = "$latest_skin_url/img/noimg.gif";
			if($li_thumb['src']) {
			$img_content = '<img src="'.$li_thumb['src'].'" width="'.$thumb_w.'" height="'.$thumb_h.'" alt="'.$list[$i]['subject'].'" title="" />';
				} else {
			$img_content = '<img src="'.$li_noimg.'" width="'.$thumb_w.'" height="'.$thumb_h.'" alt="이미지없음" title="" />';
			}		
			echo "<a href=\"".$list[$i]['href']."\">";
			echo $img_content; // 썸네일 출력
			echo "</li>";
			}
			if (count($list) == 0) { //게시물이 없을 때
			echo "<li>게시물이 없습니다.</li>";
    }?>
  </ul>
</div>

<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->