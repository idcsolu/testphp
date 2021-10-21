<?php
	include "/home/test/data/db.php";
	
	$uid = $_GET['userid'];
	$sql = mq("select * from members where m_id = '".$uid."'");
	$member = $sql->fetch_array();
	if($member == 0 ){
?>
	<div style='font-family:"malgun gothic"';><?php echo $uid; ?><br> 사용 가능한 아이디입니다.</div>
<?php
	} else {
?>
	<div style='font-family:"malgun gothic"; color:red;'><?php echo $uid;?><br> 중복된 아이디입니다.</div>
<?php }
?>
<button value="닫기" onclick="window.close()">닫기</button>

