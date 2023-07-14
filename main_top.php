<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	

<?
	$cookie_no = $_COOKIE["cookie_no"];
	$cookie_name = $_COOKIE["cookie_name"];

   $phpself=$_SERVER["PHP_SELF"];

?>

<html>
<head>
<title>나래</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link href="include/font.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<script language="Javascript" src="include/common.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>

<body style="margin:0">
<center>

<table width="1500" border="0" cellspacing="0" cellpadding="0" align="center">
<!-- 959 -->
	<tr> 
		<td>
			<!--  상단 왼쪽 로고  -------------------------------------------->
			<table border="0" cellspacing="0" cellpadding="0" width="182">
				<tr>
					<td><a href="main.php"><img src="images/top_logo.gif" width="182" height="30" border="0"></a></td>
					<!-- 182 -->
				</tr>
			</table>
		</td>
		<td align="right" valign="bottom">
			<!--  상단메뉴 Home/로그인/회원가입/장바구니/주문배송조회/즐겨찾기추가  ---->	
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td><a href="main.php"><img src="images/top_menu01.gif" border="0"></a></td>
               <td><img src="images/top_menu_line.gif" width="11"></td>
               <?
                  if (!$cookie_no) {
                     echo("
                        <td><a href='member_login.php'><img src='images/top_menu02.gif' border='0'></a></td>
                        <td><img src='images/top_menu_line.gif' width='11'></td>
                        <td><a href='member_agree.php'><img src='images/top_menu03.gif' border='0'></a></td>
                     ");
                  } else {
                     echo("
                        <td><a href='member_logout.php'><img src='images/top_menu02_1.gif' border='0'></a></td>
                        <td><img src='images/top_menu_line.gif' width='11'></td>
                        <td><a href='member_edit.php'><img src='images/top_menu03_1.gif' border='0'></a></td>
                     ");
                  }
               ?>
               
					<td><img src="images/top_menu_line.gif" width="11"></td>
					<td><a href="cart.php"><img src="images/top_menu05.gif" border="0"></a></td>
					<td><img src="images/top_menu_line.gif" width="11"></td>
					<td><a href="jumun_login.html"><img src="images/top_menu06.gif" border="0"></a></td>
					<td><img src="images/top_menu_line.gif"width="11"></td>
					<td><img src="images/top_menu08.gif" onclick="javascript:Add_Site();" style="cursor:hand"></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<!--  메인 이미지 --------------------------------------------------->
<table width="1500" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td><a href="main.php"><img src="images/main_image0.jpg" width="1500" height="150" border="0"></a></td>
	</tr>
</table>


<table width="959" height="25" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td align="center" bgcolor="#F7F7F7">
			<table border="0" cellspacing="0" cellpadding="0">
					<td><a href="product.php?menu=1"><img src="images/main_menu01_off.gif" height="30" border="0"  onmouseover="img_change('on')" onmouseout="img_change('off')"></a></td>
					<td><a href="product.php?menu=2"><img src="images/main_menu02_off.gif" height="30" border="0"  onmouseover="img_change('on')" onmouseout="img_change('off')"></a></td>
					<td><a href="product.php?menu=3"><img src="images/main_menu03_off.gif" height="30" border="0"  onmouseover="img_change('on')" onmouseout="img_change('off')"></a></td>
					<td><a href="product.php?menu=4"><img src="images/main_menu04_off.gif" height="30" border="0"  onmouseover="img_change('on')" onmouseout="img_change('off')"></a></td>
					<td><a href="product.php?menu=5"><img src="images/main_menu05_off.gif" height="30" border="0"  onmouseover="img_change('on')" onmouseout="img_change('off')"></a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<!-- 상품 검색 ------------------------------------->
<table width="1500" height="25" border="0" cellspacing="0" cellpadding="0" align="center">
	<!-- <tr><td height="1" colspan="5" bgcolor="black"></td></tr> -->
	<!-- 2c3e50 -->
	<tr bgcolor="#2c3e50">
		<td width="181" align="center"><font color="white"><b>
		<?
            if (!$cookie_no) {
               echo("고객님,");
            } else {
               echo($cookie_name." 님,");
            }
         ?>
		&nbsp 어서오세요! &nbsp;&nbsp 
      </b></font></td>
		<td style="font-size:9pt;color:#666666;font-family:돋움;padding-left:5px;"></td>
		<td align="right" style="font-size:9pt;color:white;font-family:돋움;"><b>상품검색 ▶&nbsp</b></td>
		<!-- form1 시작 -->
		<form name="form1" method="post" action="product_search.html">
		<td width="135">
			<input type="text" name="findtext" maxlength="40" size="17" class="cmfont1">
		</td>
		</form>
		<!-- form1 끝 -->
		<td width="65" align="center"><a href="javascript:Search()"><img src="images/i_search1.gif" border="0"></a></td>
	</tr>
	<tr><td height="1" colspan="5" bgcolor="#E5E5E5"></td></tr>
</table>

<?php
	if ($phpself !== "/member_edit.php" && $phpself !== "/product.php" && $phpself !== "/member_login.php" && $phpself !== "/member_agree.php"
	&& $phpself !== "/cart.php" && $phpself !== "/member_join.php" && $phpself !== "/order.php" && $phpself !== "/order_pay.php" &&
	$phpself !== "/product_detail.php" && $phpself !== "/order_ok.php") {
		echo("
			<div id='carousel-example-generic' class='carousel slide ' data-ride='carousel' style='margin-top:5px'>
				<ol class='carousel-indicators'>
					<li data-target='#carousel-example-generic' data-slide-to='0' class='active'></li>
					<li data-target='#carousel-example-generic' data-slide-to='1'></li>
					<li data-target='#carousel-example-generic' data-slide-to='2'></li>
					<li data-target='#carousel-example-generic' data-slide-to='3'></li>
		  		</ol>

				<div class='carousel-inner' role='listbox'>
					<div class='item active'>
						<div class='items-center'>
							<a href='http://gamejigix.induk.ac.kr/~shop31/product_detail.php?no=37'><img src='images/home_img.jpg' alt='...'></a>
						</div>
					</div>
					<div class='item'>
						<div class='items-center'>
							<a href='http://gamejigix.induk.ac.kr/~shop31/product_detail.php?no=44'><img src='images/home_img01.jpg' alt='...'></a>
						</div>
					</div>
					<div class='item'>
						<div class='items-center'>
							<img src='images/home_img02.jpg' alt='...'>
						</div>
					</div>
					<div class='item'>
						<div class='items-center'>
							<img src='images/home_img03.jpg' alt='...'>
						</div>
					</div>
				</div>
			</div>
		");
	}
?>

<table width="1500" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr><td height="10" colspan="2"></td></tr>
	<tr>
		<td height="100%" valign="top">
			<!--  화면 좌측메뉴 시작 (main_left) ------------------------------->
			<!-- <table width="181" border="0" cellspacing="0" cellpadding="0" style="margin-top:18px;">
				<tr> 
					<td valign="top">  -->
						<!--  Category 메뉴 : 세로인 경우 -------------------------------->
						<!-- <table width="177"  border="0" cellpadding="2" cellspacing="1" bgcolor="#afafaf">
							<tr><td height="3"  bgcolor="#bfbfbf"></td></tr>
							<tr><td height="30" bgcolor="#1f4068" align="center" style="font-size:12pt;color:white"><b>Category</b></td></tr>
							<tr>
								<td bgcolor="#FFFFFF">
									<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr><td><a href="product.php?menu=1"><img src="images/main_menu01_off.gif" width="176" height="30" border="0"  onmouseover="img_change('on')" onmouseout="img_change('off')"></a></td></tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF">
									<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr><td><a href="product.php?menu=2"><img src="images/main_menu02_off.gif" width="176" height="30" border="0"  onmouseover="img_change('on')" onmouseout="img_change('off')"></a></td></tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF">
									<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr><td><a href="product.php?menu=3"><img src="images/main_menu03_off.gif" width="176" height="30" border="0"  onmouseover="img_change('on')" onmouseout="img_change('off')"></a></td></tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF">
									<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr><td><a href="product.php?menu=4"><img src="images/main_menu04_off.gif" width="176" height="30" border="0"  onmouseover="img_change('on')" onmouseout="img_change('off')"></a></td></tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF">
									<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr><td><a href="product.php?menu=5"><img src="images/main_menu05_off.gif" width="176" height="30" border="0"  onmouseover="img_change('on')" onmouseout="img_change('off')"></a></td></tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td height="10"></td></tr>
				<tr> 
					<td>  -->
						<!--  Custom Service 메뉴(QA, FAQ...) -->
						<!-- <table width="177"  border="0" cellpadding="2" cellspacing="1" bgcolor="#afafaf">
							<tr><td height="3"  bgcolor="#a0a0a0"></td></tr>
							<tr><td height="25" bgcolor="#1f4068" align="center" style="font-size:11pt;color:white"><b>Customer Service</b></td></tr>
							<tr>
								<td bgcolor="#FFFFFF">
									<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr><td><a href="qa.html"><img src="images/main_left_qa.gif" border="0" width="176"></a></td></tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF">
									<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr><td><a href="faq.html"><img src="images/main_left_faq.gif" border="0" width="176"></a></td></tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF">
									<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr><td><a href=""><img src="images/main_left_etc.gif" border="0" width="176"></a></td></tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF">
									<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr><td><a href=""><img src="images/main_left_etc.gif" border="0" width="176"></a></td></tr>
									</table>
								</td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF">
									<table width="100%"  border="0" cellspacing="0" cellpadding="0">
										<tr><td><a href=""><img src="images/main_left_etc.gif" border="0" width="176"></a></td></tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table> -->
			<!--  화면 좌측메뉴 끝 (main_left) --------------------------------->
		</td>
		<td width="10"></td>
		<td valign="top">
