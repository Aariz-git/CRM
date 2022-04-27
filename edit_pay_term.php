<?php

//connection
session_start();
require_once("./config.php");
if (!isset($_SESSION["admin_id"])) {
    header('Location: index.php');
}
//CSV
$msg = '';
if (isset($_POST["upload"])) {
    if ($_FILES["pay_csv"]["name"]) {
        $filename = explode(".", $_FILES["pay_csv"]["name"]);
        if (end($filename) == "csv") {
            $handle = fopen($_FILES['pay_csv']['tmp_name'], "r");
            while ($data = fgetcsv($handle)) {

            
                $indent_no    = mysqli_real_escape_string($con, $data[0]);
                $order_no             = mysqli_real_escape_string($con, $data[0]);
                $order_date           = mysqli_real_escape_string($con, $data[0]);
                $buyer                = mysqli_real_escape_string($con, $data[0]);
                $supplier             = mysqli_real_escape_string($con, $data[0]);
                $quantity             = mysqli_real_escape_string($con, $data[0]);
                $qty                  = mysqli_real_escape_string($con, $data[0]);
                $item                 = mysqli_real_escape_string($con, $data[0]);
                $attribute_instance   = mysqli_real_escape_string($con, $data[0]);
                $currency             = mysqli_real_escape_string($con, $data[0]);
                $price                = mysqli_real_escape_string($con, $data[0]);
                $delivery_mech        = mysqli_real_escape_string($con, $data[0]);
                $payment_term         = mysqli_real_escape_string($con, $data[0]);
                $delivery_period_b    = mysqli_real_escape_string($con, $data[0]);
                $delivery_period_s    = mysqli_real_escape_string($con, $data[0]);
                $dwr_remarks          = mysqli_real_escape_string($con, $data[0]);
                $query = "INSERT INTO `payment_term`(`order_no`, `order_date`, `buyer`, `supplier`, `quantity`, `qty`, `item`, `attribute_instance`, `currency`, `price`, `delivery_mech`, `payment_term`, `delivery_period_b`, `delivery_period_s`, `dwr_remarks`)
                VALUES ('$order_no','$order_date','$buyer','$supplier','$quantity','$qty','$item','$attribute_instance','$currency','$price','$delivery_mech','$payment_term','$delivery_period_b','$delivery_period_s','$dwr_remarks')";
                $query_run = mysqli_query($con, $query);
                if ($query_run) {
                    $msg = '<label class="text-success">Data Uploaded</label>';
                }
            }
            fclose($handle);
        } else {
            $msg = '<label class="text-danger">Only CSV Supported!!</label>';
        }
    } else {
        $msg = '<label class="text-danger">Invalid CSV File or Empty!</label>';
    }
}
if(isset($_POST["make_history"])){
	$id    = 	$_POST["edit_id"];
    // $edit_id    = 	$_POST["edit_id"];
    $order_no             = $_POST["order_no"];
    $order_date           = $_POST["order_date"];
    $buyer                = $_POST["buyer"];
    $supplier             = $_POST["supplier"];
    $quantity             = $_POST["quantity"];
    $qty                  = $_POST["qty"];
    $item                 = $_POST["item"];
    $attribute_instance   = $_POST["attribute_instance"];
    $currency             = $_POST["currency"];
    $price                = $_POST["price"];
    $delivery_mech        = $_POST["delivery_mech"];
    $payment_term         = $_POST["payment_term"];
    $delivery_period_b    = $_POST["delivery_period_b"];
    $delivery_period_s    = $_POST["delivery_period_s"];
    $dwr_remarks          = $_POST["dwr_remarks"];

    $quer1 = "INSERT INTO remarks_history (id,remarks_id, module, customer_name, remarks, date) VALUES ('','$id', 'Payment_term', '$buyer', '$dwr_remarks', '$order_date')";
    $query_run123 = mysqli_query($con, $quer1);
    if ($query_run123) {
        echo "Succed";
    }
    else{
        echo"Failed";
    }
}
if (isset($_POST["pay_submit"])) {

$id    = 	$_POST["edit_id"];
    $order_no             = $_POST["order_no"];
    $order_date           = $_POST["order_date"];
    $buyer                = $_POST["buyer"];
    $supplier             = $_POST["supplier"];
    $quantity             = $_POST["quantity"];
    $qty                  = $_POST["qty"];
    $item                 = $_POST["item"];
    $attribute_instance   = $_POST["attribute_instance"];
    $currency             = $_POST["currency"];
    $price                = $_POST["price"];
    $delivery_mech        = $_POST["delivery_mech"];
    $payment_term         = $_POST["payment_term"];
    $delivery_period_b    = $_POST["delivery_period_b"];
    $delivery_period_s    = $_POST["delivery_period_s"];
    $dwr_remarks          = $_POST["dwr_remarks"];


$addasignmentQuery = "UPDATE payment_term set order_no='$order_no',order_date='$order_date',buyer='$buyer',supplier='$supplier'
,quantity='$quantity',qty='$qty',item='$item',attribute_instance='$attribute_instance',currency='$currency'
,price='$price',delivery_mech='$delivery_mech',payment_term='$payment_term',delivery_period_b='$delivery_period_b',delivery_period_s='$delivery_period_s'
,dwr_remarks='$dwr_remarks' where id='$id'";

    $fire = mysqli_query($con, $addasignmentQuery);
    if ($fire) {
        header('Location: Pay_term.php');
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
        header('Location: Add_pay_term.php');
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
    <title>Edit Payment Term</title>

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
                <form method="POST" enctype="multipart/form-data" class="m-2">
                    <h2>Add CSV</h2>
                    <input type="file" name="pay_csv" accept=".csv">
                    <button type="submit" name="upload" class="btn btn-info">Upload CSV</button><br>
                </form>

                <div class="container">
                    <?php echo $msg ?>
					
					
 <?php

                            require_once("./config.php");
                            if (isset($_POST['edit_btn'])) {
                                $id = $_POST['edit_id'];
                                $query = "SELECT * FROM payment_term where id ='$id'";
//								echo $query;
                                $query_run = mysqli_query($con, $query);
                                // echo $query_run;
                                // var_dump($query_run);
                                // die;
                                foreach ($query_run as $row) {

                            ?>
					
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                        <h1>Edit Payment Term</h1><br>
                        <div class="form-group">
						 <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                            <label for="exampleInputName">Order Number</label>
                            <input type="text" name="order_no" value="<?php echo $row['order_no']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Order Number" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Order Date</label>
                            <input type="date" class="datepicker form-control" value="<?php echo $row['order_date']; ?>" data-date-format="yyyy/mm/dd" name="order_date" placeholder="Enter Order Date" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Buyer</label>
                            <input type="text" name="buyer" value="<?php echo $row['buyer']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Buyer" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Supplier</label>
                            <input type="text" name="supplier" value="<?php echo $row['supplier']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Supplier" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Quantity</label>
                            <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Quantity</label>
                            <input type="text" name="qty" class="form-control" value="<?php echo $row['qty']; ?>" aria-describedby="emailHelp" placeholder="Enter 2nd Quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Item</label>
                            <input type="text" name="item" value="<?php echo $row['item']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Item" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Attribute Instance</label>
                            <input type="text" name="attribute_instance" value="<?php echo $row['attribute_instance']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Attribute Instance" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Currency</label>
                            <input type="text" name="currency" value="<?php echo $row['currency']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Currency" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Price</label>
                            <input type="text" name="price" value="<?php echo $row['price']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Price" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Delivery Mech</label>
                            <input type="text" name="delivery_mech" value="<?php echo $row['delivery_mech']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Delivery Mech" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Payment Term</label>
                            <input type="text" name="payment_term" value="<?php echo $row['payment_term']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Payment Term" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Delivery Period / B</label>
                            <input type="text" name="delivery_period_b" value="<?php echo $row['delivery_period_b']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Delivery Period / B" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Delivery Period / S</label>
                            <input type="text" name="delivery_period_s" value="<?php echo $row['delivery_period_s']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Delivery Period / S" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">DWR Remarks</label>
                            <input type="text" name="dwr_remarks" value="<?php echo $row['dwr_remarks']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter DWR Remarks" required>
                        </div>
                        <button type="submit" name="pay_submit" class="btn btn-primary mt-1">Submit</button>
                        <form id="editHide" action="edit_pay_term.php" method="post">
    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
    <button type="submit"  name="make_history" class="btn btn-primary">Make History</button>
</form>
                    </form>
                    <?php

								}
								}
                                else if (isset($_POST['make_history'])) {
                                    $id = $_POST['edit_id'];
                                    $query = "SELECT * FROM payment_term where id ='$id'";
    //								echo $query;
                                    $query_run = mysqli_query($con, $query);
                                    // echo $query_run;
                                    // var_dump($query_run);
                                    // die;
                                    foreach ($query_run as $row) {
    
                                ?>
                        
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                            <h1>Edit Payment Term</h1><br>
                            <div class="form-group">
                             <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                <label for="exampleInputName">Order Number</label>
                                <input type="text" name="order_no" value="<?php echo $row['order_no']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Order Number" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Order Date</label>
                                <input type="date" class="datepicker form-control" value="<?php echo $row['order_date']; ?>" data-date-format="yyyy/mm/dd" name="order_date" placeholder="Enter Order Date" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Buyer</label>
                                <input type="text" name="buyer" value="<?php echo $row['buyer']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Buyer" required>
    
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Supplier</label>
                                <input type="text" name="supplier" value="<?php echo $row['supplier']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Supplier" required>
    
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Quantity</label>
                                <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Quantity" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Quantity</label>
                                <input type="text" name="qty" class="form-control" value="<?php echo $row['qty']; ?>" aria-describedby="emailHelp" placeholder="Enter 2nd Quantity" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Item</label>
                                <input type="text" name="item" value="<?php echo $row['item']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Item" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Attribute Instance</label>
                                <input type="text" name="attribute_instance" value="<?php echo $row['attribute_instance']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Attribute Instance" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Currency</label>
                                <input type="text" name="currency" value="<?php echo $row['currency']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Currency" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Price</label>
                                <input type="text" name="price" value="<?php echo $row['price']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Price" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Delivery Mech</label>
                                <input type="text" name="delivery_mech" value="<?php echo $row['delivery_mech']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Delivery Mech" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Payment Term</label>
                                <input type="text" name="payment_term" value="<?php echo $row['payment_term']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Payment Term" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Delivery Period / B</label>
                                <input type="text" name="delivery_period_b" value="<?php echo $row['delivery_period_b']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Delivery Period / B" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">Delivery Period / S</label>
                                <input type="text" name="delivery_period_s" value="<?php echo $row['delivery_period_s']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Delivery Period / S" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName">DWR Remarks</label>
                                <input type="text" name="dwr_remarks" value="<?php echo $row['dwr_remarks']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter DWR Remarks" required>
                            </div>
                            <button type="submit" name="pay_submit" class="btn btn-primary mt-1">Submit</button>
                            <form id="editHide" action="edit_pay_term.php" method="post">
    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
    <button type="submit"  name="make_history" class="btn btn-primary">Make History</button>
</form>
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