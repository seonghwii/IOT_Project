제목 : AR 실시간 날씨 (latest)

제작 : 2018-02-17 로빈아빠 howcode.co.kr

개요 : 무료로 제공되는 날씨 api를 이용하여 전국 날씨를 출력함

설치 : 
  1) skin/latest 폴더에 압축풀기
  2) 보여주고자하는 파일에 latest 추가
     게시판 코드나 숫자는 의미가 없습니다. 
     예) tail.php 
<?php
	echo latest('ar.weather.all', 'notice', 4, 13);
?>

설명 :

1) 날씨 데이터 정보는 http://openweathermap.org  에서 가져옵니다.
   설치된 키는 임시 키이므로 많이 사용하려면 API 키를 직접 발급받아 수정하시기 바랍니다.

2) 30분 마다 한번씩 갱신됩니다. (임시데이터는 cache 폴더에 저장됨)
   캐싱 시간을 수정하려면 latest.skin.php 에서 30*60 을 수정하기 바랍니다.

   바로 최신 날씨로 갱신하려면 주소뒤에 &recalc=1 을 입력하면 바로 갱신됩니다.
   예) http://howcode.co.kr/bbs/board.php?bo_table=tip_gnu&recalc=1

배경이미지는 퍼온 이미지이므로 직접 수정하시기 바랍니다.

소스의 배포/수정/사용은 별도 제한이 없습니다.

