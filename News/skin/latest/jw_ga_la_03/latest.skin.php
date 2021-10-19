<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// 스넵이미지 생성함수
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$n_thumb_width = 192;  //썸네일 가로 크기
$n_thumb_height = 165; //썸네일 세로 크기
?>


<div class="gall_rectang">
	<ul>
    
<?php for ($i = 0; $i < count($list); $i++) { ?>
		<li>
    		<a class="orange_click"  href="<?=$list[$i]['href']?>">
			<div class="rec_shadow"></div>
				<div class="rec_thumb">
                	<?php
							$n_thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $n_thumb_width, $n_thumb_height);
								// 스넵이미지 생성하고 뷰어 시킨다.
							$n_noimg = "$latest_skin_url/img/noimg.gif";
								// 이미지가 없을경우의 이미지 위치
					if($n_thumb['src']) {
							$img_content = '<img src="'.$n_thumb['src'].'" width="'.$n_thumb_width.'" height="'.$n_thumb_height.'" alt="'.$list[$i]['subject'].'" title="" />';
					} else {
							$img_content = '<img src="'.$n_noimg.'" width="'.$n_thumb_width.'" height="'.$n_thumb_height.'" alt="이미지없음" title="" />';
					}
							echo $img_content;
					?>
                    </div>
				<section class="rec_info">
					<div class="rec_tit_box">
            			<div class="rec_tit"><?php echo $list[$i]['subject'];?></div>
            		</div>
           	  		<div class="rec_disc">
					<?php
					$wr_content = preg_replace("/<(.*?)\>/"," ",$list[$i][wr_content]); 
					$wr_content = preg_replace("/&nbsp;/"," ",$wr_content); 
					$wr_content = str_replace("//##", " ", $wr_content); 
					$wr_content = cut_str(get_text($wr_content), 75, '…');
				    if (!$list[$i]['is_notice']) { // 공지사항이 아닐경우 내용출력 ?>
					<?php echo $wr_content?>
				<?php } ?>
					
					
					
					
					
					</div>
				</section>
			</a>
		</li>
<?php } ?>    	
    </ul>
</div>