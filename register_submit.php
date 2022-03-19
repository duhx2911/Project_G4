<?php
    session_start();
    include 'connect.php';
    if( isset($_POST['submit-dangky']) && $_POST['name'] != '' && $_POST['phone'] != '' && $_POST['email'] != '' && $_POST['password'] != '' && $_POST['confirm_password'] != ''){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        if($password != $confirm_password){
            header("location:index.php");
            die();
        }
        // $level = 0;
        $sql = "SELECT * FROM user WHERE email='$email'";
        // print_r($sql).die('ok');    
        $query = mysqli_query($conn,$sql);
        // print_r($query).die('ok');
        $password = md5($password);
        $num_row = mysqli_num_rows($query);
        // print_r($num_row).die('ok');
        if($num_row == 0){
            $sql = "INSERT INTO `user`(`hoten`, `sodienthoai`, `email`, `matkhau`) VALUES ('$name','$phone','$email','$password')";
            mysqli_query($conn,$sql);
            header("location:index.php");
            // print_r($sql).die('ok');
        }else{
            // die('ok');
            header("location:index.php");
            die();
        }       
        //header("location:index.php");
    }else{
        //header("location:index.php");
    }
?>