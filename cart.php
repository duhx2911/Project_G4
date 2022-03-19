<?php
    include 'lib_db.php';
    include 'connect.php';
    session_start();
    $id = isset($_POST["id"]) ? $_POST["id"] : 0;
    if($id){
        $sql = " SELECT * FROM sach WHERE id={$id}" ;
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_row($result);
        // print_r($sql).exit();
        if(!isset($_SESSION["cart"])){
            $cart[$id] = array(
                'name' => $row[4],
                'img' => $row[3],
                'number' => 1
            );

        }else{
            $cart = $_SESSION["cart"];
            if(array_key_exists($id,$cart)){
                $cart[$id] = array(
                    'name' => $row[4],
                    'img' => $row[3],
                    'number' => (int)$cart[$id]["number"] + 1
                );
            }else{
                $cart[$id] = array(
                    'name' => $row[4],
                    'img' => $row[3],
                    'number' => 1
                );
            }
        }

        $_SESSION["cart"] = $cart;
        // echo "prE";
        print_r($cart);
        // print_r($cart).die('ok');
    }
?>