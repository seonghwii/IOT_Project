<?php
/* 작성 로빈아빠 howcode.co.kr 2018-02-17 */

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

// 많이 사용하는 경우 openweathermap.org 에서  api 키 발급
$g5['weather_key']='ceb339a4c742fc7a9c33dd51a0bdc68c';
$cache_file= G5_DATA_PATH."/cache/latest-{$bo_table}-{$skin_dir}.php";

$arr_info=array(
1=>"맑음"
,2=>"다소흐림"
,3=>"흐림"
,4=>"많이흐림"
,9=>"소나기"
,10=>"비"
,11=>"천둥번개"
,13=>"눈"
,50=>"안개");

//30분에 한번씩 갱신함
if (!isset($_REQUEST['recalc']) && is_file($cache_file) && time()-filemtime($cache_file)<30*60) {
	$arr_data=unserialize(file_get_contents($cache_file));
}
else {
	$arr=explode("\n","
	서해,125.853029,37.271484
	서울,126.975148,37.560961
	춘천,127.165517,37.832336
	강릉,128.896103,37.755562
	울릉,130.839601,37.506399
	충남,126.670660,36.658832
	충북,127.489267,36.635409
	경북,128.750000,36.333328
	전남,126.460730,34.816223
	전북,127.106533,35.820364
	경남,128.250000,35.250000
	제주,126.521942,33.509720
	");
	$g5['arr_city']=array();
	foreach($arr as $str) {
		$arr2=explode(',',trim($str));
		if ($arr2[1]) $g5['arr_city'][$arr2[0]]=array('lon'=>$arr2[1],'lat'=>$arr2[2]);
	}


	$arr_data=array();
	foreach($g5['arr_city'] as $city=>$arr) {
		$lat=$arr['lat'];
		$lon=$arr['lon'];
		$url="http://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&units=metric&APPID=".$g5['weather_key'];
		$w = curl_init($url);
		$weather_options = array(
			CURLOPT_HEADER => false,
			CURLOPT_RETURNTRANSFER => true
			);
		curl_setopt_array($w, $weather_options);
		$a = curl_exec($w);
		curl_close($w);
		if (!isset($a) || ! $a) continue;
		$weather=json_decode($a,true);
		$arr_data[]=array(
			 'temp'=>intval($weather['main']['temp'])
			,'icon'=>$weather['weather'][0]['icon']
		);
		$arr_data['datetime']=date("Y-m-d H:i",$weather['dt']);
	}
	file_put_contents($cache_file,serialize($arr_data));
}
?>

<div id='ar_weather'>
	<div class='map'>
<?php for($i=0;$i<12;$i++) { ?>
		<div class="zone area<?php echo ($i+1)?>" title="<?php echo $arr_info[intval($arr_data[$i]['icon'])]?>">
			<img src="//openweathermap.org/img/w/<?php echo $arr_data[$i]['icon']?>.png"><BR>
			<?php echo $arr_data[$i]['temp']?>
		</div>
<?php } ?>
	</div>
	<div class='info'>
		<?php echo substr($arr_data['datetime'],5)?> (<?php echo get_yoil($arr_data['datetime'])?>) 발표
	</div>
</div>
