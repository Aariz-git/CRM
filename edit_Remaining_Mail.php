<?php

//connection
session_start();
require_once("./config.php");
if (!isset($_SESSION["admin_id"])) {
    header('Location: index.php');
}

if (isset($_POST["customer_submit"])) {

	$id           	   = $_POST["edit_id"];
    $segment           = $_POST["segment"];
    $customer           = $_POST["customer"];
    $product    = $_POST["product"];
    $attribute       = $_POST["attribute"];
    $quantity   = $_POST["quantity"];
    $fob       = $_POST["fob"];
    $cnf       = $_POST["cnf"];
		
			$addasignmentQuery = "UPDATE remaining_the_mail set segment='$segment',customer='$customer',product='$product'
			,attribute='$attribute'
,quantity='$quantity',fob='$fob',cnf='$cnf' where id ='$id'";
		
        $fire = mysqli_query($con, $addasignmentQuery);
        if ($fire) {
            header('Location: remaining_the_mail.php');
        }


    $check_query = mysqli_query($con, "Select * from remaining_the_mail where id = '$c_email'");
    $check = mysqli_num_rows($check_query);
    if ($check > 0) {
?>
        <script src="./Admin_Login/vendor/jquery/jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready(function() {
                swal({
                    title: "ERROR!",
                    text: "Email Already Exist!",
                    icon: "error",
                    button: "Retry",
                });
            })
        </script>
        <?php
    } else {

        if ($fire) {
            header('Location: remaining_the_mail.php');
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
    header('Location: remaining_the_mail.php');   
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
    <title>Edit Remaining Mail</title>

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
                                $query = "SELECT * FROM remaining_the_mail where id ='$id'";
//								echo $query;
                                $query_run = mysqli_query($con, $query);
                                // echo $query_run;
                                // var_dump($query_run);
                                // die;
                                foreach ($query_run as $row) {

                            ?>


                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                        <h1>Edit Remaining Mail</h1><br>
                        <div class="form-group">
						                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                            <label for="exampleInputName">Segment</label>
                            <input type="text" name="segment" value="<?php echo $row['segment']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Name" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Customer</label>
                            <input type="text" name="customer" value="<?php echo $row['customer']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Email" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Product</label>
                            <input type="text" name="product" value="<?php echo $row['product']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Contact Person" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Attribute</label>
                            <input type="text" name="attribute" value="<?php echo $row['attribute']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Designation" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Quantity</label>
                            <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Company Address" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">FOB</label>
                            <input type="text" name="fob" value="<?php echo $row['fob']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Company Telephone" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">CNF</label>
                            <input type="text" name="cnf" value="<?php echo $row['cnf']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Cell Number" required>
                        </div>
                        <button type="submit" name="customer_submit"  class="btn btn-primary mt-1">Submit</button>
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