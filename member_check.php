<?
   include "common.php";

   $uid = $_REQUEST["uid"];
   $pwd = $_REQUEST["pwd"];

   $query = "select no31, name31 from member where uid31='$uid' and pwd31='$pwd';";

   $result = mysqli_query($db, $query);
   if (!$result) exit("에러: $query");

   $row = mysqli_fetch_array($result);

   $count = mysqli_num_rows($result);

   if ($count > 0) {
      setcookie("cookie_no", $row["no31"]);
      setcookie('cookie_name', $row["name31"]);
      echo("<script>location.href='index.html'</script>");
   } else {
      echo("<script>location.href='member_login.php'</script>");
   }
?>