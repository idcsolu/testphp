<?php
	include "/home/test/data/db.php";
	
	$num	= $_POST['b_num'];
	$title  = $_POST['b_title'];
	$cont   = $_POST['b_cont'];
        $oldfile = $_POST['upfile'];
	$newfile = $_POST['upnewfile'];	
	$date   = date('Y-m-d H:i:s');

	if(!isset($_SESSION['s_id'])){
                echo'alert("권한 없음"); location.replace("./view2.php?b_num=<?=$num?>");';
                exit();
        }
	$owner  = $_SESSION['s_id'];
	
	$folder = '../uploads/'.$owner.'/';
	if( isset($oldfile) ) {
	 $sql_old = "update board set b_title='$title',b_cont='$cont', b_date='$date'
                where b_num =$num";
	 $result_old = $conn->query($sql_old);
 ?>
	<script>
		alert("수정완료");
	        location.replace("./view2.php?b_num=<?=$num?>");
	</script>
<?php	 
	} else if( isset($_FILES['upnewfile']['name']) ) {
          $cnt = count($_FILES['upnewfile']['name']);
	  $newfileDbName = implode(",", $_FILES['upnewfile']['name'] );
          for($i=0; $i < $cnt; $i++) {
            if(isset($_FILES['upnewfile']['name'][$i]) && $_FILES['upnewfile']['size'][$i] > 0 ) {
                $newfilename = iconv("UTF-8", "EUC-KR", $_FILES['upnewfile']['name'][$i]);
                $newtarget   = $folder.$newfilename;
                $newuploadname = $_FILES['upnewfile']['tmp_name'][$i];
                move_uploaded_file($newuploadname, $newtarget);
            }
	}	
	  $sql_new = "update board set b_title='$title', b_cont='$cont', b_date='$date', b_file='$newfileDbName'
		where b_num =$num";
	  $result_new = $conn->query($sql_new);
?>
	<script>
		alert("파일 추가 완료");
		location.replace("./view2.php?b_num=<?=$num?>");
	</script>
<?php
	}
?>

