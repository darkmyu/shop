<?
   include "main_top.php"
?>

<?
   include "common.php";

   $menu = $_REQUEST['menu'];
   $sort = $_REQUEST['sort'];

   if ($sort == "up")
      $query = "select * from product where menu31=$menu and status31=1 order by price31 desc";
   else if ($sort == "down")
      $query = "select * from product where menu31=$menu and status31=1 order by price31";
   else if ($sort == "name")
      $query = "select * from product where menu31=$menu and status31=1 order by name31";
   else
      $query = "select * from product where menu31=$menu and status31=1 order by no31 desc";

   $result = mysqli_query($db, $query);
   if (!$result) exit("에러: $query");

   $count = mysqli_num_rows($result);

?>

      <!-- 하위 상품목록 -->

			<!-- form2 시작 -->
			<form name="form2" method="post" action="product.php?menu=<?= $menu ?>">
			<input type="hidden" name="menu" value="<?= $menu ?>">

			<table cellpadding="0" cellspacing="5" width="1500" class="cmfont" style="margin-top:8px;">
				<tr>
					<td bgcolor="white" align="center">
						<table border="0" cellpadding="0" cellspacing="0" width="751" class="cmfont">
							<tr>
								<td align="center" valign="middle">
									<table border="0" cellpadding="0" cellspacing="0" width="1500" height="40" class="cmfont">
										<tr>
											<td width="500" class="cmfont">
												<font color="#2D4BD6" class="cmfont"><b style="font-size: 16px;" align=''>> <?= $a_menu[$menu] ?> &nbsp</b></font>&nbsp
											</td>
											<td align="right" width="274">
												<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cmfont">
													<tr>
														<td align="right"><font color="EF3F25"><b><?= $count?></b></font> 개의 상품.&nbsp;&nbsp;&nbsp</td>
														<td width="100">
															<select name="sort" size="1" class="cmfont" onChange="form2.submit()">
                                                <?
                                                   for ($i = 0; $i < $n_sort; $i++) {
                                                      if ($sort == $a_valueSort[$i])
                                                         echo("<option value='$a_valueSort[$i]' selected> $a_sort[$i]");
                                                      else
                                                         echo("<option value='$a_valueSort[$i]'> $a_sort[$i]");
                                                   }
                                                ?>
																<!-- <option value="new" selected>신상품순 정렬</option>
																<option value="up">고가격순 정렬</option>
																<option value="down">저가격순 정렬</option>
																<option value="name">상품명 정렬</option> -->
															</select>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</form>
			<!-- form2 -->

				<!---1번째 줄-->
            <?
                     $num_col = 10; $num_row = 4;
                     $page_line = $num_col * $num_row;
                     $count = mysqli_num_rows($result); // 출력할 제품 개수
                     $icount = 0; // 출력한 제품 개수 카운터

                     $page = $_REQUEST['page'];
                     if (!$page) $page = 1;
                     $pages = ceil($count/$page_line);
                     $first = 1;
                     if ($count > 0) $first = $page_line * ($page - 1);
                     $page_last = $count - $first;
                     if ($page_last > $page_line) $page_last = $page_line;
                
                     if ($count > 0) mysqli_data_seek($result, $first);

                     echo("<table border='0' cellpadding='0' cellspacing='0' style='padding-left:50px; padding-top:10px'>");

                        for ($ir = 0; $ir < $num_row; $ir++) {
                           echo("<tr>");
                           for ($ic = 0; $ic < $num_col; $ic++) {
                              if ($icount < $page_last) {
                                 $row = mysqli_fetch_array($result);
                                 $price = number_format($row['price31']);
                                 $showPrice = "<tr><td height='20' align='center'><b>$price 원</b></td></tr>"; // 할인 X 일 경우 HTML

                                 echo("
                                    <td width='150' height='205' align='center' valign='top'>
                                       <table border='0' cellpadding='0' cellspacing='0' width='100' class='cmfont'>
                                          <tr> 
                                             <td align='center'> 
                                                <a href='product_detail.php?no=$row[no31]'><img src='product/img/$row[image1]' width='120' height='140' border='0'></a>
                                             </td>
                                          </tr>
                                          <tr><td height='5'></td></tr>
                                          <tr> 
                                             <td height='20' align='center'>
                                                <a href='product_detail.php?no=$row[no31]'><font color='444444'>$row[name31]</font></a>&nbsp; 
                                 ");

                                 if ($row['icon_new31'] == 1) 
                                    echo("<img src='images/i_new.gif' align='absmiddle' vspace='1'>");
                                 if ($row['icon_hit31'] == 1)
                                    echo("<img src='images/i_hit.gif' align='absmiddle' vspace='1'>");
                                 if ($row['icon_sale31'] == 1) {
                                    echo("<img src='images/i_sale.gif' align='absmiddle' vspace='1'><small style='color: red;'> $row[discount31]%</small>");
                                    $old_price = $price;
                                    $price = number_format(round($row['price31'] * (100 - $row['discount31'])/100, -3));
                                    $showPrice = "<tr><td height='20' align='center'><strike>$old_price 원</strike><br><b>$price 원</b></td></tr>"; // 할인 되었을 경우 HTML
                                 }

                                 echo("
                                             </td>
                                          </tr>
                                          $showPrice
                                       </table>
                                    </td>
                                 ");
                              } else {
                                 echo("<td></td>");
                              }

                              $icount++;
                           }
                           echo("</tr>");
                        }

                     echo("</table>");
                  ?>
<!-- 
			<table border="0" cellpadding="0" cellspacing="0" width="690">
				<tr>
					<td height="40" class="cmfont" align="center">
						<img src="images/i_prev.gif" align="absmiddle" border="0"> 
						<font color="#FC0504"><b>1</b></font>&nbsp;
						<a href="product.html?menu=1&sort=1&page=1"><font color="#7C7A77">[2]</font></a>&nbsp;
						<a href="product.html?menu=1&sort=1&page=1"><font color="#7C7A77">[3]</font></a>&nbsp;
						<img src="images/i_next.gif" align="absmiddle" border="0">
					</td>
				</tr>
         </table> -->

<?      
   echo("
      <table width='1500' border='0' cellspacing='0' cellpadding='0'>
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
         <a href='product.php?menu=$menu&page=$tmp'>
            <img src='images/i_prev.gif' align='absmiddle' border='0'>
         </a>&nbsp
       ");
    }

    for($i = $page_s + 1; $i <= $page_e; $i++) {
       if ($page == $i)
         echo("&nbsp;<font ed'> <b>$i</b> </font>&nbsp");
       else
         echo("&nbsp;<a href='product.php?menu=$menu&page=$i'>[$i]</a>&nbsp");
    }

    if ($block < $blocks) {
       $tmp = $page_e + 1;

       echo("
         <a href='product.php?menu=$menu&page=$tmp'>
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



<?
   include "main_bottom.php";
?>