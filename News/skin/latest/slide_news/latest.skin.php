<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
?>

<!-- // jQuery 최신버전 로딩 : 다른 스킨에서 중복되는경우 삭제하세요. -->
<script type="text/javascript" src="<?=$latest_skin_url?>/js/mootools.svn.js"></script>
<script type="text/javascript" src="<?=$latest_skin_url?>/js/lofslidernews.mt11.js"></script>

<?
// 환경설정부분
$colorset = 'left'; // 슬라이드 위치 : left, right
$items_shuffle = 'Y' ; // 게시글 순서섞기 : Y, N
$slide_delay = 5000; // 슬라이드 지연시간 1초 = 1000
$slide_auto = 'true'; // 자동슬라이드 사용 유무 : true, false

// 제목 폰트 설정
$show_title = 'Y'; // 제목 출력 유무 : Y, N
$title_font_size = '13px'; //제목 폰트 크기 단위(px,em,%)를 포함해서 입력하세요.
$title_font_color = '#ffffff'; // 제목 폰트 컬러 RGB 컬러로 # 을 포함해야 합니다.
$title_font_family = "굴림,Arial,'Lucida Grande','Lucida Sans Unicode',sans-serif"; // 제목 폰트
$textT1_Height = 18; // 제목 높이 숫자만 입력하세요.

// 내용 폰트 설정
$show_content = 'Y'; // 내용 출력 유무 : Y, N
$cutstr_content = 200; // 내용 글자 제한수
$content_font_size = '12px'; // 내용 폰트 크기 단위(px,em,%)를 포함해서 입력하세요.
$content_font_color = '#ffffff'; // 내용 폰트 컬러 RGB 컬러로 # 을 포함해야 합니다.
$content_font_family = "굴림,Arial,Helvetica,AppleGothic,Sans-serif"; // 내용폰트
$textC1_Height = 45; // 내용 높이 숫자만 입력하세요.

// 기본 썸네일 이미지 크기
$cols_list_count = 4; // 썸네일 갯수
$thumbnail_width = 100; // 썸네일 가로 넓이
$thumbnail_height = 80; // 썸네일 세로 높이
$thumbnail_crop = true; // 썸네일 유형 crop 이면 true, 비율이면 false
$slide_width = 430; // 슬라이드 이미지 넓이
$slide_height = 300; // 슬라이드 이미지 넓이
$slide_crop = true; // 슬라이드 유형 crop 이면 true, 비율이면 false
$navigation_size = 250; // 네비박스 넓이
$is_create = true; // 썸네일 생성

$nav_height = (int)($slide_height/$cols_list_count);
$slide_height = ($nav_height*$cols_list_count);
$conText_height = $textT1_Height+$textC1_Height;

// 멀티스킨 사용을 위해 변수 또는 ID 랜덤 지정
$skin_id = "LofNews_".mt_rand();
$slide_id = $skin_id;

?>
<style type="text/css">
/************************************************************************************
RESET
*************************************************************************************/
html, body, address, blockquote, div, dl, form, h1, h2, h3, h4, h5, h6, ol, p, pre, table, ul,
dd, dt, li, tbody, td, tfoot, th, thead, tr, button, del, ins, map, object,
a, abbr, acronym, b, bdo, big, br, cite, code, dfn, em, i, img, kbd, q, samp, small, span,
strong, sub, sup, tt, var, legend, fieldset {
	margin: 0;
	padding: 0;
}

img, fieldset {
	border: 0;
}

/* reset iphone text adjust */
html {
	-webkit-text-size-adjust: 100%;
}

.textT1_<?=$skin_id?>, .textT1_<?=$skin_id?> a, .textT1_<?=$skin_id?> a:visited {
	color: <?=$title_font_color?>;
	font-family: <?=$title_font_family?>;
	font-size: <?=$title_font_size?>;
	text-decoration: none;
	line-height: normal;
	text-align:left;
	overflow:hidden;
	<? if($show_title=='Y') { ?>display:block;<? } else { ?>display:none;<? } ?>
}
.textT1_<?=$skin_id?> a:hover, .textT1_<?=$skin_id?> a:focus {
	text-decoration: underline;
}

