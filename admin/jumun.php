<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	

<?php
	include "../common.php";

	$day1_y = $_REQUEST['day1_y'];
	$day1_m = $_REQUEST['day1_m'];
	$day1_d = $_REQUEST['day1_d'];
	$day2_y = $_REQUEST['day2_y'];
	$day2_m = $_REQUEST['day2_m'];
	$day2_d = $_REQUEST['day2_d'];
	$sel1 = $_REQUEST['sel1']; // 주문상태 선택
	$sel2 = $_REQUEST['sel2']; // 주문번호, 고객명 .... 선택
	$text1 = $_REQUEST['text1'];

	$k = 0;
	if (!$day1_y && !$day1_m && !$day1_d && !$day2_y && !$day2_m && !$day2_d) {
		$day1_y = 2020;
		$day1_m = 1;
		$day1_d = 1;
		$day2_y = 2020;
		$day2_m = 12;
		$day2_d = 31;
	}

	$day1 = $day1_y.$day1_m.$day1_d;
	$day2 = $day2_y.$day2_m.$day2_d;
	$s[$k] = "date(jumunday31) between ".$day1." and ".$day2;
	$k++;

	if ($sel1 != 0) {
		$s[$k] = "state31=".$sel1;
		$k++;
	}

	if ($text1) {
		if ($sel2 == 1) {
			$s[$k] = "no31 like '%".$text1."%'";
			$k++;
		} else if ($sel2 == 2) {
			$s[$k] = "o_name31 like '%".$text1."%'";
			$k++;
		} else if ($sel2 == 3) {
			$s[$k] = "product_names31 like '%".$text1."%'";
			$k++;
		}
	}

	if ($k > 0) {
		$tmp = implode(" and ", $s);
		$tmp = "where ".$tmp;
	}

	$query = "select * from jumun ".$tmp." order by no31 desc;";
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	$count = mysqli_num_rows($result);

	if ($count != 0) {
		$page = $_REQUEST['page'];
		if (!$page) $page = 1;
		$pages = ceil($count/$page_line);
		$first = 1;
		if ($count > 0) $first = $page_line * ($page - 1);
		$page_last = $count - $first;
		if ($page_last > $page_line) $page_last = $page_line;
	 
		if ($count > 0) mysqli_data_seek($result, $first);
	 }
?>


<html>
<head>
<title>쇼핑몰 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
<script>
	function go_update(no,pos)
	{
		state=form1.state[pos].value;
		location.href="jumun_update.php?no="+no+"&state="+state+"&page="+form1.page.value+
			"&sel1="+form1.sel1.value+"&sel2="+form1.sel2.value+"&text1="+form1.text1.value+
			"&day1_y="+form1.day1_y.value+"&day1_m="+form1.day1_m.value+"&day1_d="+form1.day1_d.value+
			"&day2_y="+form1.day2_y.value+"&day2_m="+form1.day2_m.value+"&day2_d="+form1.day2_d.value;
	}
</script>
</head>

<body style="margin:0">

<center>

<br>
<script> document.write(menu());</script>

<form name="form1" method="post" action="jumun.php">
<input type="hidden" name="page" value="0">

<table width="800" border="0" cellspacing="0" cellpadding="0">
	<tr height="40">
		<td align="left"  width="70" valign="bottom">&nbsp 주문수 : <font color="#FF0000">20</font></td>
		<td align="right" width="730" valign="bottom">
			기간 : 
			<input type="text" name="day1_y" size="4" value="2020">
			<select name="day1_m">
				<?php
					for ($i = 1; $i <= 12; $i++) {
						if ($i <= 9)
							$values = "0".$i;
						else
							$values = $i;

						if ($i == $day1_m)
							echo("<option value='$values' selected>$i</option>");
						else
							echo("<option value='$values'>$i</option>");
					}
				?>
			</select>
			<select name="day1_d">
				<?php
					for ($i = 1; $i <= 31; $i++) {
						if ($i <= 9)
							$values = "0".$i;
						else
							$values = $i;

						if ($i == $day1_d)
							echo("<option value='$values' selected>$i</option>");
						else
							echo("<option value='$values'>$i</option>");
					}
				?>
			</select> - 
			<input type="text" name="day2_y" size="4" value="2020">
			<select name="day2_m">
				<?php
					for ($i = 1; $i <= 12; $i++) {
						if ($i <= 9)
							$values = "0".$i;
						else
							$values = $i;

						if ($i == $day2_m)
							echo("<option value='$values' selected>$i</option>");
						else
							echo("<option value='$values'>$i</option>");
					}
				?>
			</select>
			<select name="day2_d">
				<?php
					for ($i = 1; $i <= 31; $i++) {
						if ($i <= 9)
							$values = "0".$i;
						else
							$values = $i;

						if ($i == $day2_d)
							echo("<option value='$values' selected>$i</option>");
						else
							echo("<option value='$values'>$i</option>");
					}
				?>
			</select> &nbsp
			<select name="sel1">
				<?php
					for ($i = 0; $i < $n_state; $i++) {
						if ($sel1 == $i)
							echo("<option value='$i' selected>$a_state[$i]</option>");
						else
							echo("<option value='$i'>$a_state[$i]</option>");
					}
				?>
			</select> &nbsp 
			<select name="sel2">
				<option value="1">주문번호</option>
				<option value="2">고객명</option>
				<option value="3">상품명</option>
			</select>
			<input type="text" name="text1" size="10" value="">&nbsp
			<input type="button" value="검색" onclick="javascript:form1.submit();"> &nbsp;
		</td>
	</tr>
	</tr><td height="5" colspan="2"></td></tr>
