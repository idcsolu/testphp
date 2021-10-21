<?php
	include "/home/test/data/db.php";
	
	$b_num  = $_GET['b_num'];
	$m_id   = $_POST['m_id'];
	$cont   = $_POST['r_cont'];
	$m_pwd  = $_POST['m_pwd'];
		
	$sqlId = mq("
		select * from members where m_id = '{$m_id}'
		");
	$data  = $sqlId->fetch_array();
	$row   = mysqli_num_rows($sqlId);
	$pwck  = $data['m_pwd'];
	
	if($m_id != ""  && $row > 0 && isset($_POST['m_pwd']) && password_verify($m_pwd, $pwck)) {
		$_SESSION['s_id'] = $m_id;
		$_SESSION['s_name'] = $data['m_name'];

		$insert = mq("
			insert into reply ( b_num, m_id, r_cont) 
			values( '{$b_num}', '{$m_id}', '{$cont}')
		");
		echo"<script>alert('댓글 작성 완료');
			location.href='/board/view2.php?b_num=$b_num';</script>";
		exit();
	} 
			
	if($m_id !="" && $row > 0 && $b_num && $_POST['r_cont']){
		$sql = mq("insert into reply(b_num, m_id, r_cont)
			values('{$b_num}', '{$m_id}', '{$cont}') " );
		echo "<script>alert('댓글 작성 완료');
			location.href='/board/view2.php?b_num=$b_num';</script>";
	} else {
		echo "<script>alert('댓글 작성 실패');
		history.back();</script>";
	}
	
?>
