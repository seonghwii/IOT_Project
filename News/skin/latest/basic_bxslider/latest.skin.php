<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/css/style.css">', 0);
if($options['bxslider']) add_javascript('<script src="'.G5_JS_URL.'/jquery.bxslider.js"></script>', 10);

$thumb_width  = isset($options['thumb_width']) ? $options['thumb_width'] : $board['bo_gallery_width'];
$thumb_height = isset($options['thumb_height']) ? $options['thumb_height'] : $board['bo_gallery_height'];
$box_row = isset($options['box_row']) ? $options['box_row'] : 6;
$slide = isset($options['latest_name']) ? $options['latest_name'] : 'glist';
$speed = isset($options['bxslider_speed']) ? $options['bxslider_speed'] : '200';

$bo_subject = isset($options['latest_title']) ? $options['latest_title'] : $bo_subject;

?>
<div class="xe-widget-wrapper" style="border:0px solid #ff0000">
	<div id="<?php echo $slide;?>_islide" class="latestfree clear_fix">
		<div class="latest-box clear_fix">
			
			<div style="*zoom:1;padding:0px !important;">
				<div id="<?php echo $slide;?>" class="clear_fix latest_list">
					<ul>
						<?php
						$num = 0;
						for ($i=0; $i<count($list); $i++) {
						$num++;
						?>

						<?php if($num%$box_row == 1 && $options['first_img']){

						$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height);
						if($thumb['src']) {
							$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$thumb_width.'" height="'.$thumb_height.'">';
						} else {
							if($thumb['ori']) {
								$img_content = '<img src="'.$thumb['ori'].'" alt="'.$thumb['alt'].'" width="'.$thumb_width.'" height="'.$thumb_height.'">';
							} else {
								$img_content = '';
							}
						}
						?>
						<li class="clear_fix top_webzin">
							<a href="<?php echo $list[$i][href];?>" style="margin:0; padding:0">
							<?php echo $img_content; ?>
							<h3 class="title"><?php echo $list[$i][subject];?></h3>
							</a>
						</li>
						<?php }else{ ?>
						<li class="clear_fix">
							<?php
							if ($list[$i]['icon_secret']) echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i><span class=\"sound_only\">비밀글</span> ";

							if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";

							if ($list[$i]['icon_hot']) echo "<span class=\"hot_icon\">H<span class=\"sound_only\">인기글</span></span>";
							?>
							<div style="padding-bottom:10px">
							<a href="<?php echo $list[$i][href];?>"><span style="font-family:나눔고딕;font-size:30px;font-weight:bold;color:#000000;line-height:120%">
								<?php
								if ($list[$i]['is_notice'])
									echo "<strong>".$list[$i]['subject']."</strong>";
								else
									echo $list[$i]['subject'];
								?>
							</span></a>
							</div>
							<div><?php
							$list[$i]['wr_content']=str_replace("&nbsp;"," ",$list[$i]['wr_content']);
							echo cut_str(strip_tags(stripslashes($list[$i]['wr_content'])),350); ?></div>
							
						</li>
						<?php } ?>

						<?php
						if($num%$box_row == 0 && $num != count($list)) echo '</ul><ul class="latest_list">';
						else echo '';
						}
						?>
					</ul>
				</div>

				<?php if($options['bxslider']){ ?>
				<script>
				jQuery(document).ready(function($){
					var $slider = $('#<?php echo $slide;?>'),
						$garden_list = $slider.find('.latest_list'),
						$ws = $('#<?php echo $slide;?>_islide');
					if($ws.is(':visible')) {
						var wsNext = '#<?php echo $slide;?>Next',
							wsPrev = '#<?php echo $slide;?>Prev';
					} else {
						var wsNext = null,
							wsPrev = null;
					}
					$slider.bxSlider({
						speed: <?php echo $speed;?>,
						easing: 'swing',
						infiniteLoop: false,
						pager: false,
						nextText: '',
						prevText: '',
						nextSelector: wsNext,
						prevSelector: wsPrev,
						hideControlOnEnd: true,
						useCSS: false,
						touchEnabled: true,
						oneToOneTouch: true
					});

					$garden_list.css('display','block');
				});
				</script>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
