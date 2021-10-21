<?php
	include "/home/test/data/db.php";
	

	if($_POST["userid"] == "" || $_POST["userpwd"] == ""){
		echo'<script>alert("아이디와 비밀번호를 확인하세요"); location.href="/member/join.php"; </script>';
	} else {
//		echo $_POST['userid'];

	if($_POST['userpwd']!=$_POST['reuserpwd']) { 
                echo '<script> alert("패스워드가 일치하지 않습니다.");history.back(); </script>';
	} else {
		$sql = "
			select exists
			 ( select * from members where m_id='".$_POST['userid']."') as success
		";
	
	$ret = mysqli_query($conn, $sql);
	$usernamecount = $ret->fetch_array();
	
	if($usernamecount['success']==1) {
	echo("<script>alert('중복된 아이디'); history.back();</script>");
	} else {
			
	$id  = $_POST['userid'];
	$pwd = password_hash($_POST['userpwd'], PASSWORD_DEFAULT);
	
	$name = $_POST['username'];
	
	$sql1 = "INSERT INTO members(m_id, m_pwd, m_name)
		VALUES('".$id."','".$pwd."','".$name."')";
	$result = mysqli_query($conn, $sql1);
	
	echo("<script>alert('회원가입 성공'); location.href='/login/login.php';</script>");
	}
    }
}


/*	$ret = mysqli_query($conn, "insert into members(m_id, m_pwd, m_name)
		values('{$id}', '{$pwd}', '{$name}')" );
*/	
?>