.textC1_<?=$skin_id?>, .textC1_<?=$skin_id?> a, .textC1_<?=$skin_id?> a:visited {
	text-align:justify;
	color: <?=$content_font_color?>;
	font-family: <?=$content_font_family?>;
	font-size: <?=$content_font_size?>;
	text-decoration: none;
	font-weight: normal;
	line-height: 130%;
	height: <?=$textC1_Height?>px;
	<? if($show_content=='Y') { ?>display:block;<? } else { ?>display:none;<? } ?>
}
.textC1_<?=$skin_id?> a:hover, .textC1_<?=$skin_id?> a:focus {
	text-decoration: underline;
}


/* CSS Document */
.lof-slidecontent_<?=$skin_id?> {
	position:relative;
	overflow:hidden;
	border:#F4F4F4 solid 1px;
	width:<?=$slide_width+$navigation_size?>px; /* 전체 넓이 */
	height:<?=$slide_height?>px; /* 전체 높이 */
}
.lof-slidecontent_<?=$skin_id?> .preload {
	height:100%;
	width:100%;
	background:#FFF;
	position:absolute;
	top:0;
	left:0;
	z-index:100000;
	text-align:center
}
.lof-slidecontent_<?=$skin_id?> .preload div {
	height:100%;
	width:100%;
	background:transparent url('<?=$latest_skin_url?>/images/load-indicator.gif') no-repeat scroll 50% 50%;
}
/* main flash */
.lof-slidecontent_<?=$skin_id?> .lof-main-wapper {
	margin-right:auto;
	overflow:hidden;
	background:transparent url('<?=$latest_skin_url?>/images/load-indicator.gif') no-repeat scroll 50% 50%;
	padding:0px;
	height:<?=$slide_height?>px;
	width:<?=$slide_width?>px;  /* 슬라이드 이미지 넓이 */
	position:relative;
	overflow:hidden;
}

.lof-slidecontent_<?=$skin_id?> .lof-main-wapper .lof-main-item_<?=$skin_id?> {
	overflow:hidden;
	padding:0px;
	margin:0px;
	height:100%;
	width:100%;
	position:absolute;
}
.lof-slidecontent_<?=$skin_id?> .lof-main-wapper .lof-main-item_<?=$skin_id?> img {
	padding:0px;	
	width:<?=$slide_width?>px;  /* 슬라이드 이미지 넓이 */
}

.lof-slidecontent_<?=$skin_id?> .lof-main-wapper .lof-main-item_<?=$skin_id?> .noimage {
	background:transparent url('<?=$latest_skin_url?>/images/noimg64.png') no-repeat scroll 50% 50%;
}

.lof-slidecontent_<?=$skin_id?> .lof-main-item-desc{
	z-index:100;
	position:absolute;
	bottom:0px;
	left:0px;
	padding: 5px 15px;
	width:<?=$slide_width?>px;  /* 캡션박스 넓이 */
	height:<?=$conText_height?>px;
	background:url('<?=$latest_skin_url?>/images/transparent_bg.png');
}
.lof-slidecontent_<?=$skin_id?> .lof-main-item-desc .lof-content { 
	padding:0;
	margin:8px 0px;
	width:<?=$slide_width-30?>px;
}

/* item navigator */
.lof-slidecontent_<?=$skin_id?> ul.lof-navigator {
	top:<? if($colorset=="right") echo "-100px"; else echo "0px"; ?>;
	padding:0;
	margin:0;
	position:absolute;
	width:100%;
}

.lof-slidecontent_<?=$skin_id?> ul.lof-navigator li {
	cursor:pointer;
	list-style:none;
	width:100%;
	padding:0;
	margin:0;
	overflow:hidden;
}

