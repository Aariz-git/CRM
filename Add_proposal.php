<?php

//connection
session_start();
require_once("./config.php");
if (!isset($_SESSION["admin_id"])) {
    header('Location: index.php');
}

if (isset($_POST["proposal_submit"])) {

    $s_no            = $_POST["sr_no"];
    $date            = $_POST["date"];
    $customer        = $_POST["customer"];
    $supplier        = $_POST["supplier"];
    $product         = $_POST["product"];
    $quantity_price  = $_POST["quantity_price"];
    $follow_up_date  = $_POST["follow_up_date"];
    $concern_person  = $_POST["concern_person"];
    $reason          = $_POST["reason"];


    $check_query = mysqli_query($con, "Select * from proposal where sr_no = '$s_no'");
    $check = mysqli_num_rows($check_query);
    if ($check > 0) {
?>
        <script src="./Admin_Login/vendor/jquery/jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready(function() {
                swal({
                    title: "ERROR!",
                    text: "Proposal Serial Already Exist!",
                    icon: "error",
                    button: "Retry",
                });
            })
        </script>
        <?php
    } else {

        $addProposal = "INSERT INTO `proposal`(`sr_no`, `date`, `customer`, `supplier`, `product`, `quantity_price`, `follow_up_date`, `concern_person`, `reason`) VALUES ('$s_no','$date','$customer','$supplier','$product','$quantity_price','$follow_up_date','$concern_person','$reason')";
        $fire = mysqli_query($con, $addProposal);
        if ($fire) {
            header('Location: Proposal.php');
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
            header('Location: Add_proposal.php');
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
    <title>Add Proposal</title>

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
                        <h1>Add Proposal</h1><br>
                        <div class="form-group">
                            <label for="exampleInputName">S.no</label>
                            <input type="text" name="sr_no" class="form-control" aria-describedby="emailHelp" placeholder="Enter Serial Number" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Date</label>
                            <input type="date" name="date" class="form-control" aria-describedby="emailHelp" placeholder="Enter Date" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Customer</label>
                            <input type="text" name="customer" class="form-control" aria-describedby="emailHelp" placeholder="Enter Customer" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Supplier</label>
                            <input type="text" name="supplier" class="form-control" aria-describedby="emailHelp" placeholder="Enter Supplier" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Product</label>
                            <input type="text" name="product" class="form-control" aria-describedby="emailHelp" placeholder="Enter Product" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Quantity/Price</label>
                            <input type="text" name="quantity_price" class="form-control" aria-describedby="emailHelp" placeholder="Enter Quantity/Price" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Follow Up Date</label>
                            <input type="text" name="follow_up_date" class="form-control" aria-describedby="emailHelp" placeholder="Enter Follow Up Date" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Concern Person</label>
                            <input type="text" name="concern_person" class="form-control" aria-describedby="emailHelp" placeholder="Enter Concern Person" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">reason</label>
                            <textarea name="reason" cols="30" rows="10" class="form-control" aria-describedby="emailHelp" placeholder="Enter reason" required></textarea>
                        </div>
                        <button type="submit" name="proposal_submit" class="btn btn-primary mt-1">Submit</button>
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