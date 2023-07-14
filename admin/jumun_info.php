<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?php
	include "../common.php";
	
	$no = $_REQUEST['no'];

	$query = "select * from jumun where no31='$no';";
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");

	$row = mysqli_fetch_array($result);

	$query = "select 
				opts1.name31 as opts1_name,
				opts2.name31 as opts2_name,
				jumuns.discount31 as jumuns_discount,
				product.name31 as product_name,
				jumuns.num31 as jumuns_num,
				jumuns.price31 as jumuns_price,
				jumuns.cash31 as jumuns_cash
				from ((jumuns left join product on jumuns.product_no31=product.no31) 
				left join opts as opts1 on jumuns.opts_no1=opts1.no31)
				left join opts as opts2 on jumuns.opts_no2=opts2.no31 where jumuns.jumun_no31='$no';";
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
?>


<html>
<head>
<title>쇼핑몰 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
</head>

<body style="margin:0">

<center>

<br>
<script> document.write(menu());</script>
<br>
<br>

<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
		<?php
			if ($row['state31'] == 5) $color = "blue";
			else if ($row['state31'] == 6) $color = "red";
			else $color = "black";
		?>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문번호</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE">&nbsp;<font size="3"><b><?= $row['no31'] ?> (<font color=<?= $color ?>><?= $a_state[$row['state31']] ?></font>)</b></font></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문일</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $row['jumunday31'] ?></td>
	</tr>
</table>
<br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
		<?php
			if ($row['member_no31'] == 0) $showMember = "비회원";
			else $showMember = "회원";

			$o_tel1 = trim(substr($row['o_tel31'], 0, 3));
			$o_tel2 = trim(substr($row['o_tel31'], 3, 4));
			$o_tel3 = trim(substr($row['o_tel31'], 7, 4));
			$o_tel = $o_tel1."-".$o_tel2."-".$o_tel3;
			
			$o_phone1 = trim(substr($row['o_phone31'], 0, 3));
			$o_phone2 = trim(substr($row['o_phone31'], 3, 4));
			$o_phone3 = trim(substr($row['o_phone31'], 7, 4));
			$o_phone = $o_phone1."-".$o_phone2."-".$o_phone3;

			$r_tel1 = trim(substr($row['r_tel31'], 0, 3));
			$r_tel2 = trim(substr($row['r_tel31'], 3, 4));
			$r_tel3 = trim(substr($row['r_tel31'], 7, 4));
			$r_tel = $r_tel1."-".$r_tel2."-".$r_tel3;
			
			$r_phone1 = trim(substr($row['r_phone31'], 0, 3));
			$r_phone2 = trim(substr($row['r_phone31'], 3, 4));
			$r_phone3 = trim(substr($row['r_phone31'], 7, 4));
			$r_phone = $r_phone1."-".$r_phone2."-".$r_phone3;

			if ($row['pay_method31'] == 0) {
				$showPay_method = "카드";
				$showPay_bank = "";
				switch ($row['card_kind31']) {
					case 1:
						$showCart_kind = "국민카드";
					break;
					case 2:
						$showCart_kind = "신한카드";
					break;
					case 3:
						$showCart_kind = "우리카드";
					break;
					case 4:
						$showCart_kind = "하나카드";
					break;
				}
			}
			else {
				$showPay_method = "무통장";
				if ($row['bank_kind31'] == 1)
					$showPay_bank = "국민은행:000-00-00000";
				else
					$showPay_bank = "신한은행:000-00-00000";
			}
		?>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $row['o_name31'] ?> (<?= $showMember ?>)</td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자전화</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $o_tel ?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자 E-Mail</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $row['o_email31'] ?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자핸드폰</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $o_phone ?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자주소</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE" colspan="3">(<?= $row['o_zip31'] ?>) <?= $row['o_juso31'] ?></td>
	</tr>
	</tr>
</table>
<img src="blank.gif" width="10" height="5"><br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $row['r_name31'] ?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자전화</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $r_tel ?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자 E-Mail</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $row['r_email31'] ?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자핸드폰</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $r_phone ?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자주소</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE" colspan="3">(<?= $row['r_zip31'] ?>) <?= $row['r_juso31'] ?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">메모</font></td>
        <td width="300" height="50" bgcolor="#EEEEEE" colspan="3"><?= $row['memo31'] ?></td>
	</tr>
</table>
<br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">지불종류</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $showPay_method ?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">카드승인번호 </font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $row['card_okno31'] ?>&nbsp</td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">카드 할부</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $row['card_halbu31'] ? $row['card_halbu31']." 개월" : "일시불" ?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">카드종류</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $showCart_kind ?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">무통장</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $showPay_bank ?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">입금자이름</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $row['bank_sender31'] ?></td>
	</tr>
</table>
<br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC"> 
    <td width="340" height="20" align="center"><font color="#142712">상품명</font></td>
		<td width="50"  height="20" align="center"><font color="#142712">수량</font></td>
		<td width="70"  height="20" align="center"><font color="#142712">단가</font></td>
		<td width="70"  height="20" align="center"><font color="#142712">금액</font></td>
		<td width="50"  height="20" align="center"><font color="#142712">할인</font></td>
		<td width="60"  height="20" align="center"><font color="#142712">옵션1</font></td>
		<td width="60"  height="20" align="center"><font color="#142712">옵션2</font></td>
	</tr>
	<?php
		for ($i = 0; $i < $row['product_nums31']; $i++) {
			$row2 = mysqli_fetch_array($result);
			$showPrice = number_format($row2['jumuns_price']);
			$showCash = number_format($row2['jumuns_cash']);

			echo("
				<tr bgcolor='#EEEEEE' height='20'>	
					<td width='340' height='20' align='left'>$row2[product_name]</td>	
					<td width='50'  height='20' align='center'>$row2[jumuns_num]</td>	
					<td width='70'  height='20' align='right'>$showPrice</td>	
					<td width='70'  height='20' align='right'>$showCash</td>	
					<td width='50'  height='20' align='center'>$row2[jumuns_discount] %</td>	
					<td width='60'  height='20' align='center'>$row2[opts1_name]</td>	
					<td width='60'  height='20' align='center'>$row2[opts2_name]</td>	
				</tr>
			");
		}

		if ($row['total_cash31'] < 100000) {
			echo("
				<tr bgcolor='#EEEEEE' height='20'>	
					<td width='340' height='20' align='left'>배송비</td>	
					<td width='50'  height='20' align='center'>1</td>	
					<td width='70'  height='20' align='right'>2,500</td>	
					<td width='70'  height='20' align='right'>2,500</td>	
					<td width='50'  height='20' align='center'></td>	
					<td width='60'  height='20' align='center'></td>	
					<td width='60'  height='20' align='center'></td>	
				</tr>
			");
		}
	?>
</table>
<img src="blank.gif" width="10" height="5"><br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
	  <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">총금액</font></td>
		<td width="700" height="20" bgcolor="#EEEEEE" align="right"><font color="#142712" size="3"><b><?= number_format($row['total_cash31']) ?></b></font> 원&nbsp;&nbsp</td>
	</tr>
</table>

<table width="800" border="0" cellspacing="0" cellpadding="7">
	<tr> 
		<td align="center">
			<input type="button" value="이 전 화 면" onClick="javascript:history.back();">&nbsp
			<input type="button" value="프린트" onClick="javascript:print();">
		</td>
	</tr>
</table>

</center>

<br>
</body>
</html>
