<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
   include "../common.php";
   
   $text1 = $_REQUEST['text1'];
   $no1 = $_REQUEST['no1']; // opt.php > 번호

   if(!$text1) {
      $query = "select * from opts where opt_no31='$no1' order by no31;";
   } else {
      $query = "select * from opts where opt_no31='$no1' and name31 like '%$text1%' order by no31;";
   }

   $result = mysqli_query($db, $query);
   if (!$result) exit("에러: $query");

   $query_1 = "select * from opt where no31=$no1;";

   $result_1 = mysqli_query($db, $query_1);
   if (!$result) exit("에러: $query_1");

   $row_1 = mysqli_fetch_array($result_1);

   $count = mysqli_num_rows($result);
?>

<html>
<head>
<title>쇼핑몰 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
<script>
	function go_new()
	{
		location.href="opts_new.php?no1=<?= $no1 ?>";
	}
</script>
</head>

<body style="margin:0">

<center>

<br>
<script> document.write(menu());</script>

<form name="form1" method="post" action="opts.php?no1=<?= $no1 ?>">
   <table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr height="50">
         <td align="left"  width="300" height="50" valign="bottom">&nbsp 옵션명 : <font color="#0457A2"><b><?= $row_1['name31'] ?></b></font></td>
         <td align="right"  width="250" height="50" valign="bottom">
               옵션 : <input type="text" name="text1" size="10" value="">
               <input type="button" value="검색" onClick="javascript:form1.submit();">
            </td>
         <td align="right" width="200" valign="bottom">
            <input type="button" value="신규입력" onclick="javascript:go_new();"> &nbsp
         </td>
      </tr>
      <tr><td height="5" colspan="2"></td></tr>
   </table>
</form>

<table width="500" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC" height="20"> 
		<td width="100" align="center"><font color="#142712">소옵션번호</font></td>
		<td width="300" align="center"><font color="#142712">소옵션명</font></td>
		<td width="100" align="center"><font color="#142712">수정/삭제</font></td>
   </tr>
   <?
      for ($i = 0; $i < $count; $i++) {
         $row = mysqli_fetch_array($result);

         echo("
            <tr bgcolor='#F2F2F2' height='20'>	
               <td width='100' align='center'>$row[no31]</td>
               <td width='300' align='center'>$row[name31]</td>
               <td width='100' align='center'>
                  <a href='opts_edit.php?no1=$no1&no2=$row[no31]'>수정</a>/
                  <a href='opts_delete.php?no1=$no1&no2=$row[no31]' onclick='javascript:return confirm('삭제할까요 ?');'>삭제</a>
               </td>
            </tr>
         ");
      }
   ?>
</table>
</center>

</body>
</html>