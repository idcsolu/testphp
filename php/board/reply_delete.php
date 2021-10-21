<?php
	include "/home/test/data/db.php";
	
	$bnum = $_GET['b_num'];
	$rnum = $_GET['r_num'];
	
	
	$resql1  = "select * from reply where b_num =$bnum and r_num =$rnum";
	$result1 = $conn->query($resql1);
	$data    = mysqli_fetch_assoc($result1);	

	if(isset($_SESSION['s_id']) && $data['m_id'] == $_SESSION['s_id']) {
                $sql3 = "
                delete from reply where b_num = $bnum and r_num = $rnum
                ";
                $result3 = $conn->query($sql3);
		$backNum = $data['b_num'];
		$URL     = "./view2.php?b_num=.{$backNum}.";	
        	echo"<script>alert('댓글 삭제 완료'); 
			history.back();</script>";
        } else {
		echo"<script>alert('권한이 없습니다.');
		      history.back();</script>";
                exit();
        };
?>


