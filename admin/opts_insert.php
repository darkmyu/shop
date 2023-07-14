<?
   include "../common.php";

   $name = $_REQUEST['name'];
   $no1 = $_REQUEST['no1'];

   $query = "insert into opts (opt_no31, name31) values ('$no1', '$name');";

   $result = mysqli_query($db, $query);
   if (!$result) exit("에러: $query");

   echo("<script>location.href='opts.php?no1=$no1'</script>");
?>