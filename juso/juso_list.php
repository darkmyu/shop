<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
  include "common.php";

  $text1 = $_REQUEST['text1'];
?>

<html>

<head>
   <title>주소록 프로그램</title>
   <meta http-equiv="content-type" content="text/html; charset=utf-8">
   <link rel="stylesheet" href="font.css">
</head>

<body>

   <table width="600" border="0">
      <form name="form1" method="post" action="juso_list.php">
         <tr>
            <td width="400">&nbsp
               이름 : <input type="text" name="text1" size="10" value="">
               <input type="button" value="검색" onClick="javascript:form1.submit();">
            </td>
            <td align="right"><a href="juso_new.html">입력</a>&nbsp</td>
         </tr>
      </form>
   </table>

   <table width="600" border="1" cellpadding="2" style="border-collapse:collapse">
      <tr bgcolor="lightblue">
         <td width="70" align="center">이름</td>
         <td width="100" align="center">전화</td>
         <td width="50" align="center">음/양</td>
         <td width="80" align="center">생일</td>
         <td width="250" align="center">주소</td>
         <td width="50" align="center">삭제</td>
      </tr>
      <?
      // sj => juso 변경
    $query = "select * from juso order by name31;";

    if(!$text1)
      $query = "select * from juso order by name31;";
    else
      $query = "select * from juso where name31 like '%$text1%' order by name31;";

    $result = mysqli_query($db, $query);
    if (!$result) exit("에러: $query");

    $count = mysqli_num_rows($result);

     $page = $_REQUEST['page'];
     if (!$page) $page = 1;
     $pages = ceil($count/$page_line);
     $first = 1;
     if ($count > 0) $first = $page_line * ($page - 1);
     $page_last = $count - $first;
     if ($page_last > $page_line) $page_last = $page_line;

     if ($count > 0) mysqli_data_seek($result, $first);

    for ($i=0; $i<$page_last; $i++) {
      $row = mysqli_fetch_array($result);

      // list result_ telnum
      $tel1 = trim(substr($row['tel31'], 0, 3));
      $tel2 = trim(substr($row['tel31'], 3, 4));
      $tel3 = trim(substr($row['tel31'], 7, 4));

      $tel = $tel1."-".$tel2."-".$tel3;

      // list result_ smkor
      if ($row['sm31'] == 0)
         $sm = "양력";
      else
         $sm = "음력";

      echo("<tr bgcolor='lightyellow'>
		<td align='center'>&nbsp
			<a href='juso_edit.php?no=$row[no31]'>$row[name31]</a>
		</td>
        <td width'50'  align='center'>$tel</td>
        <td width'50'  align='center'>$sm</td>
        <td width'50'  align='center'>$row[birthday31]</td>
        <td width'50'  align='left'>$row[juso31]</td>
          <td align='center'>
            <a href='juso_delete.php?no=$row[no31]' onClick='javascript:return confirm(\"삭제할까요 ? \");'>
            삭제
          </td>
      </tr>");
    }

    echo("<table width='400' border='0' cellspacing='0' cellpadding='0'>
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
         <a href='juso_list.php?page=$tmp&text1=$text1'>
            <img src='images/i_prev.gif' align='absmiddle' border='0'>
         </a>&nbsp
       ");
    }

    for($i = $page_s + 1; $i <= $page_e; $i++) {
       if ($page == $i)
         echo("&nbsp;<font ed'> <b>$i</b> </font>&nbsp");
       else
         echo("&nbsp;<a href='juso_list.php?page=$i&text1=$text1'>[$i]</a>&nbsp");
    }

    if ($block < $blocks) {
       $tmp = $page_e + 1;

       echo("
         <a href='juso_list.php?page=$tmp&text1=$text1'>
            <img src='images/i_next.gif' align='absmiddle' border='0'>
         </a>
       ");
    }

    echo("
            </td>
         </tr>
      </table>
    ")
  ?>
   </table>

</body>

</html>