<?php
    session_start();
    include 'lib_db.php';
    include 'connect.php';
    $tongtien = 0;
    if(isset($_SESSION['cart']))
    {
        foreach($_SESSION['cart'] as $lichsu)
        {
                $uid = $lichsu['id'];
                $img = $lichsu['img'];
                $name = $lichsu['name'];
                $soluong = $lichsu['number'];
                $giasale = $lichsu['giasale'];
                $giagoc = $lichsu['giagoc'];
                $tongtien = $giasale*$soluong;
            
            // print_r($num_row).die('ok');
            $sql = "INSERT INTO `giohang`(`uid`, `img`, `tensach`, `soluong`, `giasale`, `giagoc`, `tongtien`) VALUES 
            ('$uid','$img','$name','$soluong','$giasale','$giagoc','$tongtien')";
            mysqli_query($conn,$sql);
                // print_r($sql).die('ok');      
            //header("location:index.php");
        }
        unset($_SESSION['cart']);
        header("location: giohang.php");
    }
?>