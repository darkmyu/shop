<?php
	include "main_top.php";
?>

<?
	include "common.php";

	$cookie_no = $_COOKIE['cookie_no'];
	$cart = $_COOKIE['cart'];
	$n_cart = $_COOKIE['n_cart'];

	// 주문자 정보 (로그인시)
	
	if ($cookie_no) {
		$query = "select * from member where no31=$cookie_no";
		$result = mysqli_query($db, $query);
		if (!$result) exit("에러: $query");

		$rowM = mysqli_fetch_array($result);
	}
?>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

			<!--  현재 페이지 자바스크립  -------------------------------------------->
			<script language="javascript">

			function Check_Value() {
				if (!form2.o_name.value) {
					alert("주문자 이름이 잘 못 되었습니다.");	form2.o_name.focus();	return;
				}
				if (!form2.o_tel1.value || !form2.o_tel2.value || !form2.o_tel3.value) {
					alert("전화번호가 잘 못 되었습니다.");	form2.o_tel1.focus();	return;
				}
				if (!form2.o_phone1.value || !form2.o_phone2.value || !form2.o_phone3.value) {
					alert("핸드폰이 잘 못 되었습니다.");	form2.o_phone1.focus();	return;
				}
				if (!form2.o_email.value) {
					alert("이메일이 잘 못 되었습니다.");	form2.o_email.focus();	return;
				}
				if (!form2.o_zip.value) {
					alert("우편번호가 잘 못 되었습니다.");	form2.o_zip.focus();	return;
				}
				if (!form2.o_juso.value) {
					alert("주소가 잘 못 되었습니다.");	form2.o_juso.focus();	return;
				}

				if (!form2.r_name.value) {
					alert("받으실 분의 이름이 잘 못 되었습니다.");	form2.r_name.focus();	return;
				}
				if (!form2.r_tel1.value || !form2.r_tel2.value || !form2.r_tel3.value) {
					alert("전화번호가 잘 못 되었습니다.");	form2.r_tel1.focus();	return;
				}
				if (!form2.r_phone1.value || !form2.r_phone2.value || !form2.r_phone3.value) {
					alert("핸드폰이 잘 못 되었습니다.");	form2.r_phone1.focus();	return;
				}
				if (!form2.r_email.value) {
					alert("이메일이 잘 못 되었습니다.");	form2.r_email.focus();	return;
				}
				if (!form2.r_zip.value) {
					alert("우편번호가 잘 못 되었습니다.");	form2.r_zip.focus();	return;
				}
				if (!form2.r_juso.value) {
					alert("주소가 잘 못 되었습니다.");	form2.r_juso.focus();	return;
				}

				form2.submit();
			}

			function FindZip(zip_kind) 
			{
				window.open("zipcode.php?zip_kind="+zip_kind, "", "scrollbars=no,width=500,height=250");
			}

			function SameCopy(str) {
				if (str == "Y") {
					form2.r_name.value = form2.o_name.value;
					form2.r_zip.value = form2.o_zip.value;
					form2.r_juso.value = form2.o_juso.value;
					form2.r_tel1.value = form2.o_tel1.value;
					form2.r_tel2.value = form2.o_tel2.value;
					form2.r_tel3.value = form2.o_tel3.value;
					form2.r_phone1.value = form2.o_phone1.value;
					form2.r_phone2.value = form2.o_phone2.value;
					form2.r_phone3.value = form2.o_phone3.value;
					form2.r_email.value = form2.o_email.value;
				}
				else {
					form2.r_name.value = "";
					form2.r_zip.value = "";
					form2.r_juso.value = "";
					form2.r_tel1.value = "";
					form2.r_tel2.value = "";
					form2.r_tel3.value = "";
					form2.r_phone1.value = "";
					form2.r_phone2.value = "";
					form2.r_phone3.value = "";
					form2.r_email.value = "";
				}
			}

			</script>

			<table border="0" cellpadding="0" cellspacing="0" width="1500">
				<tr><td height="13"></td></tr>
				<tr>
					<td height="30" align="left"><img src="images/jumun_title.gif" width="746" height="30" border="0"></td>
				</tr>
				<tr><td height="13"></td></tr>
			</table>

			<table border="0" cellpadding="0" cellspacing="0" width="1500">
				<tr>
					<td><img src="images/order_title1.gif" width="65" height="15" border="0"></td>
				</tr>
				<tr><td height="10"></td></tr>
			</table>

			<table border="0" cellpadding="5" cellspacing="1" width="1500" class="cmfont" bgcolor="#CCCCCC">
				<tr bgcolor="F0F0F0" height="23" class="cmfont">
					<td width="440" align="center">상품</td>
					<td width="70"  align="center">수량</td>
					<td width="100" align="center">가격</td>
					<td width="100" align="center">합계</td>
				</tr>
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
							$num&nbsp<font color='#464646'>개</font>
						</td>
						<td align='center' bgcolor='#FFFFFF'><font color='#464646'>$showPrice</font></td>
						<td align='center' bgcolor='#FFFFFF'><font color='#464646'>$totalPrice 원</font></td>
					</tr>
					");

					$total = $total + str_replace(",", "", $totalPrice); // 금액 누적
				}
			}
		?>
				<tr>
					<td colspan="5" bgcolor="#F0F0F0">
						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cmfont">
							<tr>
								<td bgcolor="#F0F0F0"><img src="images/cart_image1.gif" border="0"></td>
								<td align="right" bgcolor="#F0F0F0" style="padding-right:10">
									<?
										if ($total < 100000)
											$showSale = "2500원";
										else
											$showSale = "없음";
									?>
								<font color="#0066CC"><b>총 합계금액</font></b> : 상품대금(<?= number_format($total) ?>원) + 배송료(<? echo($showSale); ?>) = <font color="#FF3333"><b>
									<?
										if ($total < 100000)
											echo(number_format($total + 2500));
										else
											echo(number_format($total));
									?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<br><br>

			<!-- 주문자 정보 -->
			<table width="1500" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr height="3" bgcolor="#CCCCCC"><td></td></tr>
			</table>

			<!-- form2 시작  -->
			<form name="form2" method="post" action="order_pay.php">
			<table width="1500" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr>
					<td align="center" valign="top" width="150" STYLE="padding-top:65">
						<font size="2" color="#B90319"><b>주문자 정보</b></font>
					</td>
					<td align="center" width="560">

						<table width="560" border="0" cellpadding="0" cellspacing="0" class="cmfont" style="padding-top:10;">
							<?php
								if ($cookie_no) {
									// 이름
									$showName = "
										<input type='hidden' name='o_no' value='$cookie_no'>
										<input type='text' name='o_name' size='20' maxlength='10' value='$rowM[name31]' calss='cmfont1'>
									";

									// 전화번호
									$tel1 = trim(substr($rowM['tel31'], 0, 3));
									$tel2 = trim(substr($rowM['tel31'], 3, 4));
									$tel3 = trim(substr($rowM['tel31'], 7, 4));
									$showTel = "
										<input type='text' name='o_tel1' size='4' maxlength='4' value='$tel1' class='cmfont1'> -
										<input type='text' name='o_tel2' size='4' maxlength='4' value='$tel2' class='cmfont1'> -
										<input type='text' name='o_tel3' size='4' maxlength='4' value='$tel3' class='cmfont1'>
									";

									// 휴대폰번호
									$phone1 = trim(substr($rowM['phone31'], 0, 3));
									$phone2 = trim(substr($rowM['phone31'], 3, 4));
									$phone3 = trim(substr($rowM['phone31'], 7, 4));
									$showPhone = "
										<input type='text' name='o_phone1' size='4' maxlength='4' value='$phone1' class='cmfont1'> -
										<input type='text' name='o_phone2' size='4' maxlength='4' value='$phone2' class='cmfont1'> -
										<input type='text' name='o_phone3' size='4' maxlength='4' value='$phone3' class='cmfont1'>
									";

									// 이메일
									$showEmail = "
										<input type='text' name='o_email' size='50' maxlength='50' value='$rowM[email31]' class='cmfont1'>
									";

									// 주소
									$showJuso = "
										<input type='text' name='o_zip' size='5' maxlength='5' value='$rowM[zip31]' class='cmfont1'> 
										<a href='javascript:FindZip(1)'><img src='images/b_zip.gif' align='absmiddle' border='0'></a> <br>
										<input type='text' name='o_juso' size='55' maxlength='200' value='$rowM[juso31]' class='cmfont1'><br>
									";
								} else {
									// 이름
									$showName = "
										<input type='hidden' name='o_no' value=''>
										<input type='text' name='o_name' size='20' maxlength='10' value='' calss='cmfont1'>
									";

									// 전화번호
									$showTel = "
										<input type='text' name='o_tel1' size='4' maxlength='4' value='' class='cmfont1'> -
										<input type='text' name='o_tel2' size='4' maxlength='4' value='' class='cmfont1'> -
										<input type='text' name='o_tel3' size='4' maxlength='4' value='' class='cmfont1'>
									";

									// 휴대폰번호
									$showPhone = "
										<input type='text' name='o_phone1' size='4' maxlength='4' value='' class='cmfont1'> -
										<input type='text' name='o_phone2' size='4' maxlength='4' value='' class='cmfont1'> -
										<input type='text' name='o_phone3' size='4' maxlength='4' value='' class='cmfont1'>
									";

									// 이메일
									$showEmail = "
										<input type='text' name='o_email' size='50' maxlength='50' value='' class='cmfont1'>
									";

									// 주소
									$showJuso = "
										<input type='text' name='o_zip' size='5' maxlength='5' value='' class='cmfont1'> 
										<a href='javascript:FindZip(1)'><img src='images/b_zip.gif' align='absmiddle' border='0'></a> <br>
										<input type='text' name='o_juso' size='55' maxlength='200' value='' class='cmfont1'><br>
									";
								}
							?>
							<tr height="25">
								<td width="150"><b>주문자 성명</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<?= $showName ?>
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>전화번호</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<?= $showTel ?>
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>휴대폰번호</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<?= $showPhone ?>
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>E-Mail</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<?= $showEmail ?>
								</td>
							</tr>
							<tr height="50">
								<td width="150"><b>주소</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<?= $showJuso ?>
								</td>
							</tr>
						</table>

					</td>
				</tr>
				<tr height="10"><td></td></tr>
			</table>

			<!-- 배송지 정보 -->
			<table width="1500" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr height="3" bgcolor="#CCCCCC"><td></td></tr>
				<tr height="10"><td></td></tr>
			</table>

			<table width="1500" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr>
					<td align="center" valign="top" width="150" STYLE="padding-top:95"><font size=2 color="#B90319"><b>배송지 정보</b></font></td>
					<td align="center" width="560">

						<table width="560" border="0" cellpadding="0" cellspacing="0" class="cmfont">
							<tr height="25">
								<td width="150"><b>주문자정보와 동일</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="radio" name="same" onclick="SameCopy('Y')">예 &nbsp;
									<input type="radio" name="same" onclick="SameCopy('N')">아니오
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>받으실 분 성명</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_name" size="20" maxlength="10" value="" class="cmfont1">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>전화번호</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_tel1" size="4" maxlength="4" value="" class="cmfont1"> -
									<input type="text" name="r_tel2" size="4" maxlength="4" value="" class="cmfont1"> -
									<input type="text" name="r_tel3" size="4" maxlength="4" value="" class="cmfont1">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>휴대폰번호</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_phone1" size="4" maxlength="4" value="" class="cmfont1"> -
									<input type="text" name="r_phone2" size="4" maxlength="4" value="" class="cmfont1"> -
									<input type="text" name="r_phone3" size="4" maxlength="4" value="" class="cmfont1">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>E-Mail</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_email" size="50" maxlength="50" value="" class="cmfont1">
								</td>
							</tr>
							<tr height="50">
								<td width="150"><b>주소</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_zip" size="5" maxlength="5" value="" class="cmfont1"> 
									<a href="javascript:FindZip(2)"><img src="images/b_zip.gif" align="absmiddle" border="0"></a> <br>
									<input type="text" name="r_juso" size="55" maxlength="200" value="" class="cmfont1"><br>
								</td>
							</tr>
							<tr height="50">
								<td width="150"><b>배송시요구사항</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<textarea name="memo" cols="60" rows="3" class="cmfont1"></textarea>
								</td>
							</tr>
						</table>

					</td>
				</tr>
				<tr height="10"><td></td></tr>
			</table>

			<table width="1500" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr height="3" bgcolor="#CCCCCC"><td></td></tr>
				<tr height="10"><td></td></tr>
			</table>

			</form>

			<table width="1500" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr>
					<td align="right">
						<img src="images/b_order4.gif" onclick="Check_Value()" style="cursor:hand">

						<!-- 이 바튼은 단지 다음문서로 가는 테스트용 버튼임. 삭제할 것  -->
						<!-- &nbsp;&nbsp <input type="button" value="다음 문서로(테스트용)" onclick="form2.submit();"> -->

					</td>
				</tr>
				<tr height="20"><td></td></tr>
			</table>

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	

<?php
	include "main_bottom.php";
?>