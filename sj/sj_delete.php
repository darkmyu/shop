<?
    include "common.php";

    $no = $_REQUEST['no'];

    $query = "delete from sj where no31=$no;";

    $result = mysqli_query($db, $query);
    if (!$result) exit("에러: $query");

    echo("<script>location.href='sj_list.php'</script>");
?>