<?php 
//    $con=mysqli_connect("localhost", "ecommerce_db","Karachi123@", "ecommerce_db");
    $con=mysqli_connect("localhost", "root","", "ecommerce_db");
    if(mysqli_connect_errno()){
        die("Connection Fail: ".mysqli_connect_error());
    }
    ?>