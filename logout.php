<?php
    session_start(); 
 
   if (isset($_COOKIE['email'])){
    // $user = $_SESSION['email'];
    setcookie("email",'',time()-300);
   }
   if (isset($_COOKIE['level'])){
    // $user = $_SESSION['email'];
    setcookie("level",'',time()-300);
   }
   if (isset($_SESSION['email'])){
        unset($_SESSION['email']);
   }
   
   header('location:index.php');
?>