.lof-slidecontent_<?=$skin_id?> .lof-navigator-outer {
	position:absolute;
	right:0;
	top:0px;
	z-index:100;
	height:<?=$slide_height?>px; /* 왼쪽 썸네일 박스 높이 */
	width:<?=$navigation_size+18?>px; /* 왼쪽 썸네일 박스 넓이 */
	overflow:hidden;
	color:#FFF
}

.lof-slidecontent_<?=$skin_id?> .lof-navigator li.active {
	background:url('<?=$latest_skin_url?>/images/arrow-bg.png') no-repeat scroll left center; 
	color:#FFF
}

.lof-slidecontent_<?=$skin_id?> .lof-navigator li:hover {
	
}

.lof-slidecontent_<?=$skin_id?> .lof-navigator li h3 {
	padding:10px 5px 0 0 !important; /* 제목 여백 */
	margin:0;
}

.lof-slidecontent_<?=$skin_id?> .lof-navigator li div {
	background:url('<?=$latest_skin_url?>/images/transparent_bg.png');
	color:#FFF;
	height:100%;
	position:relative;
	margin-left:18px; /* 화살표넓이 */
	padding-left:10px;
	border-top:1px solid #E1E1E1;
}

.lof-slidecontent_<?=$skin_id?> .lof-navigator li.active div {
	background:url('<?=$latest_skin_url?>/images/grad-bg.gif');
	color:#FFF;
}

.lof-slidecontent_<?=$skin_id?> .lof-navigator li div a {
	color:#FFF;
	text-decoration: none;
}

.lof-slidecontent_<?=$skin_id?> .lof-navigator li div a:hover {
	color:#FFF;
	text-decoration:underline;
}

.lof-slidecontent_<?=$skin_id?> .lof-navigator li img {
	float:left;
	height:<?=$nav_height-18?>px;
	width:<?=$thumbnail_width?>px;
	margin:5px 10px 5px 0px;
	padding:3px;
	border:#C5C5C5 solid 1px;
}

.lof-slidecontent_<?=$skin_id?> .lof-navigator li .noimage {
	background:transparent url('<?=$latest_skin_url?>/images/noimg64.png') no-repeat scroll 50% 50%;
}

.lof-slidecontent_<?=$skin_id?> .lof-navigator li.active img {
	border:##6C8E5C solid 1px;
}

.lof-slidecontent_<?=$skin_id?> .lof-navigator li h3 a {
	text-decoration: none;
}

.lof-slidecontent_<?=$skin_id?> .lof-navigator li h3 a:hover {
	text-decoration:underline;
}

.lof-slidecontent_<?=$skin_id?> .lof-navigator li.active h3 {
	color:#FFF;
}

.lof-slidecontent_<?=$skin_id?> .lof-next {
	position:absolute;
	top:0;
	height:30px;
	background:#F9F9F9;
	display:block;
	width:100%;
}

.lof-slidecontent_<?=$skin_id?> .lof-previous {
	position:absolute;
	bottom:0;
	height:30px;
	background:#F9F9F9;
	display:block;
	width:100%;
}

<? if($colorset=="right") { ?>
.lof-snleft_<?=$skin_id?> .lof-main-wapper {
	margin-left:<?=$navigation_size?>px;
	margin-right:inherit;
	clear:both;
	height:<?=$slide_height?>px; /* 높이 */
}

.lof-snleft_<?=$skin_id?> .lof-navigator-outer {
	left:0;
	top:0;
	right:inherit;
}
	
.lof-snleft_<?=$skin_id?> .lof-navigator li.active {
	background:url('<?=$latest_skin_url?>/images/arrow-bg2.gif') center right no-repeat;
	}

.lof-snleft_<?=$skin_id?> .lof-navigator li div {
	margin-left:inherit;
	margin-right:18px;
}

.lof-snleft_<?=$skin_id?> .lof-navigator li.active div {
	margin-left:inherit;
	margin-right:18px;
	background:url('<?=$latest_skin_url?>/images/grad-bg2.gif'); 
}
<? } ?>

