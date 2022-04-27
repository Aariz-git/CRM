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
    if ($_FILES["dwr_csv"]["name"]) {
        $filename = explode(".", $_FILES["dwr_csv"]["name"]);
        if (end($filename) == "csv") {
            $handle = fopen($_FILES['dwr_csv']['tmp_name'], "r");
            while ($data = fgetcsv($handle)) {

                $date = mysqli_real_escape_string($con, $data[0]);
                $qty = mysqli_real_escape_string($con, $data[1]);
                $uom = mysqli_real_escape_string($con, $data[2]);
                $item = mysqli_real_escape_string($con, $data[3]);
                $ccy = mysqli_real_escape_string($con, $data[4]);
                $price = mysqli_real_escape_string($con, $data[5]);
                $pay_term = mysqli_real_escape_string($con, $data[6]);
                $supplier = mysqli_real_escape_string($con, $data[7]);
                $remarks = mysqli_real_escape_string($con, $data[8]);
                $query = "INSERT INTO `dwr`(`date`, `qty`, `uom`, `item`, `ccy`, `price`, `pay_term`, `supplier`, `remarks`) VALUES
                 ('$date','$qty','$uom','$item','$ccy','$price','$pay_term','$supplier','$remarks')";
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


if (isset($_POST["dwr_submit"])) {

    $date           = $_POST["date"];
    $qty            = $_POST["qty"];
    $uom            = $_POST["uom"];
    $item           = $_POST["item"];
    $ccy            = $_POST["ccy"];
    $price          = $_POST["price"];
    $pay_term       = $_POST["pay_term"];
    $supplier       = $_POST["supplier"];
    $remarks        = $_POST["remarks"];





    $addDWR = "INSERT INTO `dwr`(`date`, `qty`, `uom`, `item`, `ccy`, `price`, `pay_term`, `supplier`, `remarks`) VALUES
        ('$date','$qty','$uom','$item','$ccy','$price','$pay_term','$supplier','$remarks')";
    $fire = mysqli_query($con, $addDWR);
    if ($fire) {
        header('Location: DWR.php');
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
        header('Location: Add_dwr.php');
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
    <title>Add DWR</title>

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
                <h1>Add Daily Working Report</h1><br>
                <form method="POST" enctype="multipart/form-data" class="m-2">
                    <h2>Add CSV</h2>
                    <input type="file" name="dwr_csv" accept=".csv">
                    <button type="submit" name="upload" class="btn btn-info">Upload CSV</button><br>
                </form>

                <div class="container">
                    <?php echo $msg ?>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">

                        <div class="form-group d-block">
                            <label for="exampleInputName">Date</label>
                            <input type="date" class="datepicker form-control" data-date-format="yyyy/mm/dd" name="date">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Quantity</label>
                            <input type="text" name="qty" class="form-control" aria-describedby="emailHelp" placeholder="Enter Quantity" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">UOM</label>
                            <input type="text" name="uom" class="form-control" aria-describedby="emailHelp" placeholder="Enter UOM" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Item</label>
                            <input type="text" name="item" class="form-control" aria-describedby="emailHelp" placeholder="Enter Item" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">CCY</label>
                            <input type="ccy" name="ccy" class="form-control" aria-describedby="emailHelp" placeholder="Enter CCY" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Price</label>
                            <input type="text" name="price" class="form-control" aria-describedby="emailHelp" placeholder="Enter Price" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Payment Term</label>
                            <input type="text" name="pay_term" class="form-control" aria-describedby="emailHelp" placeholder="Enter Payment Term" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Supplier</label>
                            <input type="supplier" name="supplier" class="form-control" aria-describedby="emailHelp" placeholder="Enter Supp;ier" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Remarks</label>
                            <textarea name="remarks" cols="30" rows="10" class="form-control" aria-describedby="emailHelp" placeholder="Enter Remarks" required></textarea>
                        </div>
                        <button type="submit" name="dwr_submit" class="btn btn-primary mt-1">Submit</button>
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
        <script src="./Admin_Dashboard/Dashboard/vendor/select2/select2.min.js"></script>

        <!-- Main JS-->
        <script src="./Admin_Dashboard/Dashboard/js/main.js"></script>

</body>

</html>