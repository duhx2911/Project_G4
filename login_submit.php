<?php
    session_start();
    include 'lib_db.php';
    include 'connect.php';
    // print_r($_POST);
    // include 'check.php';
    if( isset($_POST['submit-dangnhap']) && $_POST['email'] != '' && $_POST['password'] != ''){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = md5($password);
        //$ajax = isset($_POST['ajax']) ? $_POST['ajax'] : 0; 
        $sql = "SELECT * FROM user WHERE email='$email'";
        $user = mysqli_query($conn,$sql);
        // print_r('$user').die('ok');
        $kt = select_one($sql);
        if (mysqli_num_rows($user) > 0 ){
            if($kt['matkhau'] == $password){
                $_SESSION['email'] = $email;
                setcookie("email",$_SESSION['email'],time()+300);
                if ( isset($_SESSION['email'])){
                    $db = select_one($sql);
                    
                }
                header("location:index.php");
            }else{
                $_SESSION["notification"] = "Mật khẩu không chính xác";
                header("location:index.php");
                die();
               }

        }else{
            $_SESSION['notification'] = "Không tồn tại tài khoản này";
            header("location:index.php");
            die();
        }
    }
?>