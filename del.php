<?php
	// 테스트용 삭제 쿼리
	include "common.php";

	$query = "delete from jumun where no31=2006250001;";

	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");

	$query = "delete from jumuns where jumun_no31=2006250001;";

	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");

	$query = "delete from jumun where no31=2006250002;";

	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");

	$query = "delete from jumuns where jumun_no31=2006250002;";

	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");

	$query = "delete from jumun where no31=2006250003;";

	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");

	$query = "delete from jumuns where jumun_no31=2006250003;";

	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
?>