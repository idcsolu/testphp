<meta charset="utf-8">

<?php
//	require_once("/home/test/data/db_info.php");
//	$conn = mysqli_connect($SERV, $USER, $PASS, $DBNM) or die("fail");
	
	include "/home/test/data/db.php";
	
	if($_POST['userid'] == '' || $_POST['userpwd'] == '') {
		echo '<script> alert("아이디와 비밀번호를 입력하세요"); history.back(); </script>';
	} else {
	
        $uid = $_POST['userid'];	
	$pwd = $_POST['userpwd'];

	$sql = "select * from members where m_id='{$uid}'";

	$result = mysqli_query($conn, $sql);
	$member = $result -> fetch_array();

	$pwck = $member['m_pwd'];
	if(password_verify($pwd, $pwck)) {
		$_SESSION['s_id'] = $member["m_id"];
		$_SESSION['s_name'] = $member["m_name"];

		echo "<script>alert('로그인 성공'); location.href='../board/board.php';</script>";
	} else {
		echo "<script>alert('로그인 실패'); history.back(); </script>";
	}
  }
?>
