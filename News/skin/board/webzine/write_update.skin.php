<?

if($r_wr_datetime){//등록날짜를 수정할경우

	$sql="update $write_table set wr_datetime='$r_wr_datetime' where wr_id='$wr_id' ";
	sql_query($sql);
}

?>