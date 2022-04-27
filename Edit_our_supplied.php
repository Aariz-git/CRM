<?php

//connection
session_start();
require_once("./config.php");
if (!isset($_SESSION["admin_id"])) {
    header('Location: index.php');
}

if (isset($_POST["our_supply_submit"])) {

    $id    = $_POST["edit_id"];
    $segment    = $_POST["segment"];
    $supplier   = $_POST["supplier"];
    $customer   = $_POST["customer"];
    $product    = $_POST["product"];
    $quantity   = $_POST["quantity"];

	$addasignmentQuery = "UPDATE our_supplied set segment='$segment',supplier='$supplier',customer='$customer',product='$product'
,quantity='$quantity' where id='$id'";

        $fire = mysqli_query($con, $addasignmentQuery);
        if ($fire) {
            header('Location: our_supplied.php');
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
    header('Location: our_supplied.php');   
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
    <title>Edit Our Supply</title>

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

    <?php
                            require_once("./config.php");
                            if (isset($_POST['edit_btn'])) {

                                $id = $_POST['edit_id'];
                                $query = "SELECT * FROM our_supplied where id ='$id'";
//								echo $query;
                                $query_run = mysqli_query($con, $query);
                                 //echo $query_run;
                                // var_dump($query_run);
                                // die;
                                foreach ($query_run as $row) {

                            ?>

                    <form action="Edit_our_supplied.php" method="POST" enctype="multipart/form-data">
                        <h1>Add Our Supply</h1><br>
                        <div class="form-group">
							<input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                            <label for="exampleInputName">Segment</label>
                            <input type="text" name="segment" class="form-control" value="<?php echo $row['segment']; ?>" aria-describedby="emailHelp" placeholder="Enter Segment" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Supplier</label>
                            <input type="text" name="supplier" class="form-control" value="<?php echo $row['supplier']; ?>" aria-describedby="emailHelp" placeholder="Enter Supplier" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Customer</label>
                            <input type="text" name="customer" class="form-control" value="<?php echo $row['customer']; ?>" aria-describedby="emailHelp" placeholder="Enter Customer" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Product</label>
                            <input type="text" name="product" class="form-control" value="<?php echo $row['product']; ?>" aria-describedby="emailHelp" placeholder="Enter Product" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Quantity</label>
                            <input type="text" name="quantity" class="form-control value="<?php echo $row['quantity']; ?>" aria-describedby="emailHelp" placeholder="Enter Quantity" required>
                        </div>
                        <button type="submit" name="our_supply_submit" class="btn btn-primary mt-1">Submit</button>
                    </form>
               <?php
                                }
                            }
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