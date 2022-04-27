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
    if ($_FILES["indent_csv"]["name"]) {
        $filename = explode(".", $_FILES["indent_csv"]["name"]);
        if (end($filename) == "csv") {
            $handle = fopen($_FILES['indent_csv']['tmp_name'], "r");
            while ($data = fgetcsv($handle)) {

            
                $indent_no    = mysqli_real_escape_string($con, $data[0]);
                $buyer        = mysqli_real_escape_string($con, $data[1]);
                $item         = mysqli_real_escape_string($con, $data[2]);
                $quantity     = mysqli_real_escape_string($con, $data[3]);
                $price        = mysqli_real_escape_string($con, $data[4]);
                $value        = mysqli_real_escape_string($con, $data[5]);
                $hs_code      = mysqli_real_escape_string($con, $data[6]);
                $pay_term     = mysqli_real_escape_string($con, $data[7]);
                $shipment     = mysqli_real_escape_string($con, $data[8]);
                $invoice_no   = mysqli_real_escape_string($con, $data[9]);
                $po_no        = mysqli_real_escape_string($con, $data[10]);
                $indent_date  = mysqli_real_escape_string($con, $data[11]);
                $supplier     = mysqli_real_escape_string($con, $data[12]);
                $attribute    = mysqli_real_escape_string($con, $data[13]);
                $instance     = mysqli_real_escape_string($con, $data[14]);
                $uom          = mysqli_real_escape_string($con, $data[15]);
                $currency     = mysqli_real_escape_string($con, $data[16]);
                $ship_mode    = mysqli_real_escape_string($con, $data[17]);
                $payment_term = mysqli_real_escape_string($con, $data[18]);
                $shipment_mode= mysqli_real_escape_string($con, $data[19]);
                $date         = mysqli_real_escape_string($con, $data[20]);
                $exp_date     = mysqli_real_escape_string($con, $data[21]);
                $invoice_date = mysqli_real_escape_string($con, $data[22]);
                $po_date      = mysqli_real_escape_string($con, $data[23]);
                $query = "INSERT INTO `indent_register`(`indent_no`, `buyer`, `item`, `quantity`, `price`, `value`, `hs_code`, `pay_term`, `shipment`, `invoice_no`, `po_no`, `indent_date`, `supplier`, `attribute`, `instance`, `uom`, `currency`, `ship_mode`, `payment_term`, `shipment_mode`, `date`, `exp_date`, `invoice_date`, `po_date`) 
                VALUES ('$indent_no','$buyer','$item','$quantity','$price','$value','$hs_code','$pay_term','$shipment','$invoice_no','$po_no','$indent_date','$supplier','$attribute','$instance','$uom','$currency','$ship_mode','$payment_term','$shipment_mode','$date','$exp_date','$invoice_date','$po_date')";
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

if (isset($_POST["Indent_submit"])) {

$id    = 	$_POST["edit_id"];
    $indent_no    = $_POST["indent_no"];
    $buyer    = $_POST["buyer"];
    $item      = $_POST["item"];
    $quantity    = $_POST["quantity"];
    $price   = $_POST["price"];
    $value   = $_POST["value"];
    $hs_code   = $_POST["hs_code"];
    $pay_term   = $_POST["pay_term"];
    $shipment   = $_POST["shipment"];
    $invoice_no   = $_POST["invoice_no"];
    $po_no   = $_POST["po_no"];
    $indent_date   = $_POST["indent_date"];
    $supplier   = $_POST["supplier"];
    $attribute   = $_POST["attribute"];
    $instance   = $_POST["instance"];
    $uom   = $_POST["uom"];
    $currency   = $_POST["currency"];
    $ship_mode   = $_POST["ship_mode"];
    $payment_term   = $_POST["payment_term"];
    $shipment_mode   = $_POST["shipment_mode"];
    $date   = $_POST["date"];
    $exp_date   = $_POST["exp_date"];
    $invoice_date   = $_POST["invoice_date"];
    $po_date   = $_POST["po_date"];



$addasignmentQuery = "UPDATE indent_register set indent_no='$indent_no',buyer='$buyer',item='$item',quantity='$quantity'
,price='$price',value='$value',hs_code='$hs_code',pay_term='$pay_term'
,shipment='$shipment',invoice_no='$invoice_no',po_no='$po_no',indent_date='$indent_date'
,supplier='$supplier',attribute='$attribute',instance='$instance'
,uom='$uom',currency='$currency',ship_mode='$ship_mode',payment_term='$payment_term',shipment_mode='$shipment_mode',date='$date'
,exp_date='$exp_date',invoice_date='$invoice_date',po_date='$po_date' where id='$id'";

    $addIndent = "INSERT INTO `indent_register`(`indent_no`, `buyer`, `item`, `quantity`, `price`, `value`, `hs_code`, `pay_term`,
	`shipment`, `invoice_no`, `po_no`, `indent_date`, `supplier`, `attribute`, `instance`, `uom`, `currency`, `ship_mode`, `payment_term`, 
	`shipment_mode`, `date`, `exp_date`, `invoice_date`, `po_date`) 
    VALUES ('$indent_no','$buyer','$item','$quantity','$price','$value','$hs_code','$pay_term','$shipment','$invoice_no','$po_no','$indent_date','$supplier','$attribute','$instance','$uom','$currency','$ship_mode','$payment_term','$shipment_mode','$date','$exp_date','$invoice_date','$po_date')";
    $fire = mysqli_query($con, $addasignmentQuery);
    if ($fire) {
        header('Location: Indent_register.php');
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
        header('Location: Add_indent.php');
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
    <title>Add Indent</title>

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
                    <input type="file" name="indent_csv" accept=".csv">
                    <button type="submit" name="upload" class="btn btn-info">Upload CSV</button><br>
                </form>

                <div class="container">
                    <?php echo $msg ?>
					
					
 <?php

                            require_once("./config.php");
                            if (isset($_POST['edit_btn'])) {
                                $id = $_POST['edit_id'];
                                $query = "SELECT * FROM indent_register where id ='$id'";
//								echo $query;
                                $query_run = mysqli_query($con, $query);
                                // echo $query_run;
                                // var_dump($query_run);
                                // die;
                                foreach ($query_run as $row) {

                            ?>
					
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                        <h1>Add Indent Register</h1><br>
                        <div class="form-group">
						  <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                            <label for="exampleInputName">Indent Number</label>
                            <input type="text" name="indent_no" value="<?php echo $row['indent_no']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Indent Number" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Buyer</label>
                            <input type="text" name="buyer" value="<?php echo $row['buyer']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Buyer" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Item</label>
                            <input type="text" name="item" value="<?php echo $row['item']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Item" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Quantity</label>
                            <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Price</label>
                            <input type="text" name="price" value="<?php echo $row['price']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Price" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Value</label>
                            <input type="text" name="value" value="<?php echo $row['value']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Value" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">HS Code</label>
                            <input type="text" name="hs_code" value="<?php echo $row['hs_code']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter HS Code" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Payment Term</label>
                            <input type="text" name="pay_term" value="<?php echo $row['pay_term']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Payment Term" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Shipment</label>
                            <input type="text" name="shipment" value="<?php echo $row['shipment']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Shipment" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Invoice Number</label>
                            <input type="text" name="invoice_no" value="<?php echo $row['invoice_no']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Invoice Number" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">PO Number</label>
                            <input type="text" name="po_no" value="<?php echo $row['po_no']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter PO Number" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Indent Date</label>
                            <input type="date" class="datepicker form-control" value="<?php echo $row['indent_date']; ?>" data-date-format="yyyy/mm/dd" name="indent_date" placeholder="Enter Indent Date" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Supplier</label>
                            <input type="text" name="supplier" value="<?php echo $row['supplier']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Supplier" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Attribute</label>
                            <input type="text" name="attribute" value="<?php echo $row['attribute']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Attribute" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Instance</label>
                            <input type="text" name="instance" value="<?php echo $row['instance']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Instance" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">UOM</label>
                            <input type="text" name="uom" value="<?php echo $row['uom']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter UOM" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Currency</label>
                            <input type="text" name="currency" value="<?php echo $row['currency']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Currency" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Shipment Mode</label>
                            <input type="text" name="ship_mode" value="<?php echo $row['ship_mode']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Shipment Mode" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Payment Term</label>
                            <input type="text" name="payment_term"  value="<?php echo $row['payment_term']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Payment Term" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Shipment Mode</label>
                            <input type="text" name="shipment_mode" value="<?php echo $row['shipment_mode']; ?>" class="form-control" aria-describedby="emailHelp" placeholder="Enter Shipment Mode" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Date</label>
                            <input type="date" class="datepicker form-control" value="<?php echo $row['date']; ?>" data-date-format="yyyy/mm/dd" name="date" placeholder="Enter Date" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Expiry Date</label>
                            <input type="date" class="datepicker form-control" value="<?php echo $row['exp_date']; ?>" data-date-format="yyyy/mm/dd" name="exp_date" placeholder="Enter Expiry Date" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Invoice Date</label>
                            <input type="date" class="datepicker form-control" value="<?php echo $row['invoice_date']; ?>" data-date-format="yyyy/mm/dd" name="invoice_date" placeholder="Enter Invoice Date" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">PO Date</label>
                            <input type="date" class="datepicker form-control" value="<?php echo $row['po_date']; ?>" data-date-format="yyyy/mm/dd" name="po_date" placeholder="Enter PO Date" required>
                        </div>
                        <button type="submit" name="Indent_submit" class="btn btn-primary mt-1">Submit</button>
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