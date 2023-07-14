<?
    include "common.php";

	$no = $_REQUEST['no'];
    $name = $_REQUEST['name'];
    $kor = $_REQUEST['kor'];
    $eng = $_REQUEST['eng'];
    $mat = $_REQUEST['mat'];
    $hap = $_REQUEST['hap'];
    $avg = $_REQUEST['avg'];

    $query = "update sj set
				name31='$name',
				kor31=$kor,
				eng31=$eng,
				mat31=$mat,
				hap31=$hap,
				avg31=$avg where no31=$no";

    $result = mysqli_query($db, $query);
    if (!$result) exit("에러: $query");

    echo("<script>location.href='sj_list.php'</script>");
?>