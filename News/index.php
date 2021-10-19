<?php
include_once('./_common.php');

define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/index.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_PATH.'/head.index.php');
?>







<table border=0 align=center cellpadding=0 cellpadding=0 width=900px>

<tr valign=top>
<td>
<!--------좌측--------------->
<table border=0 cellpadding=3 cellspacing=0 cellspacing=0 width=100%>

<tr valign=top>
<td>
   <?php  echo latest('basic', 'a1', 10, 22); ?>
   
   
</td>
<td></td>
<td>
   <?php  echo latest('basic', 'b1', 6, 20); ?>
   <?php  echo latest('basic', 'c1', 6, 20); ?>
   
</td>
</tr>
</table>



    
    
<table width=100% border=0 cellpadding=7 cellspacing=0>
<tr valign=top>
    <td><? echo latest("basic", "d1", "5", "20");?></td>    <!-- "스킨", "게시판이름", "몇개 나타낼지", "??제목크긴가??"-->
    <td><? echo latest("basic", "e1", "5", "17");?></td>
    
</tr>
    <tr>
    <td>
    </tr>
</table>

<table width=100%>
<tr>
    <td><? echo latest("basic", "f1", "5", "50");?></td>

    </tr>


    
</table>



<!--
<table width=100%>
<tr>
    <td><? echo latest("basic", "notice", "5", "50");?></td>
    <td><? echo latest("basic", "free2", "5", "50");?></td>
    <td><? echo latest("basic", "free3", "5", "50");?></td>
</tr>
</table>
-->




<table width=100%>
<tr>
    
</tr>
</table>

    <!------------------>
</td>
</tr>
</table>






<?php
include_once(G5_PATH.'/tail.php');