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
                'id' => $row[0],
                'name' => $row[3],
                'img' => $row[2],
                'giasale' => $row[5],
                'giagoc' => $row[6],
                'number' => 1
            );

        }else{
            $cart = $_SESSION["cart"];
            if(array_key_exists($id,$cart)){
                $cart[$id] = array(
                    'id' => $row[0],
                    'name' => $row[3],
                    'img' => $row[2],
                    'giasale' => $row[5],
                    'giagoc' => $row[6],
                    'number' => (int)$cart[$id]["number"] + 1
                );
            }else{
                $cart[$id] = array(
                    'id' => $row[0],
                    'name' => $row[3],
                    'img' => $row[2],
                    'giasale' => $row[5],
                    'giagoc' => $row[6],
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
