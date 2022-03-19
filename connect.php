<?php
    $conn = mysqli_connect("localhost","root","","project");
    $sel = mysqli_select_db($conn,'project') or die('Could not select database.');
    mysqli_set_charset($conn,"utf8");
?>