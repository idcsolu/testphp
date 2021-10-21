<?php
	include "/home/test/data/db.php";
	$num = $_GET['b_num'];
	$sql = "select m_id,b_file from board where b_num = $num";
	$result = $conn->query($sql);
	$data = mysqli_fetch_assoc($result);
	$owner = $data['m_id'];	
	$folder = "../uploads/".$owner.'/';
	
	$fileName = explode(',',$data['b_file']);
	if(isset($data['b_file'])){
        	for($j=0; $j < sizeof($fileName); $j++) {
	        	unlink($folder.$fileName[$j]);
        	}
	}

	$id = $data['m_id'];

	$URL = "./board.php";	
?>

<?php
	if(!isset($_SESSION['s_id'])) {
?> 
	<script>
	  alert("권한이 없습니다.");
	  location.replace("<?php echo $URL ?>");
	</script>

<?php } else if($_SESSION['s_id'] == $id) {
	$sql2 = "delete from board where b_num = $num";
	$conn->query($sql2);
?>
	<script>
	  alert("게시글이 삭제되었습니다.");
	  location.replace("<?php echo $URL ?>");
	</script>

<?php } else { ?>
	<script>
	  alert("권한이 없습니다.");
	  location.replace("<?php echo $URL ?>");
	</script>
<?php }
?>
