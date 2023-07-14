<?
	$irum1=$_POST['irum1'];
	$irum2=$_GET['irum2'];
	if ($irum2 == null) {
		$irum2 = "default";
	}
?>

<html>
<head>
	<title>test 결과</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body>
	받은 irum1은 <font color=blue><?=$irum1?></font>
	<br></br>
	받은 irum2는 <font color=blue><? echo("$irum2"); ?></font>
	<br></br>
	<a href="javascript:history.back();">돌아가기</a>
</body>
</html>