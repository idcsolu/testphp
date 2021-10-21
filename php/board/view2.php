<?php
	require_once("/home/test/data/db_info.php");
	$conn = mysqli_connect($SERV, $USER, $PASS, $DBNM) or die("fail");
	$b_num = $_GET['b_num'];
	
	session_start();	

	$sql = "select b_title, b_cont, b_date, b_hit, m_id, b_file from board where b_num =$b_num";
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_assoc($result);
	$files = explode(',', $data['b_file']);
	$owner = $data['m_id'];	
	
	if($_SESSION['s_id'] == $data['m_id']){
	} else {
	$hit  = "update board set b_hit = b_hit + 1 where b_num = $b_num";
	$conn->query($hit);
	
	}
	
	$cont = $data['b_cont'];
	$cont = nl2br(str_replace(" ","&nbsp;",$cont));
	
	

	if(isset($_SESSION['s_id'])) {
?>
	<div align=center>
	<b><?php echo $_SESSION['s_id']; ?></b>님 반갑습니다.
	  <button onclick="location.href='../login/logout.php'" 
		style=" font-size:15.5px;">로그아웃</button>
<?php } else { 
?>
	<div align=center>
	  <button onclick="location.href='../login/login.php'"
		 style=" font-size:15.5px;">로그인</button>
<?php
	}
?>
	  <button onclick="location.href='./board.php'" style=" font-size:15.5px;">목록으로</button><br/>
	</div>
<!DOCTYPE html>
<head>

<title>게시판</title>
<link rel="stylesheet" type="text/css" href="../css/view.css" />
<script type="text/javascript" src="../lib/jquery-3.2.1.min.js">
<script>

</script>
</head>
<body>
    <table class="view_table" align=center>
      <tr>
	<td colspan="6" class="view_title"><?php echo $data['b_title']?></td>
      </tr>
      <tr>
	<td class="view_id">작성자</td>
	<td class="view_id2"><?php echo $data['m_id']?></td>
	<td class="view_hit">조회수</td>
	<td class="view_hit2"><?php echo $data['b_hit']?></td>
	<td class="view_date">작성일</td>
	<td class="view_date2"><?php echo $data['b_date']?></td>
      </tr>
      <tr>
	<td class="view_file">파일</td>
<?php
	for($i=0; $i < sizeof($files); $i++){
		echo"<td class='view_file2'><a href='../uploads/$owner/$files[$i]' download>$files[$i]</a></td>";
	}
?>
      </tr>
      <tr>
	<td colspan="6" class="view_content" valign="top">
	<?php echo $cont?></td>
      </tr>
    </table>

<!-- 댓글 -->
<div class="reply_view">
  <h3>댓글 목록</h3>
<?php
	$replySql = "select * from reply where b_num ='{$b_num}' ";
	$sqlRe = mysqli_query($conn, $replySql);	
	$totalRe = mysqli_num_rows($sqlRe);
				
	while($reply = $sqlRe->fetch_array()) {
	$rcont  = $reply['r_cont'];
        $r_cont = nl2br(str_replace(" ","&nbsp;",$rcont));
?>
  <div class="dap_lo">
    <div><b><?php echo $reply['m_id'];?></b></div>
    <div class="dap_to comt_edit"><?php echo $r_cont ?></div>
    <div class="rep_me dap_to"><?php echo $reply['r_date']; ?> </div>
    <div class="rep_me rep_menu">
<!--	<a class="dat_edit_bt" href="./reply_update.php?b_num=<?=$reply['b_num']?>&r_num=<?=$reply['r_num']?>">수정</a> -->
	<a class="dat_delete_bt" href="./reply_delete.php?b_num=<?=$reply['b_num']?>&r_num=<?=$reply['r_num']?>">삭제</a>
    </div>
  </div>
<?php }
	if($totalRe== 0){
	echo "<div align=center><b>댓글이 없습니다</b></div>";
	}
 ?>

 <!-- 댓글 작성 -->
 <div class="dap_ins">
	<form action="doReply.php?b_num=<?php echo $b_num; ?>" method="post">
        <input type="hidden" name="b_num" class="b_num" value="<?php echo $b_num; ?>">
<?php
	if(isset($_SESSION['s_id'])){
	$repID = $_SESSION['s_id'];
?>

	  <input type="hidden" name="m_id" value="<?php echo $repID; ?>">
<?php } else { ?>
	  <input type="text" name="m_id" size="15" placeholder="아이디">
	  <input type="password" name="m_pwd" size="15" placeholder="비밀번호">
<?php } ?>
             <div style="margin-top:10px;">
                <textarea name="r_cont" class="re_cont" id="rep_cont"></textarea>
	<!--	<input type="submit"id="rep_bt" class="re_bt"  value="댓글쓰기"> -->
                <button id="rep_bt" class="re_bt">댓글</button>
            </div>
        </form>
    </div>
</div>
    <div class="view_btn">
	<button class="view_btn1" onclick="location.href='./board.php'">목록으로</button>&nbsp;&nbsp;
	<?php
	if(isset($_SESSION['s_id']) and $_SESSION['s_id'] == $data['m_id'] ) { ?>
	  <button class="view_btn1" onclick="location.href='./update.php?b_num=<?=$b_num?>'">수정</button>&nbsp;&nbsp;
	  <button class="view_btn1" onclick="check();">삭제</button>

	  <script>
		function check() {
         	  if( confirm("정말로 삭제하시겠습니까?") ) {
			window.location = "./delete.php?b_num=<?=$b_num?>"
		   }
  		}
	  </script>
	
	<?php }	?>
    </div>
</body>
</html>

