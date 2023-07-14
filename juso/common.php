<?
	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
   ini_set("display_errors", 1);
   
   $page_line=5;
   $page_block=5;
	
	$db = mysqli_connect("localhost", "shop31", "1234", "shop31");
	if (!$db) exit("DB연결에러");
?>