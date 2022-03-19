<?php
    session_start();
    include("lib_db.php");

    $sql = "SELECT * FROM danhmucsach ";
    $cates = select_list($sql);
    $sq= "SELECT * FROM sach";
    $c = select_list($sq);
    // print_r($c).exit();
    $last = end($c);
    // print_r($last).die('ok');
    $dem = $last['id'] + 1;
    // print_r($dem).die('ok');
//     if(isset($_COOKIE['user_name'])){
//       if($_COOKIE['level']!=md5(1)){
//           return header("location:index.php");
//       }
      
//   }else header("location:login.php");
?>