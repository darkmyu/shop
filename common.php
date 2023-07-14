<?
	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
   ini_set("display_errors", 1);
   
   $page_line=5;
   $page_block=5;

   $admin_id = "admin";
   $admin_pw = "1234";

   $a_idname = array("전체", "이름", "아이디");
   $n_idname = count($a_idname);

   // hi?
   $a_status = array("상품상태", "판매중", "판매중지", "품절");
   $n_status = count($a_status);

   $a_icon = array("아이콘", "New", "Hit", "Sale");
   $n_icon = count($a_icon);

   // menu list
   $a_menu = array("분류선택", "상의", "하의", "맨투맨/후드", "니트", "신발");
   $n_menu = count($a_menu);

   $a_text1 = array("", "제품이름", "제품코드");
   $n_text1 = count($a_text1);

   $a_sort = array("신상품순 정렬", "고가격순 정렬", "저가격순 정렬", "상품명 정렬");
   $n_sort = count($a_sort);

   $a_valueSort = array("new", "up", "down", "name");

   $a_state = array("전체", "주문신청", "주문확인", "입금확인", "배송중", "주문완료", "주문취소");
   $n_state = count($a_state);
	
	$db = mysqli_connect("localhost", "shop", "shop", "shop");
	if (!$db) exit("DB연결에러");
?>