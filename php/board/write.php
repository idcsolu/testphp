<?php
	require_once("/home/test/data/db_info.php");
	session_start();
	
	$URL = "../login/login.php";
	if(!isset($_SESSION['s_id'])) {
?>
	<script>
		alert("로그인이 필요합니다.");
		location.replace("<?php echo $URL ?>");
	</script>
<?php } ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>게시글 쓰기</title>
	<link rel="stylesheet" type="text/css" href="../css/write.css" />
</head>
<body>
 <form method="post" action="doWrite.php" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
    <table style="padding-top:50px" align=center width=auto border=0 cellpadding=2>
      <tr>
        <td style="height:40; float:center; background-color:#3C3C3C">
        <p style="font-size:25px; text-align:center; color:white; margin-top:15px; margin-bottom:15px"><b>게시글 작성하기</b></p>
        </td>
      </tr>
      <tr>
        <td bgcolor=white>
          <table class="table2">
            <tr>
              <td>작성자</td>
              <td>
	        <input type="hidden" name="m_id"
                 value="<?= $_SESSION['s_id'] ?>"><?= $_SESSION['s_id'] ?>
     	      </td>
            </tr>
            <tr>
              <td>제목</td>
              <td><input type="text" name="b_title" size=87 required></td>
            </tr>
            <tr>
              <td>내용</td>
              <td><textarea name="b_cont" cols=75 rows=15></textarea></td>
            </tr>
	    <tr>
	      <td>파일첨부</td>
	      <td><input type="file" name="upfile[]" multiple="multiple" /></td>
	    </tr>
          </table>
          <center>
            <input style="height:26px; width:100px; font-size:16px;" type="submit" value="작성">
	    <input style="height:26px; width:100px; font-size:16px;" type="button" value="취소"
		 onclick="history.back(-1);">
          </center>
          </td>
       </tr>
    </table>
 </form>
</body>
</html>

