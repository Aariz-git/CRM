<?php 
session_start();
require_once("./config.php");
                        $from = $_POST['from'];
                        $to = $_POST['to'];
                        $query = "SELECT * FROM dwr WHERE date BETWEEN '$from' AND '$to'";
                        $query_run1 = mysqli_query($con, $query);
                        ?>