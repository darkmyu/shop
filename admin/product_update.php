<?
   include "../common.php";

   // 업데이트 되고 원래 페이지네이션 한 곳으로
   $sel1 = $_REQUEST['sel1'];
   $sel2 = $_REQUEST['sel2'];
   $sel3 = $_REQUEST['sel3'];
   $sel4 = $_REQUEST['sel4'];
   $text1 = $_REQUEST['text1'];
   $page = $_REQUEST['page'];

   $no = $_REQUEST['no'];
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

   $imagename1 = $_REQUEST['imagename1']; // F
   $imagename2 = $_REQUEST['imagename2']; // F
   $imagename3 = $_REQUEST['imagename3']; // F

   $checkno1 = $_REQUEST['checkno1'];
   $checkno2 = $_REQUEST['checkno2'];
   $checkno3 = $_REQUEST['checkno3'];

   $newfname1 = "";
   $newfname2 = "";
   $newfname3 = "";

   // icon_value_check
   if (!$checkno1)
      $checkno1 = 0;
   if (!$checkno2)
      $checkno2 = 0;
   if (!$checkno3)
      $checkno3 = 0;

   // image_check_remove or add_upload
   if ($checkno1 == "1") { // 체크 된 경우
      unlink("../product/img/$imagename1"); // $newfname = "";
   } else {
      if ($image1) { // 이미지가 있는 경우 전 이미지를 삭제시키고 새로운 이미지를 업로드한다.
         if ($imagename1 != $imagename2 && $imagename1 != $imagename3)
            unlink("../product/img/$imagename1");
         $newfname1 = $no."_".$image1;
          move_uploaded_file($_FILES["image1"]["tmp_name"], "../product/img/".$newfname1);
      } else {
         $newfname1 = $imagename1; // 기본값 리턴
      }
   }

   if ($checkno2 == "1") {
      unlink("../product/img/$imagename2");
   } else {
      if ($image2) { // 이미지가 있는 경우 전 이미지를 삭제시키고 새로운 이미지를 업로드한다.
         if ($imagename2 != $imagename1 && $imagename2 != $imagename3)
            unlink("../product/img/$imagename2");
         $newfname2 = $no."_".$image2;
          move_uploaded_file($_FILES["image2"]["tmp_name"], "../product/img/".$newfname2);
      } else {
         $newfname2 = $imagename2; // 기본값 리턴
      }
   }

   if ($checkno3 == "1") {
      unlink("../product/img/$imagename3");
   } else {
      if ($image3) { // 이미지가 있는 경우 전 이미지를 삭제시키고 새로운 이미지를 업로드한다.
         if ($imagename3 != $imagename1 && $imagename3 != $imagename2)
            unlink("../product/img/$imagename3");
         $newfname3 = $no."_".$image3;
         move_uploaded_file($_FILES["image3"]["tmp_name"], "../product/img/".$newfname3);
      } else {
         $newfname3 = $imagename3; // 기본값 리턴
      }
   }


   // regday_result
   $regday = sprintf("%04d-%02d-%02d", $regday1, $regday2, $regday3);

   // contents_result
   $contents = addslashes($contents); // stripslashes 풀기

   // name_result
   $name = addslashes($name);

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
            update product set
            menu31 = $menu,
            code31 = '$code',
            name31 = '$name',
            coname31 = '$coname',
            price31 = $price,
            opt1 = $opt1,
            opt2 = $opt2,
            content31 = '$contents',
            status31 = $status,
            regday31 = '$regday',
            icon_new31 = $icon_new,
            icon_hit31 = $icon_hit,
            icon_sale31 = $icon_sale,
            discount31 = $discount,
            image1 = '$newfname1',
            image2 = '$newfname2',
            image3 = '$newfname3' where no31=$no
         ";

   $result = mysqli_query($db, $query);
   if (!$result) exit("에러: $query");

   echo("<script>location.href='product.php?no=$no&sel1=$sel1&sel2=$sel2&sel3=$sel3&sel4=$sel4&text1=$text1&page=$page'</script>");
?>