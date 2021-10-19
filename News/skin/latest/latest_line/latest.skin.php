<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
global $is_admin;

$n_thumb_width = 130; //썸네일 가로 크기
$n_thumb_height = 100; //썸네일 세로 크기
?>

<link rel="stylesheet" href="<?php echo $latest_skin_url; ?>/style.css">


 
  <?php if (count($list) == 0) { //게시물이 없을 경우 ?>
  <div class="n_no_list">게시물이 없습니다.</div>
  <?php } else { //게시물이 있을 경우 ?>
  <ul class="n_thumb" >
    <?php for ($i = 0; $i < count($list); $i++) { ?>
    <li>
      <p><a href="<?php echo $list[$i]['href']; ?>"><span style="color:#336699"><b>└</b><?php echo $list[$i]['subject']; ?></span></a></p>
    </li>
    <?php } ?>
  </ul>
  <?php } ?>

