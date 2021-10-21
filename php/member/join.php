<?php
	include "/home/test/data/db.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>회원가입 하기</title>
<style>
#form {
	border : 20px solid lightblue;
	padding: 5px 20px;
	position:absolute;
	top:50%; left:50%;
	display:flex;
	flex-direction:column;
	justify-content:center;
	align-items:center;
	width:550px; height:350px;
	margin-left : -250px;
	margin-top  : -170px;
	
}
</style>
<script>
function checkid() {
	var userid = document.getElementById("userid").value;
	
	var windowX = (document.body.offsetWidth / 2 ) - ( 300 / 2 );
	windowX    += window.screenLeft;
	var windowY = (window.screen.height / 2  ) - ( 100 / 2 );


	if(userid){
		url = "join_ok.php?userid="+userid;
		window.open(url,"chkid", 'height=100, width=300, left='+ windowX + ', top='+ windowY);
	} else {
		alert("아이디를 입력하세요");
	}
}
	
</script>
</head>
<body>
<div id="form">
    <form method="post" action="member_ok.php" >
	<h1>회원가입 형식</h1>
	    <fieldset>
		<legend>입력사항</legend>
		    <table>
			<tr>
			    <td>아이디</td>
			    <td>
				<input type="text" size="35" name="userid" placeholder="아이디" id="userid">
			    </td>
			    <td>
				<input type="button"  value="중복확인" onclick="checkid();"/ >
				<input type="hidden"  value="0" name="chs" />
			    </td>
			</tr>
			<tr>
			    <td>비밀번호</td>
			    <td>
                               <input type="password" size="35" name="userpwd"
		                placeholder="비밀번호">
			    </td>
			</tr>
			<tr>
			    <td>비밀번호 확인</td>
                            <td>
                               <input type="password" size="35" name="reuserpwd"
                                placeholder="비밀번호 확인">
                            </td>
                        </tr>
			<tr>
			    <td>이름</td>
			    <td>
			       <input type="text" size="35" name="username" placeholder="이름">
                            </td>
			</tr>
		    </table>
		
		<input type="submit" value="가입하기" /><input type="reset" value="다시쓰기"/>
		&nbsp&nbsp&nbsp&nbsp<a href="../login/login.php">이미 가입하신 회원입니까?</a>
	</fieldset>
    </form>
</div>
</body>
</html>
