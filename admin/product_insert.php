<?
   include "../common.php";

   $menu = $_REQUEST['menu'];
   $code = $_REQUEST['code'];
   $name = $_REQUEST['name'];
   $coname = $_REQUEST['coname'];
   $price = $_REQUEST['price'];
   $opt1 = $_REQUEST['opt1'];
   $opt2 = $_REQUEST['opt2'];
   $contents = $_REQUEST['contents'];
   $status = $_REQUEST['status'];

   $icon_new = $_REQUEST['icon_new']; // F
   $icon_hit = $_REQUEST['icon_hit']; // F
   $icon_sale = $_REQUEST['icon_sale']; // F
   $discount = $_REQUEST['discount'];

   $regday1 = $_REQUEST['regday1']; // F
   $regday2 = $_REQUEST['regday2']; // F
   $regday3 = $_REQUEST['regday3']; // F

   $image1 = $_FILES["image1"]["name"]; // F
   $image2 = $_FILES["image2"]["name"]; // F
   $image3 = $_FILES["image3"]["name"]; // F

   // contents_result
   $contents = addslashes($contents); // stripslashes 풀기

   // name_result
   $name = addslashes($name);

   // regday_result
   $regday = sprintf("%04d-%02d-%02d", $regday1, $regday2, $regday3);

   // icon_value_check
   if (!$icon_new)
      $icon_new = 0;
   if (!$icon_hit)
      $icon_hit = 0;
   if (!$icon_sale)
      $icon_sale = 0;

   $query = "select * from opt";
   $result = mysqli_query($db, $query);
   if (!$result) exit("에러: $query");

   $count = mysqli_num_rows($result);

   for ($i = 0; $i < $count; $i++) {
      $row = mysqli_fetch_array($result);

      if ($row['name31'] == $opt1) {
         $opt1 = $row['no31'];
      }
      
      if ($row['name31'] == $opt2) {
         $opt2 = $row['no31'];
      }
   }

   $query = "
      insert into product (menu31, code31, name31, coname31, price31, opt1, opt2, content31, status31, regday31, icon_new31, icon_hit31, icon_sale31, discount31, image1, image2, image3) values (
         $menu, '$code', '$name', '$coname', $price, $opt1, $opt2, '$contents', $status, '$regday', $icon_new, $icon_hit, $icon_sale, $discount, '$image1', '$image2', '$image3');";

   $result = mysqli_query($db, $query);
   if (!$result) exit("에러: $query");

   // 마지막 번호. (=현재 생성된 컬럼)
   $last_num = mysqli_insert_id($db);

   if ($image1)
      $newfname1 = $last_num."_".$image1;
   if ($image2)
      $newfname2 = $last_num."_".$image2;
   if ($image3)
      $newfname3 = $last_num."_".$image3;

   move_uploaded_file($_FILES["image1"]["tmp_name"], "../product/img/".$newfname1);
   move_uploaded_file($_FILES["image2"]["tmp_name"], "../product/img/".$newfname2);
   move_uploaded_file($_FILES["image3"]["tmp_name"], "../product/img/".$newfname3);

   // 이미지 파일이름 업데이트
   $query = "update product set
      image1='$newfname1', image2='$newfname2', image3='$newfname3' where no31=$last_num";

   $result = mysqli_query($db, $query);
   if (!$result) exit("에러: $query");
   
   echo("<script>location.href='product.php'</script>");
?>