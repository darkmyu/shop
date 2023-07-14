<?
	include "main_top.php";
?>

<!--  현재 페이지 자바스크립  -------------------------------------------->
<?
	include "common.php";

	$cart = $_COOKIE['cart'];
	$n_cart = $_COOKIE['n_cart'];
?>

<script language = "javascript">

function cart_edit(kind, pos) { // pos 는 쿠키배열 번호
	if (kind=="deleteall") 
	{
		location.href = "cart_edit.php?kind=deleteall";
	} 
	else if (kind=="delete") {
		location.href = "cart_edit.php?kind=delete&pos="+pos;
	} 
	else if (kind == "insert") {
		var num = eval("form2.num"+pos).value;
		location.href = "cart_edit.php?kind=insert&pos="+pos+"&num="+num;
	}
	else if (kind=="update") {
		var num=eval("form2.num"+pos).value;
		location.href = "cart_edit.php?kind=update&pos="+pos+"&num="+num;
	}
}

</script>

<!-- form2 시작  -->
<table border="0" cellpadding="0" cellspacing="0" width="747">
	<tr><td height="13"></td></tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="1500">
	<tr>
		<td height="30" align="left"><img src="images/cart_title.gif" width="746" height="30" border="0"></td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="747">
	<tr><td height="13"></td></tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" width="710" class="cmfont">
	<tr>
		<td><img src="images/cart_title1.gif" border="0"></td>
	</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" width="710">
	<tr><td height="10"></td></tr>
</table>

<table border="0" cellpadding="5" cellspacing="1" width="1500" class="cmfont" bgcolor="#CCCCCC">
	<tr bgcolor="F0F0F0" height="23" class="cmfont">
		<td width="420" align="center">상품</td>
		<td width="70"  align="center">수량</td>
		<td width="80"  align="center">가격</td>
		<td width="90"  align="center">합계</td>
		<td width="50"  align="center">삭제</td>
	</tr>

	<form name="form2" method="post">
		<input type="hidden" name="num">
		<?
			for ($i = 1; $i <= $n_cart; $i++) {
				if ($cart[$i]) {
					list($no, $num, $opts1, $opts2) = explode("^", $cart[$i]);

					$query = "select * from product where no31=$no";
					$result = mysqli_query($db, $query);
					if (!$result) exit("에러: $query");

					$row = mysqli_fetch_array($result);

					$query = "select * from opts where no31=$opts1";
					$result = mysqli_query($db, $query);
					if (!$result) exit("에러: $query");

					$row2 = mysqli_fetch_array($result);

					$query = "select * from opts where no31=$opts2";
					$result = mysqli_query($db, $query);
					if (!$result) exit("에러: $query");

					$row3 = mysqli_fetch_array($result);

					$price = number_format($row['price31']);

					if ($row['icon_sale31'] == 1) {
						$old_price = $price;
						$price = number_format(round($row['price31'] * (100 - $row['discount31'])/100, -3));
						$showPrice = "<strike>$old_price 원</strike><br><b>$price 원</b>"; // 할인 되었을 경우 HTML
					} else {
						$showPrice = "<b>$price 원</b>"; // 할인 X 일 경우 HTML
					}

					$totalPrice = number_format(str_replace(",", "", $price) * $num);

					echo("
						<tr>
							<td height='60' align='center' bgcolor='#FFFFFF'>
							<table cellpadding='0' cellspacing='0' width='100%'>
								<tr>
									<td width='60'>
										<a href='product_detail.php?no=$no'><img src='product/img/$row[image1]' width='50' height='50' border='0'></a>
									</td>
									<td class='cmfont'>
										<a href='product_detail.php?no=$no'>$row[name31]</a><br>
										<font color='#0066CC'>[옵션사항]</font> <b>색상:</b> $row2[name31] / <b>사이즈:</b> $row3[name31]
									</td>
								</tr>
							</table>
						</td>
						<td align='center' bgcolor='#FFFFFF'>
							<input type='text' name='num$i' size='3' value='$num' class='cmfont1'>&nbsp<font color='#464646'>개</font>
						</td>
						<td align='center' bgcolor='#FFFFFF'><font color='#464646'>$showPrice</font></td>
						<td align='center' bgcolor='#FFFFFF'><font color='#464646'>$totalPrice 원</font></td>
						<td align='center' bgcolor='#FFFFFF'>
							<a href = 'javascript:cart_edit(\"update\", \"$i\")'><img src='images/b_edit1.gif' border='0'></a>&nbsp<br>
							<a href = 'javascript:cart_edit(\"delete\", \"$i\")'><img src='images/b_delete1.gif' border='0'></a>&nbsp
						</td>
					</tr>
					");

					$total = $total + str_replace(",", "", $totalPrice); // 금액 누적
				}
			}
		?>

		<!-- <td height="60" align="center" bgcolor="#FFFFFF">
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="60">
						<a href="product_detail.html?no=0000"><img src="product/0000_s.jpg" width="50" height="50" border="0"></a>
					</td>
					<td class="cmfont">
						<a href="product_detail.html?no=0000">제품명</a><br>
						<font color="#0066CC">[옵션사항]</font> 옵션1
					</td>
				</tr>
			</table>
		</td>
		<td align="center" bgcolor="#FFFFFF">
			<input type="text" name="num1" size="3" value="1" class="cmfont1">&nbsp<font color="#464646">개</font>
		</td>
		<td align="center" bgcolor="#FFFFFF"><font color="#464646">70,200</font></td>
		<td align="center" bgcolor="#FFFFFF"><font color="#464646">70,200</font></td>
		<td align="center" bgcolor="#FFFFFF">
			<a href = "javascript:cart_edit('update','1')"><img src="images/b_edit1.gif" border="0"></a>&nbsp<br>
			<a href = "javascript:cart_edit('delete','1')"><img src="images/b_delete1.gif" border="0"></a>&nbsp
		</td> -->
	<tr>
		<td colspan="5" bgcolor="#F0F0F0">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr>
					<td bgcolor="#F0F0F0"><img src="images/cart_image1.gif" border="0"></td>
					<td align="right" bgcolor="#F0F0F0">
						<?
							if ($total < 100000)
								$showSale = "2500원";
							else
								$showSale = "없음";
						?>
						<font color="#0066CC"><b>총 합계금액</font></b> : 상품대금(<?= number_format($total ?? 0) ?>원) + 배송료(<? echo($showSale); ?>) = <font color="#FF3333"><b>
							<?
								if ($total < 100000)
									echo(number_format($total + 2500));
								else
									echo(number_format($total));
							?>
						</b></font>&nbsp;&nbsp
					</td>
				</tr>	
			</table>
		</td>
	</tr>
</table>
</form>
<!-- form2 끝  -->
<table width="1500" border="0" cellpadding="0" cellspacing="0" class="cmfont">
	<tr height="44">
		<td width="710" align="right" valign="middle">
			<a href="index.html"><img src="images/b_shopping.gif" border="0"></a>&nbsp;&nbsp;
			<a href="javascript:cart_edit('deleteall', '0')"><img src="images/b_cartalldel.gif" width="103" height="26" border="0"></a>&nbsp;&nbsp;
			<a href="cart_edit.php?kind=linkOrder"><img src="images/b_order1.gif" border="0"></a>
		</td>
	</tr>
</table>


<?
	include "main_bottom.php";
?>