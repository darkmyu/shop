<?php
	include "common.php";

	$cookie_no = $_COOKIE['cookie_no'];

	$cart = $_COOKIE['cart']; // 배열
	$n_cart = $_COOKIE['n_cart'];

	$o_name = $_REQUEST['o_name'];
	$o_tel = $_REQUEST['o_tel'];
	$o_phone = $_REQUEST['o_phone'];
	$o_email = $_REQUEST['o_email'];
	$o_zip = $_REQUEST['o_zip'];
	$o_juso = $_REQUEST['o_juso'];
	$o_juso = $_REQUEST['o_juso'];

	$r_name = $_REQUEST['r_name'];
	$r_tel = $_REQUEST['r_tel'];
	$r_phone = $_REQUEST['r_phone'];
	$r_email = $_REQUEST['r_email'];
	$r_zip = $_REQUEST['r_zip'];
	$r_juso = $_REQUEST['r_juso'];

	$pay_method = $_REQUEST['pay_method'];
	$card_halbu = $_REQUEST['card_halbu'];
	$card_kind = $_REQUEST['card_kind'];
	$bank_kind = $_REQUEST['bank_kind'];
	$bank_sender = $_REQUEST['bank_sender'];
	$memo = $_REQUEST['memo'];

	$product_nums = 0; // 총 제품 수량
	$product_names = ""; // 주문 제품 첫번째 이름
	$product_totalPrice = 0;

	date_default_timezone_set('Asia/Seoul'); // 아시아/서울을 기준으로 타임존을 정함

	$query = "select no31 from jumun";
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	$count = mysqli_num_rows($result);

	// 주문 번호 처리
	$query = "select no31 from jumun where jumunday31=curdate() order by no31 desc limit 1";
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	$rowNo = mysqli_fetch_array($result);
	$count2 = mysqli_num_rows($result);

	if ($count2 > 0) {
		if ($count > 0) {
			$jumunNum = $rowNo['no31'] + 1;
		} else {
			$jumunNum = date("ymd", time())."0001";
		}
	} else {
		$jumunNum = date("ymd", time())."0001";
	}


	for ($i = 1; $i <= $n_cart; $i++) {
		if ($cart[$i]) {
			list($no, $num, $opts1, $opts2) = explode("^", $cart[$i]);

			// 상품 정보
			$query = "select * from product where no31=$no";
			$result = mysqli_query($db, $query);
			if (!$result) exit("에러: $query");
			$row = mysqli_fetch_array($result);

			// 옵션1 정보
			$query = "select name31 from opts where no31=$opts1";
			$result = mysqli_query($db, $query);
			if (!$result) exit("에러: $query");
			$rowOpts1 = mysqli_fetch_array($result);

			// 옵션2 정보
			$query = "select name31 from opts where no31=$opts2";
			$result = mysqli_query($db, $query);
			if (!$result) exit("에러: $query");
			$rowOpts2 = mysqli_fetch_array($result);

			if ($row['icon_sale31'] == 0) { // 세일이 없는 경우
				$price = $row['price31'];
				$cash = $price * $num;
			} else { // 세일이 있는 경우
				$price = round($row['price31'] * (100 - $row['discount31'])/100, -3);
				$cash = $price * $num;
			}

			$query = "insert into jumuns (jumun_no31, product_no31, num31, price31, cash31, discount31, opts_no1, opts_no2) values ('$jumunNum', $no, $num, $price, $cash, $row[discount31],
						$opts1, $opts2);";
			$result = mysqli_query($db, $query);
			if (!$result) exit("에러: $query");

			$product_nums = $product_nums + 1;
			if ($product_nums == 1)
				$product_names = $row['name31'];
			
			$product_totalPrice += $cash;
		}
	}

	// 배송비
	if ($product_totalPrice < 100000) {
		$query = "insert into jumuns (jumun_no31, product_no31, num31, price31, cash31, discount31, opts_no1, opts_no2) values ('$jumunNum', 0, 1, 2500, 2500, 0, 0, 0);";
		$result = mysqli_query($db, $query);
		if (!$result) exit("에러: $query");
		$product_totalPrice += 2500;
	}

	// 회원번호 처리
	if (!$cookie_no)
		$userNo = 0;
	else
		$userNo = $cookie_no;

	// 날짜 처리
	$jumunday = date("Y-m-d", time());

	// 상품명 표시 처리
	if ($product_nums > 1) {
		$tmp = $product_nums - 1;
		$product_names = $product_names." 외 ".$tmp;
	}

	$query = "insert into jumun (no31, member_no31, jumunday31, product_names31, product_nums31, o_name31, o_tel31, o_phone31, o_email31, o_zip31, o_juso31, r_name31, r_tel31, r_phone31,
				r_email31, r_zip31, r_juso31, memo31, pay_method31, card_okno31, card_halbu31, card_kind31, bank_kind31, bank_sender31, total_cash31, state31) values ('$jumunNum',
				$userNo, '$jumunday', '$product_names', $product_nums, '$o_name', '$o_tel', '$o_phone', '$o_email', '$o_zip', '$o_juso', '$r_name', '$r_tel', '$r_phone', '$r_email',
				'$r_zip', '$r_juso', '$memo', $pay_method, '$jumunNum', $card_halbu, $card_kind, '$bank_kind', '$bank_sender', $product_totalPrice, 1);";
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");

	$product_nums = 0;
	$product_names = "";
	$product_totalPrice = 0;

	for ($i = 1; $i <= $n_cart; $i++) {
		setcookie("cart[$i]", null);
	}
	setcookie("n_cart", null);

	echo("<script>location.href='order_ok.php'</script>");
?>