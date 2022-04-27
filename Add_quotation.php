<?php

//connection
session_start();
require_once("./config.php");
if (!isset($_SESSION["admin_id"])) {
    header('Location: index.php');
}

if (isset($_POST["quotation_submit"])) {

    $min_of_meeting           = $_POST["min_of_meeting"];
    $date           = $_POST["date"];
    $s_no                     = $_POST["s_no"];
    $customer_name            = $_POST["customer_name"];
    $brand_name               = $_POST["brand_name"];
    $composition              = $_POST["composition"];
    $pack_size                = $_POST["pack_size"];
    $decision                 = $_POST["decision"];
    $remarks                  = $_POST["remarks"];


    $check_query = mysqli_query($con, "Select * from buyer_quotation where s_no = '$s_no'");
    $check = mysqli_num_rows($check_query);
    if ($check > 0) {
?>
        <script src="./Admin_Login/vendor/jquery/jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready(function() {
                swal({
                    title: "ERROR!",
                    text: "Quotation Serial Already Exist!",
                    icon: "error",
                    button: "Retry",
                });
            })
        </script>
        <?php
    } else {

        $addQuotation = "INSERT INTO `buyer_quotation`(`min_of_meeting`,`date`, `s_no`, `customer_name`, `brand_name`, `composition`, `pack_size`, `decision`, `remarks`) VALUES ('$min_of_meeting','$s_no','$customer_name','$brand_name','$composition','$pack_size','$decision','$remarks')";
        $fire = mysqli_query($con, $addQuotation);
        if ($fire) {
            header('Location: Buyer_quotation.php');
        } else {
        ?>
            <script src="./Admin_Login/vendor/jquery/jquery-3.2.1.min.js"></script>
            <script>
                $(document).ready(function() {
                    swal({
                        title: "ERROR!",
                        text: "Cannot Add Data!",
                        icon: "error",
                        button: "Retry",
                    });
                })
            </script>
<?php
            header('Location: Add_quotation.php');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Admin_Dashboard/Dashboard/">
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Add Quotation</title>

    <!-- Fontfaces CSS-->
    <link href="./Admin_Dashboard/Dashboard/css/font-face.css" rel="stylesheet" media="all">
    <link href="./Admin_Dashboard/Dashboard/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="./Admin_Dashboard/Dashboard/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="./Admin_Dashboard/Dashboard/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="./Admin_Dashboard/Dashboard/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="./Admin_Dashboard/Dashboard/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="./Admin_Dashboard/Dashboard/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="./Admin_Dashboard/Dashboard/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="./Admin_Dashboard/Dashboard/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="./Admin_Dashboard/Dashboard/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="./Admin_Dashboard/Dashboard/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="./Admin_Dashboard/Dashboard/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="./Admin_Dashboard/Dashboard/css/theme.css" rel="stylesheet" media="all">
    <link rel="shortcut icon" href="./Admin_Dashboard/Dashboard/images/icon/sheen.png" type="image/x-icon" />

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <?php
        include 'Admin_nav.php';
        ?>
        <div class="page-container">
            <?php include 'Dash_topbar.php'; ?>


            <div class="main-content">

                <div class="container">

                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                        <h1>Add Quotation</h1><br>
                        <div class="form-group">
                            <label for="exampleInputName">Minutes of meeting</label>
                            <input type="text" name="min_of_meeting" class="form-control" aria-describedby="emailHelp" placeholder="Enter minutes of meeting" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Date</label>
                            <input type="date" name="date" class="form-control" aria-describedby="emailHelp" placeholder="Enter serial number" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">S.no</label>
                            <input type="text" name="s_no" class="form-control" aria-describedby="emailHelp" placeholder="Enter serial number" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Customer Name</label>
                            <input type="text" name="customer_name" class="form-control" aria-describedby="emailHelp" placeholder="Enter customer name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Brand Name</label>
                            <input type="text" name="brand_name" class="form-control" aria-describedby="emailHelp" placeholder="Enter brand name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Composition</label>
                            <input type="text" name="composition" class="form-control" aria-describedby="emailHelp" placeholder="Enter composition" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Pack size</label>
                            <input type="text" name="pack_size" class="form-control" aria-describedby="emailHelp" placeholder="Enter pack size" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Decision</label>
                            <input type="text" name="decision" class="form-control" aria-describedby="emailHelp" placeholder="Enter decision" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Remarks</label>
                            <textarea name="remarks" cols="30" rows="10" class="form-control" aria-describedby="emailHelp" placeholder="Enter remarks" required></textarea>
                        </div>
                        <button type="submit" name="quotation_submit" class="btn btn-primary mt-1">Submit</button>
                    </form>
                    <?php


                    ?>
                </div>

            </div>


        </div>

        <!-- Jquery JS-->
        <script src="./Admin_Dashboard/Dashboard/vendor/jquery-3.2.1.min.js"></script>
        <!-- Bootstrap JS-->
        <script src="./Admin_Dashboard/Dashboard/vendor/bootstrap-4.1/popper.min.js"></script>
        <script src="./Admin_Dashboard/Dashboard/vendor/bootstrap-4.1/bootstrap.min.js"></script>
        <!-- Vendor JS       -->
        <script src="./Admin_Dashboard/Dashboard/vendor/slick/slick.min.js">
        </script>
        <script src="./Admin_Dashboard/Dashboard/vendor/wow/wow.min.js"></script>
        <script src="./Admin_Dashboard/Dashboard/vendor/animsition/animsition.min.js"></script>
        <script src="./Admin_Dashboard/Dashboard/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
        </script>
        <script src="./Admin_Dashboard/Dashboard/vendor/counter-up/jquery.waypoints.min.js"></script>
        <script src="./Admin_Dashboard/Dashboard/vendor/counter-up/jquery.counterup.min.js">
        </script>
        <script src="./Admin_Dashboard/Dashboard/vendor/circle-progress/circle-progress.min.js"></script>
        <script src="./Admin_Dashboard/Dashboard/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="./Admin_Dashboard/Dashboard/vendor/chartjs/Chart.bundle.min.js"></script>
        <script src="./Admin_Dashboard/Dashboard/vendor/select2/select2.min.js">
        </script>

        <!-- Main JS-->
        <script src="./Admin_Dashboard/Dashboard/js/main.js"></script>
</body>

</html>