</table>

<table width="800" border="1" cellpadding="0" style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC" height="23"> 
		<td width="70"  align="center">주문번호</td>
		<td width="70"  align="center">주문일</td>
		<td width="250" align="center">상품명</td>
		<td width="50"  align="center">제품수</td>	
		<td width="70"  align="center">총금액</td>
	    <td width="65"  align="center">주문자</td>
		<td width="50"  align="center">결재</td>
		<td width="135" align="center" colspan="2">주문상태</td>
	    <td width="50"  align="center">삭제</td>
	</tr>
	<?php
		for ($i = 0; $i < $page_last; $i++) {
			$row = mysqli_fetch_array($result);
			$total_cash = number_format($row['total_cash31']);

			if ($row['pay_method31'] == 0) {
				$showPay_method = "카드";
			} else {
				$showPay_method = "무통장";
			}

			if ($row['state31'] == 5) $color="blue";
			else if ($row['state31'] == 6) $color="red";
			else $color="black";

			echo("
			<tr bgcolor='#F2F2F2' height='23'> 
				<td width='70'  align='center'><a href='jumun_info.php?no=$row[no31]'>$row[no31]</a></td>
				<td width='70'  align='center'>$row[jumunday31]</td>
				<td width='250' align='left'>&nbsp; $row[product_names31]</td>	
				<td width='40' align='center'>$row[product_nums31]</td>	
				<td width='70'  align='right'>$total_cash&nbsp</td>	
				<td width='65'  align='center'>$row[o_name31]</td>	
				<td width='50'  align='center'>$showPay_method</td>
				<td width='85' align='center' valign='bottom'>
					<select name='state' style='font-size:9pt; color:$color'>
			");
						for ($j = 1; $j < $n_state; $j++) {
							if ($row['state31'] == $j)
								echo("<option value='$j' selected>$a_state[$j]</option>");
							else
								echo("<option value='$j'>$a_state[$j]</option>");
						}

			echo("
					</select>&nbsp;
				</td>
				<td width='50' align='center'>
					<a href='javascript:go_update($row[no31], $i);'><img src='images/b_edit1.gif' border='0'></a>
				</td>	
				<td width='50' align='center'>
					<a href='jumun_delete.php?no=$row[no31]' onclick='javascript:return confirm('삭제할까요 ?');'><img src='images/b_delete1.gif' border='0'></a>
				</td>
			</tr>
			");
		}
	?>
</table>

<input type="hidden" name="state">

<?
   echo("
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
         <a href='jumun.php?day1_y=$day1_y&day1_m=$day1_m&day1_d=$day1_d&day2_y=$day2_y&day2_m=$day2_m&day2_d=$day2_d&sel1=$sel1&sel2=$sel2&text1=$text1&page=$tmp'>
            <img src='images/i_prev.gif' align='absmiddle' border='0'>
         </a>&nbsp
      ");
   }

   for($i = $page_s + 1; $i <= $page_e; $i++) {
      if ($page == $i)
         echo("&nbsp;<font ed'> <b>$i</b> </font>&nbsp");
      else
         echo("&nbsp;<a href='jumun.php?day1_y=$day1_y&day1_m=$day1_m&day1_d=$day1_d&day2_y=$day2_y&day2_m=$day2_m&day2_d=$day2_d&sel1=$sel1&sel2=$sel2&text1=$text1&page=$i'>[$i]</a>&nbsp");
   }

   if ($block < $blocks) {
      $tmp = $page_e + 1;

      echo("
         <a href='jumun.php?day1_y=$day1_y&day1_m=$day1_m&day1_d=$day1_d&day2_y=$day2_y&day2_m=$day2_m&day2_d=$day2_d&sel1=$sel1&sel2=$sel2&text1=$text1&page=$tmp'>
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

<!-- <table width="800" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="30" class="cmfont" align="center">
			<img src="images/i_prev.gif" align="absmiddle" border="0"> 
			<font color="#FC0504"><b>1</b></font>&nbsp;
			<a href="jumun.html?page=2&sel1=&sel2=&text1=&day1_y=&day1_m=&day1_d=&day2_y=&day2_m=&day2_d="><font color="#7C7A77">[2]</font></a>&nbsp;
			<a href="jumun.html?page=3&sel1=&sel2=&text1=&day1_y=&day1_m=&day1_d=&day2_y=&day2_m=&day2_d="><font color="#7C7A77">[3]</font></a>&nbsp;
			<img src="images/i_next.gif" align="absmiddle" border="0">
		</td>
	</tr>
</table> -->

</form>

</center>

</body>
</html>