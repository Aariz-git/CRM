<?php

//connection
session_start();
require_once("./config.php");
if (!isset($_SESSION["admin_id"])) {
    header('Location: index.php');
}

if (isset($_POST["customer_submit"])) {

echo "te";

	$id           	   = $_POST["edit_id"];
    $c_name            = $_POST["C_name"];
    $c_email           = $_POST["C_email"];
    $Contact_person    = $_POST["Contact_person"];
    $Designation       = $_POST["Designation"];
    $Company_address   = $_POST["Company_address"];
    $Company_tel       = $_POST["Company_tel"];
    $Cell_number       = $_POST["Cell_number"];	
	
	$addasignmentQuery = "UPDATE customer set customer_name='$c_name',customer_email='$c_email',contact_person='$Contact_person',designation='$Designation'
,company_address='$Company_address',company_tel='$Company_tel',cell_number='$Cell_number' where customer_id='$id'";
	echo $addasignmentQuery;
	$fire = mysqli_query($con, $addasignmentQuery) or die("data not updated " . mysqli_error($con));

        if ($fire) {
            header('Location: Customer.php');
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
    <title>Add Customer</title>

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
                            if (isset($_POST['Customer_edit_btn'])) {
                                $id = $_POST['Customer_edit_id'];
                                $query = "SELECT * FROM customer where customer_id ='$id'";
//								echo $query;
                                $query_run = mysqli_query($con, $query);
                                // echo $query_run;
                                // var_dump($query_run);
                                // die;
                                foreach ($query_run as $row) {

                            ?>
							
				    <form action="EditCustomer.php" method="POST" enctype="multipart/form-data">
                        <h1>Edit Customer</h1><br>
                        <input type="hidden" name="edit_id" value="<?php echo $row['customer_id']; ?>">
						<div class="form-group">
                            <label for="exampleInputName">Customer Name</label>
                            <input type="text" name="C_name" class="form-control" aria-describedby="emailHelp" value="<?php echo $row['customer_name'] ?>" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Customer Email</label>
                            <input type="email" name="C_email" class="form-control" aria-describedby="emailHelp" value="<?php echo $row['customer_email'] ?>" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Contact Person</label>
                            <input type="text" name="Contact_person" class="form-control" aria-describedby="emailHelp" value="<?php echo $row['contact_person'] ?>" placeholder="Enter Contact Person" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Designation</label>
                            <input type="text" name="Designation" class="form-control" aria-describedby="emailHelp" value="<?php echo $row['designation'] ?>" placeholder="Enter Designation" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Company Address</label>
                            <input type="text" name="Company_address" class="form-control" aria-describedby="emailHelp" value="<?php echo $row['company_address'] ?>" placeholder="Enter Company Address" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Company Telephone</label>
                            <input type="text" name="Company_tel" class="form-control" aria-describedby="emailHelp" value="<?php echo $row['company_tel'] ?>" placeholder="Enter Company Telephone" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Cell Number</label>
                            <input type="text" name="Cell_number" class="form-control" aria-describedby="emailHelp" value="<?php echo $row['cell_number'] ?>" placeholder="Enter Cell Number" required>
                        </div>
                        <button type="submit" name="customer_submit" class="btn btn-primary mt-1">Submit</button>
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