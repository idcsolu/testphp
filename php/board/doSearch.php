<!DOCTYPE html>
<html>
<head>
        <meta charset = 'utf-8'>
	<link rel="stylesheet" type="text/css" href="../css/board.css">
</head>
<body>
<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	
        require_once("/home/test/data/db_info.php");
	$conn = mysqli_connect($SERV, $USER, $PASS, $DBNM) or die("fail");
	
	session_start();
	$category = $_GET['category'];
        $search   = $_GET['search'];
	$find     = "'%{$search}%'";	
        switch($category) {
          case 'b_title':
            $keyword = '제목';
            break;
          case 'm_id':
            $keyword = '작성자';
	    $find    = "'{$search}%'";
            break;
          case 'b_cont':
            $keyword = '내용';
            break;
        }

	if(isset($_GET['page'])){
	  $page = $_GET['page'];
	} else {
	  $page = 1;
	}
	$list = 8;
	$block_ct = 5;
	
	$block_num = ceil($page/$block_ct);
	$block_start = (($block_num -1 ) * $block_ct ) + 1;
	$block_end   = $block_start + $block_ct - 1;
	
	$query  = "select * from board where $category like $find
		order by b_num desc";
	$result = $conn->query($query);	
	$total = mysqli_num_rows($result);

	$total_page  = ceil($total / $list);
	if($block_end > $total_page) $block_end = $total_page;
	$total_block = ceil($total_page/$block_ct);
	$start_num = ($page-1) * $list;
	$query2 = "select * from board where $category like '%{$search}%'
		 order by b_num desc limit $start_num, $list";
	$result2 = $conn->query($query2);

?>
<div>
<h1 align="center">'<?=$keyword?>' 에서 '<b><?=$search?></b>' 검색 결과</h1>
</div>
<div id="form">
<?php
	if(!isset($_SESSION['s_id'])) {
?>
	<form action="../login/login_ok.php" method="post">
		아이디 : <input type="text" name="userid" size="10" required/>
		비밀번호 : <input type="password" name="userpwd" size="10" required/>&nbsp&nbsp
		<input type="submit" name="login" value="로그인" />&nbsp&nbsp
		<input type="button" value="회원가입" onclick="location.href='../member/join.php'">
	</form>
<?php }	else {
	echo "Welcome ".$_SESSION['s_id'];  
?>
	&nbsp&nbsp&nbsp
	<input type="button" value="로그아웃" onclick="location.href='../login/logout.php'">
	&nbsp&nbsp&nbsp
	<input type="button" value="글쓰기"   onclick="location.href='./write.php'">
<?php } ?>
	&nbsp&nbsp<input type="button" value="전체보기" onclick="location.href='./board.php'">
</div>      
<br/><br/>
        <table align = center>
        <thead align = "center">
        <tr>
         <td width = "50"  align = "center">번호</td>
         <td width = "500" align = "center">제목</td>
         <td width = "100" align = "center">작성자</td>
         <td width = "200" align = "center">날짜</td>
         <td width = "50"  align = "center">조회수</td>
        </tr>
	</thead>
	<tbody>
<?php

	while($board = $result2->fetch_assoc() ) {
	$title = $board['b_title'];
	if(strlen($title)>30){
	$title =str_replace($board['b_title'], mb_substr($board['b_title'],0,30,"utf-8")."...",$board['b_title']);}
	$countRe = "select * from reply where b_num = '".$board['b_num']."'";
	$resultRe = mysqli_query($conn, $countRe);
	$reCount  = mysqli_num_rows($resultRe);
	
	if($total%2==0){
?>
	  	<tr class = "even">      
<?php   } else {
?>
		<tr>
<?php } ?>
          <td width="50"  align="center"><?php echo $board['b_num'] ?></td>
          <td width="500" align="center">
		<a href="./view2.php?b_num=<?=$board['b_num']?>" onclick="hit();" >
		<?php echo $board['b_title']?><span class="re_ct">[<?php echo $reCount; ?>]</span>
		</a>
	  </td>
          <td width="100" align="center"><?php echo $board['m_id']?></td>
          <td width="200" align="center"><?php echo $board['b_date']?></td>
          <td width="50"  align="center"><?php echo $board['b_hit']?></td>
        </tr>
<?php
	$total--;
	}
?>
        </tbody>
        </table>
	
      <div id="page_num">
	<ul>
<?php
	   if($page <= 1){
		echo "<li class='fo_re'>처음</li>";
	   } else {
		echo "<li><a href='doSearch.php?category=$category&search=$search&page=1'>처음</a></li>";
	   }
           if($page <= 1){
	   } else {
		$pre = $page - 1;
		echo "<li><a href='doSearch.php?category=$category&search=$search&page=$pre'>이전</a></li>";
	   }
	   for($i=$block_start; $i<=$block_end; $i++) { 
		if($page == $i) {
			echo"<li class='fo_re'>[$i]</li>";
		} else {
			echo"<li><a href='doSearch.php?category=$category&search=$search&page=$i'>[$i]</a></li>";
		}
	   }
	   if($block_num >= $total_block) {
	   } else {
		$next = $page + 1;
		echo "<li><a href='doSearch.php?category=$category&search=$search&page=$next'>다음</a></li>";
	   }
	   if($page >= $total_page) {
		echo "<li class='fo_re'>마지막</li>";
	   } else {
		echo "<li><a href='doSearch.php?category=$category&search=$search&page=$total_page'>마지막</a></li>";
	  }
?>
	</ul>
     </div>
	
     <!--검색 기능 -->
      <div id="search_box" style="text-align:center; padding-top:10px;">
	<form action="doSearch.php" method="get">
	  <select name="category">
		<option value="b_title" <?php if($category == "b_title") echo "SELECTED";?>>제목</option>
		<option value="m_id" <?php if($category == "m_id") echo "SELECTED";?>>작성자</option>
		<option value="b_cont" <?php if($category == "b_cont") echo "SELECTED";?>>내용</option>
	  </select>
	  <input type="text" name="search" size="30" value="<?=$search ?>">
	  <button class="btn btn-primary">검색</button>
	</form>
     </div>      
    <!--검색 기능 끝-->
</body>
</html>
