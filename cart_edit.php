<?
	include "common.php";

	$cart = $_COOKIE['cart']; // 배열
	$n_cart = $_COOKIE['n_cart'];
	$no = $_REQUEST['no'];
	$num = $_REQUEST['num'];
	$opts1 = $_REQUEST['opts1'];
	$opts2 = $_REQUEST['opts2'];
	$kind = $_REQUEST['kind'];
	$pos = $_REQUEST['pos']; // 쿠키 배열 번호

	if (!$n_cart) $n_cart = 0;

	switch ($kind) {
		case "insert":
			$n_cart++;
			$cart[$n_cart] = implode("^", array($no, $num, $opts1, $opts2));
			setcookie("cart[$n_cart]", $cart[$n_cart]);
			setcookie("n_cart", $n_cart);
			break;

		case "update":
			list($no, $num1, $opts1, $opts2) = explode("^", $cart[$pos]); // 기존 값 (num1)

			$cart[$pos] = implode("^", array($no, $num, $opts1, $opts2)); // 수정 값 (num2)
			setcookie("cart[$pos]", $cart[$pos]);
			break;

		case "order":
			$n_cart++;
			$cart[$n_cart] = implode("^", array($no, $num, $opts1, $opts2));
			setcookie("cart[$n_cart]", $cart[$n_cart]);
			setcookie("n_cart", $n_cart);
			echo("<script>location.href='order.php'</script>");
			break;

		case "linkOrder":
			echo("<script>location.href='order.php'</script>");
			break;

		case "delete":
			setcookie("cart[$pos]", null);
			break;

		case "deleteall":
			for ($i = 1; $i <= $n_cart; $i++) {
				setcookie("cart[$i]", null);
			}
			setcookie("n_cart", null);
			break;
	}

	echo("<script>location.href='cart.php'</script>");
?>