</style>
<?
if($items_shuffle=='Y') shuffle($list);
?>

<!--// 내용출력 -->
<div id="<?=$slide_id?>" class="lof-slidecontent_<?=$skin_id?> lof-snleft_<?=$skin_id?>">
	<div class="preload" style="visibility: hidden; zoom: 1; opacity: 0; "><div></div></div>

	<div class="lof-main-wapper">
<?php
	for ($i=0; $i<count($list); $i++)
	{
	//변수값 사용방법 $list[$i][file][0][image_width]
	$slider = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $slide_width, $slide_height,$is_create,$slide_crop);

	$list[$i]['wr_content']=str_replace("&nbsp"," ",$list[$i]['wr_content']);

?>
		<div class="lof-main-item_<?=$skin_id?>" style="display: block; visibility: visible; zoom: 1; opacity: 0.998621875; ">
				<?
				if ($slider['src'])
				{
				?>
				<img src="<?=$slider['src']?>" title='<?=$list[$i]['wr_subject']?>' height="<?=$slide_height?>px" width="<?=$slide_width?>px">
				<?
				}
				else
				{
				echo '<img src="'.$latest_skin_url.'/images/blank.gif" class="noimage" height="'.$slide_height.'px" width="'.$slide_width.'px">';
				}
				?>
				<?php if($show_content=='Y') {?>
				<div class="lof-main-item-desc">
				<?php if($show_content=='Y'&&$list[$i]['wr_content']!='') {?>
                <div class="lof-content textC1_<?=$skin_id?>"><a href="<?=$list[$i][href]?>"><?=conv_subject(strip_tags($list[$i]['wr_content']), $cutstr_content,"...");?></a></div><? } ?>
				</div><? } ?>
        </div>
<?php
	}
?>
	</div>

	<div class="lof-navigator-outer">
  		<ul class="lof-navigator">
<?php
	for ($i=0; $i<count($list); $i++)
	{
	//변수값 사용방법 $list[$i][file][0][image_width]
	$thumbnail = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumbnail_width, $thumbnail_height,$is_create,$thumbnail_crop);
?>
			<li style="height: <?=$thumbnail_height+26?>px;">
            	<div>
				<?
				if ($thumbnail['src'])
				{
				?>
					<img src="<?=$thumbnail['src']?>" width="<?=$thumbnail_width?>" height="<?=$thumbnail_height?>" />
								<?
				}
				else
				{
				echo '<img src="'.$latest_skin_url.'/images/blank.gif" class="noimage" height="'.$thumbnail_height.'px" width="'.$thumbnail_width.'px">';
				}
				?>
					</a>
                	<h3 class="textT1_<?=$skin_id?>"><?=$list[$i]['wr_subject']?></h3>
                </div>    
            </li>
<?php
	}
?>
        </ul>
	</div>
</div>

<script type="text/javascript">
	var _lofmain = $('<?=$slide_id?>');
	var _lofscmain = _lofmain.getElement('.lof-main-wapper');
	var _lofnavigator = _lofmain.getElement('.lof-navigator-outer .lof-navigator');
	var object = new LofFlashContent( 
		_lofscmain, _lofnavigator, _lofmain.getElement('.lof-navigator-outer'), {
			fxObject		: {transition:Fx.Transitions.Quad.easeInOut, duration:800},
			interval		: <?=$slide_delay?>,
			direction		: 'opacity',
			mainItemSelector: 'div.lof-main-item_<?=$skin_id?>',
			autoStart		: <?=$slide_auto?>,
			auto			: <?=$slide_auto?>,
			navItemsDisplay	: <?=$cols_list_count?>,
			startItem		: 0,
			navItemHeight	: <?=$nav_height?>
		});
	object.start( true, _lofmain.getElement('.preload') );
</script>
