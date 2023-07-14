<?
   include "../common.php";

   $sel1 = $_REQUEST["sel1"];
   $text1 = $_REQUEST["text1"];

   if(!$text1)
      $query = "select * from member order by name31";
   else
      if ($sel1 == 1)
         $query = "select * from member where name31 like '%$text1%' order by name31;";
      else
         $query = "select * from member where uid31 like '%$text1%' order by name31;";

   $result = mysqli_query($db, $query);
   if (!$result) exit("에러: $query");
   
   $count = mysqli_num_rows($result);

   $page = $_REQUEST["page"];
   if (!$page) $page = 1;
   $pages = ceil($count/$page_line);
   $first = 1;
   if ($count > 0) $first = $page_line * ($page - 1);
   $page_last = $count - $first;
   if ($page_last > $page_line) $page_last = $page_line;

   if ($count > 0) mysqli_data_seek($result, $first);
?>

<html>
<head>
<title>쇼핑몰 관리자 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
</head>

<body style="margin:0">

<center>

<br>
<script> document.write(menu());</script>

<table width="800" border="0">
	<form name="form1" method="post" action="member.php">
	<tr height="40">
		<td width="200" valign="bottom">&nbsp 회원수 : <font color="#FF0000"><?= $count ?></font></td>
		<td width="540" align="right" valign="bottom">
         <?
            echo("<select name='sel1'>");
            for ($i = 1; $i < $n_idname; $i++) {
               if ($sel1 == $i)
                  echo("<option value='$i' selected>$a_idname[$i]</option>");
               else  
                  echo("<option value='$i'>$a_idname[$i]</option>");
            }
            echo("</select>");
         ?>
			<input type="text" name="text1" size="15" value="" class="font9">&nbsp
		</td>
		<td width="60" valign="bottom">
			<input type="button" value="검색" onclick="javascript:form1.submit();">&nbsp
		</td>
	</tr>
	</form>
</table>

<table width='800' border='1' cellpadding='2' style='border-collapse:collapse'>
            <tr bgcolor='#CCCCCC' height='23'> 
               <td width='100' align='center'>ID</td>
               <td width='100' align='center'>이름</td>
               <td width='100' align='center'>전화</td>
               <td width='100' align='center'>핸드폰</td>
               <td width='200' align='center'>E-Mail</td>
               <td width='100' align='center'>회원구분</td>
               <td width='100' align='center'>수정/삭제</td>
            </tr>

<?
   for ($i = 0; $i < $page_last; $i++) {
      $row = mysqli_fetch_array($result);

      $phone1 = trim(substr($row["phone31"], 0, 3));
      $phone2 = trim(substr($row["phone31"], 3, 4));
      $phone3 = trim(substr($row["phone31"], 7, 4));

      $phone = $phone1."-".$phone2."-".$phone3;

      $tel1 = trim(substr($row["tel31"], 0, 3));
      $tel2 = trim(substr($row["tel31"], 3, 4));
      $tel3 = trim(substr($row["tel31"], 7, 4));

      $tel = $tel1."-".$tel2."-".$tel3;

      if ($row["gubun31"] == 0) {
         $gubun = "회원";
      } else {
         $gubun = "비회원";
      }

      echo("
            <tr bgcolor='#F2F2F2' height='23'>	
               <td width='100'>&nbsp $row[uid31]</td>	
               <td width='100'>&nbsp $row[name31]</td>	
               <td width='100'>&nbsp $tel</td>	
               <td width='100'>&nbsp $phone</td>	
               <td width='200'>&nbsp $row[email31]</td>
               <td width='100' align='center'>$gubun</td>	
               <td width='100' align='center'>
                  <a href='member_edit.php?no=$row[no31]&page=&sel1=&text1='>수정</a>/
                  <a href='member_delete.php?no=$row[no31]&page=&sel1=&text1=' onclick='javascript:return confirm('삭제할까요 ?');'>삭제</a>
               </td>
            </tr>
      ");
   }


echo("
      </table>
      <table width='400' border='0' cellspacing='0' cellpadding='0'>
         <tr>
            <td height='20' align='center'>
 ");

   $blocks = ceil($pages/$page_block);
   $block = ceil($page/$page_block);
   $page_s = $page_block * ($block - 1);
   $page_e = $page_block * $block;

   if ($blocks <= $block) $page_e = $pages;

   if ($block > 1) {
      $tmp = $page_s;
      echo("
         <a href='member.php?page=$tmp&sel1=$sel1&text1=$text1'>
            <img src='images/i_prev.gif' align='absmiddle' border='0'>
         </a>&nbsp
      ");
   }

   for($i = $page_s + 1; $i <= $page_e; $i++) {
      if ($page == $i)
         echo("&nbsp;<font ed'> <b>$i</b> </font>&nbsp");
      else
         echo("&nbsp;<a href='member.php?page=$i&sel1=$sel1&text1=$text1'>[$i]</a>&nbsp");
   }

   if ($block < $blocks) {
      $tmp = $page_e + 1;

      echo("
         <a href='member.php?page=$tmp&sel1=$sel1&text1=$text1'>
            <img src='images/i_next.gif' align='absmiddle' border='0'>
         </a>
      ");
   }

   echo("
            </td>
         </tr>
      </table>
   ");
?>

</center>

</body>
</html>