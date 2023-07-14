<?php
	include "../common.php";

	$no = $_REQUEST['no'];
	$state = $_REQUEST['state'];

	// $day1_y = $_REQUEST[day1_y];
	// $day1_m = $_REQUEST[day1_m];
	// $day1_d = $_REQUEST[day1_d];
	// $day2_y = $_REQUEST[day2_y];
	// $day2_m = $_REQUEST[day2_m];
	// $day2_d = $_REQUEST[day2_d];
	$sel1 = $_REQUEST['sel1']; // 주문상태 선택
	$sel2 = $_REQUEST['sel2']; // 주문번호, 고객명 .... 선택
	$text1 = $_REQUEST['text1'];

	$query = "update jumun set state31=$state where no31='$no';";
	$result = mysqli_query($db, $query);
	if(!$result) echo("에러: $query");

	echo("<script>location.href='jumun.php'</script>");
?>