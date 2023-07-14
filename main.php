<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	

<?
   include "main_top.php";
?>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	
<?
   include "common.php";

   $query = "select * from product where icon_new31=1 and status31=1 order by rand() limit 20";
   $query2 = "select * from product where icon_hit31=1 and status31=1 order by rand() limit 20";

   $result = mysqli_query($db, $query);
   if (!$result) exit("에러: $query");

   $result2 = mysqli_query($db, $query2);
   if (!$result2) exit("에러: $query2");
?>

			<!---- 화면 우측(신상품) 시작 -------------------------------------------------->	
			<table width="1308" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="60">
						<img src="images/main_newproduct.jpg" width="1308" height="40" style="margin-top:10px;">
               </tr>
            </td>
			</table>

				<!---1번째 줄-->
                  <?
                     $num_col = 10; $num_row = 3;
                     $count = mysqli_num_rows($result); // 출력할 제품 개수
                     $icount = 0; // 출력한 제품 개수 카운터

                     echo("<table border='0' cellpadding='0' cellspacing='0' style='padding-left:50px; padding-top:20px;' align='center'>");

                        for ($ir = 0; $ir < $num_row; $ir++) {
                           echo("<tr>");
                           for ($ic = 0; $ic < $num_col; $ic++) {
                              if ($icount < $count) {
                                 $row = mysqli_fetch_array($result);
                                 $price = number_format($row["price31"]);
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

                                 if ($row["icon_new31"] == 1) 
                                    echo("<img src='images/i_new.gif' align='absmiddle' vspace='1'>");
                                 if ($row["icon_hit31"] == 1)
                                    echo("<img src='images/i_hit.gif' align='absmiddle' vspace='1'>");
                                 if ($row["icon_sale31"] == 1) {
                                    echo("<img src='images/i_sale.gif' align='absmiddle' vspace='1'><small style='color: red;'> $row[discount31]%</small>");
                                    $old_price = $price;
                                    $price = number_format(round($row["price31"] * (100 - $row["discount31"])/100, -3));
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

				  	<!---2번째 줄-->
					<img src="images/main_hitproduct.jpg" width="1308" height="40" style="margin-top:10px;">
					<?
                     $num_col = 10; $num_row = 3;
                     $count = mysqli_num_rows($result2); // 출력할 제품 개수
                     $icount = 0; // 출력한 제품 개수 카운터

                     echo("<table border='0' cellpadding='0' cellspacing='0' style='padding-left:50px; padding-top:20px;' align='center'>");

                        for ($ir = 0; $ir < $num_row; $ir++) {
                           echo("<tr>");
                           for ($ic = 0; $ic < $num_col; $ic++) {
                              if ($icount < $count) {
                                 $row = mysqli_fetch_array($result2);
                                 $price = number_format($row["price31"]);
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

                                 if ($row["icon_new31"] == 1) 
                                    echo("<img src='images/i_new.gif' align='absmiddle' vspace='1'>");
                                 if ($row["icon_hit31"] == 1)
                                    echo("<img src='images/i_hit.gif' align='absmiddle' vspace='1'>");
                                 if ($row["icon_sale31"] == 1) {
                                    echo("<img src='images/i_sale.gif' align='absmiddle' vspace='1'><small style='color: red;'> $row[discount31]%</small>");
                                    $old_price = $price;
                                    $price = number_format(round($row["price31"] * (100 - $row["discount31"])/100, -3));
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

               <!-- <td>
						<table border="0" cellpadding="0" cellspacing="0" width="100" class="cmfont">
							<tr> 
								<td align="center"> 
									<a href="product_detail.html?no=109469"><img src="product/0000_s.jpg" width="120" height="140" border="0"></a>
								</td>
							</tr>
							<tr><td height="5"></td></tr>
							<tr> 
								<td height="20" align="center">
									<a href="product_detail.html?no=1"><font color="444444">상품명1</font></a>&nbsp; 
									<img src="images/i_hit.gif" align="absmiddle" vspace="1"> <img src="images/i_new.gif" align="absmiddle" vspace="1"> 
								</td>
							</tr>
							<tr><td height="20" align="center"><b>89,000 원</b></td></tr>
						</table>
					</td> -->

			<!---- 화면 우측(신상품) 끝 -------------------------------------------------->	

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	

<?
   include "main_bottom.php";
?>