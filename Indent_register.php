<?php

//connection
session_start();
error_reporting(0);
require_once("./config.php");
$msg = '';

if (!isset($_SESSION["admin_id"])) {
    header('Location: index.php');
}

// if (isset($_POST["upload"])) {
//     if ($_FILES["indent_doc"]["name"]) {
//         $name = $_FILES["indent_doc"]["name"];
//         $FinalFilePath = "./Upload/Admin/Indent/" . $name;
//         $path = "./Upload/Admin/Indent";
//         if (is_dir($path) === false) {
//             mkdir("./Upload/Admin/Indent");
//         }
//         $upload = move_uploaded_file($_FILES["indent_doc"]["tmp_name"], $FinalFilePath);
//         if ($upload) {

//             $addQuery = "INSERT INTO `indent_register`(`name`) VALUES ('$name')";
//             $fire = mysqli_query($con, $addQuery) or die("data not inserted " . mysqli_error($con));

//             if ($fire) {
//                 header('Location: Indent_register.php');
//             }
//         }
//     } else {
//         $msg = '<label class="text-danger">Invalid Doc File or Empty!!!</label>';
//     }
// }
if (isset($_POST['delete_btn'])) {
    $id = $_POST['del_id'];
    $query = "Delete from indent_register where id = '$id'";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
		echo "de";
        header('Location: Indent_register.php');
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Indent Register</title>

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
            <?php
            include 'Dash_topbar.php';
            ?>


            <div class="main-content">

                <div class="container-fluid">
                    <div class="row" id="Admin_Table">
                        <?php
                        $query = "Select * from indent_register";
                        $query_run = mysqli_query($con, $query);
                        $query_runs = mysqli_query($con, $query);

                        if(isset($_POST['submitss']))
                        {
                        $fromss = $_POST['frrooms'];
                        $toss = $_POST['ttwooo'];
                       $query1 = "SELECT * FROM indent_register WHERE indent_date BETWEEN '$fromss' AND '$toss'";
                       $query_run1 = mysqli_query($con, $query1);
                    }
                      if(isset($_POST['asc'])){
                        $fromss = $_POST['frrooms'];
                        $toss = $_POST['ttwooo'];
                       $query2 = "SELECT * FROM indent_register WHERE indent_date BETWEEN '$fromss' AND '$toss' ORDER BY indent_date ASC";
                       $query_run1 = mysqli_query($con, $query2);
                    }
                      if(isset($_POST['desc'])){
                        $fromss = $_POST['frrooms'];
                        $toss = $_POST['ttwooo'];
                       $query3 = "SELECT * FROM indent_register WHERE indent_date BETWEEN '$fromss' AND '$toss' ORDER BY indent_date DESC";
                       $query_run1 = mysqli_query($con, $query3);
                    }
                        ?>
                        <div class="col-lg-12">
                            <h2 class="title-1 m-b-25">Indent Register  <input type='button' id='printData' class="btn btn-success ml-5" value='Print' onclick='printData();'>
</h2>
                            <input class="form-control mr-sm-2 w-25 ml-lg-5 mt-lg-2 mb-lg-2 rounded pull-right" id="search" type="text" placeholder="Search" aria-label="Search" autocomplete="off">
                            <?php echo $msg ?>
                            <a href="Add_indent.php" class="btn btn-success pull-right m-2">Add Indent</a>

                            <form class="pull-right mr-5">
                                <div class="form-group row">
                                    <label for="BU" class="col-form-label">BUYER:</label>
                                    <input type="text" id="BU" name="BU" class="form-control col" placeholder="Enter Buyer Name"><br>
                                </div>
                                <div class="form-group row">
                                    <label for="STA" class="col-form-label">INDENT TYPE: <b>INDENT/PROFORMA</b> </label><br>
                                </div>
                            </form>

                            <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" class="col-3" style="float:left 20%;">
                          
                          <label for="">From</label><br>
                      <span><input class="form-control" type="date" name="frrooms" id='' placeholder="From" ></span>
                  
                          <label for="" style="margin-top:5px;">To</label>
                      <input class="form-control" type="date" name="ttwooo" id='' placeholder="To" style="margin-bottom:2%;">
                  
                      <div class="form-group"><button type="submit" name="submitss" class="btn btn-primary" style="margin-left:12%; margin-bottom:2%; margin-top:3%;" >Submit</button>
                      <button type="submit" name="asc" class="btn btn-primary" style="margin-bottom:2%; margin-top:3%;" >ASC</button>
                      <button type="submit" name="desc" class="btn btn-primary" style="margin-bottom:2%; margin-top:3%;" >DESC</button></div>
                      </form>


                            <br>
                            <div class="table-responsive table--no-card m-b-40">

                                <table id="printTable" class="table table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th colspan="2">INDENT NO</th>
                                            <th>BUYER</th>
                                            <th>ITEM</th>
                                            <th>QUANTITY</th>
                                            <th>PRICE</th>
                                            <th>VALUE</th>
                                            <th>HS.CODE</th>
                                            <th>PAYMENT TERM</th>
                                            <th>SHIPMENT</th>
                                            <th>INVOICE NO</th>
                                            <th>PO NO.</th>
                                            <th>INDENT DATE</th>
                                                    <th>SUPPLIER</th>
                                                    <th>ATTRIBUTE</th>
                                                    <th>INSTANCE</th>
                                                    <th>UOM </th>
                                                    <th>CURRENCY</th>
                                                    <th>SHIPMENT MODE</th>
                                                    <th>PAYMENT TERM</th>
                                                    <th>SHIPMENT MODE</th>
                                                    <th>DATE</th>
                                                    <th>EXPIRY DATE</th>
                                                    <th>INVOICE DATE</th>
                                                    <th>PO DATE</th>
											<th>Edit</th>
											<th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_data">
                                        <?php if (mysqli_num_rows($query_run1) > 0) {
                                            while ($row = mysqli_fetch_assoc($query_run1)) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td colspan="2"><?php echo $row['indent_no'] ?></td>
                                                    <td><?php echo $row['buyer'] ?></td>
                                                    <td><?php echo $row['item'] ?></td>
                                                    <td><?php echo $row['quantity'] ?></td>
                                                    <td><?php echo $row['price'] ?></td>
                                                    <td><?php echo $row['value'] ?></td>
                                                    <td><?php echo $row['hs_code'] ?></td>
                                                    <td><?php echo $row['pay_term'] ?></td>
                                                    <td><?php echo $row['shipment'] ?></td>
                                                    <td><?php echo $row['invoice_no'] ?></td>
                                                    <td><?php echo $row['po_no'] ?></td>
                                                    <td><?php echo $row['indent_date'] ?></td>
                                                    <td><?php echo $row['supplier'] ?></td>
                                                    <td><?php echo $row['attribute'] ?></td>
                                                    <td><?php echo $row['instance'] ?></td>
                                                    <td><?php echo $row['uom'] ?></td>
                                                    <td><?php echo $row['currency'] ?></td>
                                                    <td><?php echo $row['ship_mode'] ?></td>
                                                    <td><?php echo $row['payment_term'] ?></td>
                                                    <td><?php echo $row['shipment_mode'] ?></td>
                                                    <td><?php echo $row['date'] ?></td>
                                                    <td><?php echo $row['exp_date'] ?></td>
                                                    <td><?php echo $row['invoice_date'] ?></td>
                                                    <td><?php echo $row['po_date'] ?></td>
													<td id="delHide">																						                                                            
													<form id="editHide" action="edit_indent.php" method="post">
                                                                <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                                                <button type="submit"   name="edit_btn" class="btn btn-success">Edit</button>
                                                            </form>
															</td>
															<td id="delHide">
                                                            <form action="Indent_register.php" method="POST">
                                                                <input type="hidden" name="del_id" value="<?php echo $row['id']; ?>">
                                                                <button type="submit" name="delete_btn" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </td>
                                                </tr>
                                           
                                            
                                        <?php
                                        }
                                     }
                                     else if(mysqli_num_rows($query_run) > 0) {
                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                            ?>
                                            <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td colspan="2"><?php echo $row['indent_no'] ?></td>
                                            <td><?php echo $row['buyer'] ?></td>
                                            <td><?php echo $row['item'] ?></td>
                                            <td><?php echo $row['quantity'] ?></td>
                                            <td><?php echo $row['price'] ?></td>
                                            <td><?php echo $row['value'] ?></td>
                                            <td><?php echo $row['hs_code'] ?></td>
                                            <td><?php echo $row['pay_term'] ?></td>
                                            <td><?php echo $row['shipment'] ?></td>
                                            <td><?php echo $row['invoice_no'] ?></td>
                                            <td><?php echo $row['po_no'] ?></td>
                                            <td><?php echo $row['indent_date'] ?></td>
                                            <td><?php echo $row['supplier'] ?></td>
                                            <td><?php echo $row['attribute'] ?></td>
                                            <td><?php echo $row['instance'] ?></td>
                                            <td><?php echo $row['uom'] ?></td>
                                            <td><?php echo $row['currency'] ?></td>
                                            <td><?php echo $row['ship_mode'] ?></td>
                                            <td><?php echo $row['payment_term'] ?></td>
                                            <td><?php echo $row['shipment_mode'] ?></td>
                                            <td><?php echo $row['date'] ?></td>
                                            <td><?php echo $row['exp_date'] ?></td>
                                            <td><?php echo $row['invoice_date'] ?></td>
                                            <td><?php echo $row['po_date'] ?></td>
                                            <td id="delHide">																						                                                            
                                            <form id="editHide" action="edit_indent.php" method="post">
                                                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                                        <button type="submit"   name="edit_btn" class="btn btn-success">Edit</button>
                                                    </form>
                                                    </td>
                                                    <td id="delHide">
                                                    <form action="Indent_register.php" method="POST">
                                                        <input type="hidden" name="del_id" value="<?php echo $row['id']; ?>">
                                                        <button type="submit" name="delete_btn" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                        </tr>
                                    

                                    <?php
                                    }}
                                         else {
                                            echo "No Record Found!";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-2">
                    <label for="slc">CURRENCY:</label>
                    <select id="units" name="units">

                        <option value="saab"> USD </option>
                        <option value="mercedes"> RP </option>
                        <option value="audi"> INR </option>
                        <option value="audi"> AED </option>
                    </select><br>
                    <label for="AM"> AMOUNT: </label>
                    <input type="text" id="AM" name="AM"><br>
                    <label> UOM: </label>
                    <input type="text" id="UM" name="UM"><br>
                    <label> QUANTITY: </label>
                    <input type="text" id="QN" name="QN"><br>
                </div>
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

    <!-- Live Search -->
    <script>
	
	function printData()
{		
//		document.getElementById("printTable").style.border = "solid";
		$('table').css("border","1px solid #000");
		$('th').css("border","1px solid #000");
		$('td').css("border","1px solid #000");		
		
$('td:nth-child(13),td:nth-child(14),th:nth-child(13),th:nth-child(14)').hide();
		
		
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
   
   $("#actionHide").show();
   		$('table').css("border","0px");
		$('th').css("border","0px");
		$('td').css("border","0px");		
   $('td:nth-child(13),td:nth-child(14),th:nth-child(13),th:nth-child(14)').show();
}
	
        $("#search").on("keyup", function() {
            var search_term = $(this).val();
            $.ajax({
                url: "./Ajax_live_search.php",
                type: "POST",
                data: {
                    'search': search_term,
                    'table_name': 'indent_register'
                },
                success: function(data) {
                    $("#table_data").html(data);
                }
            });
        });
    </script>
</body>

</html>