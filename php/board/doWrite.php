<?php
	require_once("/home/test/data/db_info.php");
	$conn = mysqli_connect($SERV, $USER, $PASS, $DBNM) or die("fail");
	
	session_start();

	$mid=$_POST['m_id'];
	$title=$_POST['b_title'];
	$cont=$_POST['b_cont'];
	
	$date = date('Y-m-d');
	// file 업로드 관련
	
	$folder = '../uploads/';	
	$user   = $_SESSION['s_id'];
	$userFd = $folder.$user;
	if(!is_dir($userFd)) mkdir($folder.$user,0777,true);
	if(isset($_FILES['upfile']['name'])) {
	  $cnt = count($_FILES['upfile']['name']);
	  $fileDbName = implode(",", $_FILES['upfile']['name'] );
	  for($i=0; $i < $cnt; $i++) {
	    if(isset($_FILES['upfile']['name'][$i]) && $_FILES['upfile']['size'][$i] > 0 ) {
		$filename = iconv("UTF-8", "EUC-KR", $_FILES['upfile']['name'][$i]);
		$target   = $userFd.'/'.$filename;
		$uploadname = $_FILES['upfile']['tmp_name'][$i];
		move_uploaded_file($uploadname, $target);
	    }
         }
       }
/*
	if($_POST['MAX_FILE_SIZE'] < $_FILES['upfile']['size']){
		echo "파일 업로드 용량 초과.\n";
	} else {
	  if( ($_FILES['upfile']['error'] > 0 ) || ($_FILES['upfile']['size'] <= 0 ) ) {
		echo "파일 업로드 실패";
	  } else {
	    if( !is_uploaded_file($_FILES['upfile']['tmp_name']) ) {
		echo "HTTP로 전송된 파일이 아닙니다.";
	    } else {
	      if( move_uploaded_file($_FILES['upfile']['tmp_name'], $folder )){
		echo "업로드 성공";
	      } else {
	        echo "업로드 실패";
	      }
	   }
	}
    }
*/
	$sql  = "
	    INSERT INTO board(b_title, b_cont, m_id, b_file) VALUES
		('$title', '$cont', '$mid', '$fileDbName')
	";
	$result = mysqli_query($conn,$sql);

	if($result){
		$replaceURL='./board.php';
	} else {

?>
	<script>
		history.back(); // 이전 페이지로 
	</script>
<?php
	}
?>
<script>
	location.replace("<?php echo $replaceURL ?>");
</script>
