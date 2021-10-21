<?php
	include "/home/test/data/db.php";
?>

<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>회원 로그인 화면</title>
<link rel="stylesheet" type="text/css" href="../css/common.css" />
</head>
<body>
<?php
	$URL="../board/board.php";
	if(isset($_SESSION['s_id'])){
?>
	<script>
		alert("환영합니다.<?php echo $_SESSION['s_id'];?>님");
		location.replace("<?php echo $URL ?>");
	</script>
<?php 
	}
?>
	
  <div id="login_box">
	<h1>로그인</h1>
	    <form method="post" action="./login_ok.php">
		<table align="center" border="0" cellspacing="0" width="300">
		    <tr>
			<td width="130" colspan="1">
			  <input type="text" name="userid" class="inph">
		        </td>
			<td rowspan="2" align="center" width="100">
			  <button type="submit" id="btn">로그인</button>
			</td>
	            </tr>
		    <tr>
			<td with="130" colspan="1">
			  <input type="password" name="userpwd" class="inph">
			</td>
		    </tr>
		    <tr>
			<td colspan="3" align="center" class="mem">
			  <a href="../member/join.php">회원가입</a>
			  <input type="button" value="회원가입" id="btn"
				 onclick="location.href='../member/join.php'">
			  <input type="button" value="게시판으로" id="btn"
				 onclick="location.href='../board/board.php'">
			</td>
		   </tr>
		</table>
	  </form>
  </div>
</body>
</html>

