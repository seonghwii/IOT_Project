<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
add_javascript('<script src="'.$latest_skin_url.'/news_ticker.js"></script>', 0);

$speed  = isset($options['speed']) ? $options['speed'] : 5000;
$icon_secret  = isset($options['icon_secret']) ? $options['icon_secret'] : 1;
$icon_new  = isset($options['icon_new']) ? $options['icon_new'] : 1;
$icon_hot  = isset($options['icon_hot']) ? $options['icon_hot'] : 1;
$comment_cnt  = isset($options['comment_cnt']) ? $options['comment_cnt'] : 1;
$date  = isset($options['date']) ? $options['date'] : 1;
?>
<div class="ticker_lat">
    <ul id="ticker">
    <?php for ($i=0; $i<count($list); $i++) {  ?>
        <li>
            <?php
            if ($list[$i]['icon_secret'] && $icon_secret) echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i><span class=\"sound_only\">비밀글</span> ";

            //if ($list[$i]['icon_new'] && $icon_new) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";

            if ($list[$i]['icon_hot'] && $icon_hot) echo "<span class=\"hot_icon\">H<span class=\"sound_only\">인기글</span></span>";

            echo "<a href=\"".$list[$i]['href']."\"> ";
            if ($list[$i]['is_notice'])
                echo "<strong>".$list[$i]['subject']."</strong>";
            else
                echo $list[$i]['subject'];

            echo "</a>";

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

            // echo $list[$i]['icon_reply']." ";
            // if ($list[$i]['icon_file']) echo " <i class=\"fa fa-download\" aria-hidden=\"true\"></i>" ;
            // if ($list[$i]['icon_link']) echo " <i class=\"fa fa-link\" aria-hidden=\"true\"></i>" ;

            if ($list[$i]['comment_cnt'] && $comment_cnt)  echo "<span class=\"lt_cmt\">+ ".$list[$i]['comment_cnt']."</span>";

			if ($list[$i]['icon_new'] && $icon_new) echo " <span class=\"new\"><span class=\"sound_only\">새글</span></span>";

			if($date)  echo "
            <span class=\"lt_date\">+ ".$list[$i]['datetime2']."</span>";

            ?>
        </li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li class="empty_li">게시물이 없습니다.</li>
    <?php }  ?>
    </ul>
</div>
<script type="text/javascript">
	jQuery(function($){
		$('#ticker').list_ticker({
			speed:<?php echo $speed;?>,
			effect:'slide',
			random:false
		});
	})
</script>