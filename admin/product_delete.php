<?
    include "../common.php";

    $no = $_REQUEST['no']; // href_link

    $query = "select * from product where no31=$no";
    $result = mysqli_query($db, $query);
    if (!$result) exit("에러: $query");

    $row = mysqli_fetch_array($result);

    // 파일 삭제
    unlink("../product/img/$row[image1]");
    unlink("../product/img/$row[image2]");
    unlink("../product/img/$row[image3]");

    // 컬럼 삭제
    $query = "delete from product where no31=$no;";

    $result = mysqli_query($db, $query);
    if (!$result) exit("에러: $query");

    echo("<script>location.href='product.php'</script>");
?>