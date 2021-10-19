<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
add_javascript('<script src="'.$latest_skin_url.'/news_ticker.js"></script>', 0);
?>
<div style="*zoom:1;padding:10px 0px 10px 20px !important;" class="xans-bannermanage2">
	<ul id="ticker" class="news_ticker">
		<?php
		for ($i=0; $i<count($list); $i++) {

            echo '<li><a href="'.$list[$i]['href'].'"><span class="news_arrow"></span> <span class="date">'.$list[$i]['datetime'].'</span> ';

            if ($list[$i]['is_notice'])
                echo '<span class="author">'.$list[$i]['subject'].'</span>';
            else
                echo $list[$i]['subject'];

			echo "</a></li>";
		}
		?>
		<?php if (count($list) == 0) { //게시물이 없을 때  ?>
		<li>게시물이 없습니다.</li>
		<?php }  ?>
	</ul>
</div>
<script type="text/javascript">
	jQuery(function($){
		$('#ticker').list_ticker({
			speed:5000,
			effect:'slide',
			random:false
		});
	})
</script>