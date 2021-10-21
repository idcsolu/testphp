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
<div id="login_wrapper">
<h1><p align=center>로그인</p></h1>
	<form method="post" action="./login_ok.php">
		<table align="center" border="0" cellspacing="0" width="500"
			bordercolordark=white bordercolorlight=#999999>
		    <tr>
			<td class="topline" width=150>
			   <p align=center>아이디</p>
			</td>
			<td class="topline" width=200>			  
			   <input type="text" name="userid" style="height:25px">
			</td>
			<td class="buttonline" rowspan="2" align=center>
			  <button type="submit" style="height:100px; width:130px">로그인</button>
			</td>
	            </tr>
		    <tr>
			<td class="botline" with="150">
			  <p align=center>비밀번호</p>
			</td>
			<td class="botline" width=200>
			  <input type="password" name="userpwd" style="height:25px">
			</td>
		    </tr>
		    <tr>
			<td colspan="3" align="center">
			  <a href="../member/join.php" target="_self"
				style="text-decoration:none">회원가입하기</a></td>
			</td>
		   </tr>
		</table>
	</form>
</div>
</body>
</html>

