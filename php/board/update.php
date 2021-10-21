<?php
?>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="../css/update.css" />
</head>
<body>
    <?php
	include "/home/test/data/db.php";
	$num    = $_GET['b_num'];
	$sql    = "select b_num, b_title, b_cont, b_date, b_hit, m_id, b_file from board where b_num = $num";
	$result = mysqli_query($conn, $sql);
	$data   = mysqli_fetch_assoc($result);

	$title  = $data['b_title'];
	$cont   = $data['b_cont'];
	$id     = $data['m_id'];
	$file   = $data['b_file'];
	
	$URL	= "./board.php";
	
	if(!isset($_SESSION['s_id'])) {
	?> <script>	
	    alert("권한이 없습니다.");
            location.replace("<?php echo $URL ?>");
        </script>
    <?php   } else if ($_SESSION['s_id'] == $id) {
    ?>
        <form method="POST" action="doUpdate.php" enctype="multipart/form-data" >
            <table style="padding-top:50px" align=center width=auto border=0 cellpadding=2>
                <tr>
                    <td style="height:40; float:center; background-color:#3C3C3C">
                        <p style="font-size:25px; text-align:center; color:white; 
				margin-top:15px; margin-bottom:15px"><b>게시글 수정하기</b></p>
                    </td>
                </tr>
                <tr>
                    <td bgcolor=white>
                        <table class="table2">
                            <tr>
                                <td>작성자</td>
                                <td><input type="hidden" name="m_id" 
				value="<?= $_SESSION['s_id'] ?>"><?= $_SESSION['s_id'] ?>
				</td>
                            </tr>

                            <tr>
                                <td>제목</td>
                                <td><input type="text" name="b_title" size="87" value="<?= $title ?>"></td>
                            </tr>

                            <tr>
                                <td>내용</td>
                                <td><textarea name="b_cont" cols="80" rows="20"><?= $cont ?></textarea></td>
                            </tr>
<?php
	if($file == ""){
	  echo "<tr><td>파일 첨부</td>
		<td><input type='file' name='upnewfile' multiple='multiple'></td></tr>";
		
	} else {
	  echo "<tr><td>첨부 파일</td>
	  	<input type='hidden' name='upfile' value='$file'>
		<td>$file</td></tr>";
		
	}
?>
                        </table>
                        <center>
                            <input type="hidden" name="b_num" value="<?= $num ?>">
                            <input style="height:26px; width:47px; font-size:16px;"
				 type="submit" value="수정">
			    <input style="height:26px; width:47px; font-size:16px;" 
				 type="button" value="취소"
		                 onclick="history.back(-1);">
                        </center>
                    </td>
                </tr>
            </table>
        </form>
    <?php   } else {
    ?> <script>
            alert("권한이 없습니다.");
            location.replace("<?php echo $URL ?>");
        </script>
    <?php   }
    ?>
</body>
</html>

