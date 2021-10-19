<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);



/*
프로젝트명 : 시즌10' CREATE GNUBOARD SKIN
스킨튜닝개발자 : 흑횽TM 
개발자사이트주소 : http://shoponex.com/?theme=skin
라이선스 : 오픈소스 플러그인 라이선스 참고. 
기타 라이선스 : 그누보드 사이트 (sir.kr)를 제외한 타 사이트에서 재배포 금지.
*/


?>


<script src="<?=$latest_skin_url?>/js/jcarousellite_1.0.1c4.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$(".newsticker-jcarousellite").jCarouselLite({
		vertical: true,
		hoverPause:true,
		visible: 1,
		auto:1500,
		speed:1000
	});
});
</script>
<div id="newsticker-demo">    
    <div class="title">Latest News</div>
    <div class="newsticker-jcarousellite">
		<ul>

<?php
for ($i=0; $i<count($list); $i++) {	
?>
	<li>
		<span class="info">
			<a href="<?php echo $list[$i]['href']?>"><?php echo $list[$i]['subject']; ?></a>
			<span class="cat">content : <?php echo cut_str(strip_tags($list[$i]['wr_content']),50); ?></span>
		</span>
	</li>
	
<?php	}	?>		


        </ul>
    </div>
    
</div>
      