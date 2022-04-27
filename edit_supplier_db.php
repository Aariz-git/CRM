<?php

//connection
session_start();
require_once("./config.php");
if (!isset($_SESSION["admin_id"])) {
    header('Location: index.php');
}

if (isset($_POST["supply_db_submit"])) {
$id    = 	$_POST["edit_id"];
    $supplier_name    = $_POST["supplier_name"];
    $product_name   = $_POST["product_name"];
    $pharmacopia    = $_POST["pharmacopia"];
    $credentials   = $_POST["credentials"];
    $agency   = $_POST["agency"];



$addasignmentQuery = "UPDATE supplier_db set supplier_name='$supplier_name',product_name='$product_name',pharmacopia='$pharmacopia',credentials='$credentials'
,agency='$agency' where id='$id'";
        
        $fire = mysqli_query($con, $addasignmentQuery);
        if ($fire) {
            header('Location: supplier_db.php');
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
    header('Location: Add_supplier_db.php');   
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
    <title>Add Supplier Databse</title>

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
                                $query = "SELECT * FROM supplier_db where id ='$id'";
//								echo $query;
                                $query_run = mysqli_query($con, $query);
                                // echo $query_run;
                                // var_dump($query_run);
                                // die;
                                foreach ($query_run as $row) {

                            ?>

                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                        <h1>Add Supplier Database</h1><br>
                        <div class="form-group">
						 <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                            <label for="exampleInputName">Supplier Name</label>
                            <input type="text" name="supplier_name" value="<?php echo $row['supplier_name']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Supplier Name" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Product Name</label>
                            <input type="text" name="product_name" value="<?php echo $row['product_name']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Product Name" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Pharmacopia</label>
                            <input type="text" name="pharmacopia" value="<?php echo $row['pharmacopia']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Pharmacopia" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Credentials</label>
                            <input type="text" name="credentials" value="<?php echo $row['credentials']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Credentials" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Agency</label>
                            <input type="text" name="agency" value="<?php echo $row['agency']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Agency" required>
                        </div>
                        <button type="submit" name="supply_db_submit" class="btn btn-primary mt-1">Submit</button>
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