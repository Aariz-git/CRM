<?php
session_start();
require_once("./config.php");

if (!isset($_SESSION["admin_id"])) {
    header('Location: index.php');
}

if (isset($_POST['delete_btn'])) {
    $id = $_POST['edit_id'];
    $query = "Delete from register where id = '$id'";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {

        header('Location: Dashboard.php');
    }
}

if (isset($_POST['Buyer_Item_delete_btn'])) {
    $id = $_POST['Buyer_del_id'];
    $query = "Delete from buyer_item where id = '$id'";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
		echo "de";
        header('Location: Buyer_item.php');
	}
}

if (isset($_POST['Customer_delete_btn'])) {
    $id = $_POST['Customer_edit_id'];
    $query = "Delete from customer where customer_id = '$id'";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {

        header('Location: Customer.php');
    }
}

if (isset($_POST['admin_delete_btn'])) {
    $id = $_POST['admin_edit_id'];
    $query = "Delete from admins where a_id = '$id'";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {

        header('Location: Dashboard.php');
    }
}
// if (isset($_POST['user_delete_btn'])) {
//     $id = $_POST['user_delete_id'];
//     $query = "Delete from user where u_id = '$id'";
//     $query_run = mysqli_query($con, $query);
//     if ($query_run) {

//         header('Location: Show_User.php');
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="./Admin_Dashboard/Dashboard/css/font-face.css" rel="stylesheet" media="all">
    <link href="./Admin_Dashboard/Dashboard/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="./Admin_Dashboard/Dashboard/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="./Admin_Dashboard/Dashboard/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
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

</head>

<body class="animsition">

    <div class="page-wrapper">

        <?php include 'Admin_nav.php'; ?>

        <!-- PAGE CONTAINER-->
        <div class="page-container">

            <?php include 'Dash_topbar.php'; ?>

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>
                                    <button class="au-btn au-btn-icon au-btn--blue">

                                </div>
                            </div>
                        </div>

                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div class="text">
                                                <?php

                                                $query = "Select customer_id from customer order by customer_id";
                                                $query_run = mysqli_query($con, $query);
                                                $row = mysqli_num_rows($query_run);
                                                echo '<h2>' . $row . '</h2>';
                                                ?>
                                                <span>Customers</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-boxes"></i>
                                            </div>
                                            <div class="text">
                                                <?php
                                                $query = "Select id from buyer_item order by id";
                                                $query_run = mysqli_query($con, $query);
                                                $row = mysqli_num_rows($query_run);
                                                echo '<h2>' . $row . '</h2>';
                                                ?>
                                                <span>Buyer Item</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-shipping-fast"></i>
                                            </div>
                                            <div class="text">
                                                <?php
                                                $query = "Select id from our_supplied order by id";
                                                $query_run = mysqli_query($con, $query);
                                                $row = mysqli_num_rows($query_run);
                                                echo '<h2>' . $row . '</h2>';
                                                ?>
                                                <span>Our Supplied</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart3"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-box"></i>
                                            </div>
                                            <div class="text">
                                                <?php
                                                $query = "Select id from supplier_item order by id";
                                                $query_run = mysqli_query($con, $query);
                                                $row = mysqli_num_rows($query_run);
                                                echo '<h2>' . $row . '</h2>';
                                                ?>
                                                <span>Supplier Item</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c5">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-file-alt"></i>
                                            </div>
                                            <div class="text">
                                                <?php
                                                $query = "Select id from buyer_quotation order by id";
                                                $query_run = mysqli_query($con, $query);
                                                $row = mysqli_num_rows($query_run);
                                                echo '<h2>' . $row . '</h2>';
                                                ?>
                                                <span>Buyer Quotation</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart6"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c6">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-file"></i>
                                            </div>
                                            <div class="text">
                                                <?php
                                                $query = "Select id from proposal order by id";
                                                $query_run = mysqli_query($con, $query);
                                                $row = mysqli_num_rows($query_run);
                                                echo '<h2>' . $row . '</h2>';
                                                ?>
                                                <span>Proposal</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart7"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                       
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
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
<!-- end document-->