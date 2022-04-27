<?php

//connection
session_start();
require_once("./config.php");
error_reporting(0);

if (!isset($_SESSION["admin_id"])) {
    header('Location: index.php');
}
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

if (isset($_POST['delete_btn'])) {
    $id = $_POST['del_id'];
    $query = "Delete from dwr where id = '$id'";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
		echo "de";
        header('Location: DWR.php');
	}
}

                          
// if(isset($_POST['submitss']))
//   {
//       // $con=mysqli_connect("localhost", "root","", "ecommerce_db");
//       $fromss = $_POST['froms'];
//       $toss = $_POST['tooo'];
//       $query = "SELECT * FROM dwr WHERE date BETWEEN '$fromss' AND '$toss'";
//       $query_run1 = mysqli_query($con, $query);
//        if($query_run1){
//         echo ".<h1 class='text-danger'>working</h1>.";
//        }
//        else{
//            echo ".<h1 style='color:black'>error</h1>.";
//        }

//   } 
//   else{
//       echo "not Working";
//   }

//

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
    <title>DWR</title>

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


</head>

<body class="animsition">
    <div class="page-wrapper">
        <?php
        include 'Admin_nav.php';
        ?>
        <div class="page-container">
            <?php include 'Dash_topbar.php'; ?>


            <div class="main-content">

                <div class="container-fluid">
                    <div class="row" id="Admin_Table">
                    <?php
                        $query = "Select * from dwr";
                        $query_run = mysqli_query($con, $query);

                        if(isset($_POST['submitss']))
                        {
                        $fromss = $_POST['frrooms'];
                        $toss = $_POST['ttwooo'];
                       $query1 = "SELECT * FROM dwr WHERE date BETWEEN '$fromss' AND '$toss'";
                       $query_run1 = mysqli_query($con, $query1);
                    }
                      if(isset($_POST['asc'])){
                        $fromss = $_POST['frrooms'];
                        $toss = $_POST['ttwooo'];
                       $query2 = "SELECT * FROM dwr WHERE date BETWEEN '$fromss' AND '$toss' ORDER BY date ASC";
                       $query_run1 = mysqli_query($con, $query2);
                    }
                      if(isset($_POST['desc'])){
                        $fromss = $_POST['frrooms'];
                        $toss = $_POST['ttwooo'];
                       $query3 = "SELECT * FROM dwr WHERE date BETWEEN '$fromss' AND '$toss' ORDER BY date DESC";
                       $query_run1 = mysqli_query($con, $query3);
                    }
                        ?>
                        <div class="col-lg-12">
                            <h2 class="title-1 m-b-25">Daily Working Report <input type='button' id='printData' class="btn btn-success ml-5" value='Print' onclick='printData();'></h2>

                            <a href="Add_dwr.php" class="btn btn-success pull-right m-2">Add Proposal</a>
                            <!-- SELECT * FROM `dwr` WHERE date BETWEEN '2021-10-24' AND '2021-10-27' -->
                            <span><input class="form-control mr-sm-2 w-25 ml-lg-5 mt-lg-2 mb-lg-2 rounded pull-right d-block" id="search" type="text" placeholder="Search" aria-label="Search" autocomplete="off"></span><br>
                            <!-- <span><input class="form-control mr-sm-12 w-25 mr-lg-12 mr-md-9 m-lg-2 rounded pull-right d-block" style="margin-left:10px;" id="search" type="text" placeholder="Search" aria-label="Search" autocomplete="off"></span><br> -->

                            <!-- <center> -->
                            <!-- <div class="col-6" style="float:right 10px;"> -->
                            <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" class="col-3" style="float:left;">
                            <!-- <div class="col-6"> -->
                                <label for="">From</label><br>
                            <span><input class="form-control" type="date" name="frrooms" id='' placeholder="From" ></span>
                            <!-- </div> -->
                            <!-- <div class="col-6"> -->
                                <label for="" style="margin-top:5px;">To</label>
                            <input class="form-control" type="date" name="ttwooo" id='' placeholder="To" style="margin-bottom:2%;">
                            <!-- </div> -->
                            <!-- <div class="col-6"> -->
                            <div class="form-group"><button type="submit" name="submitss" class="btn btn-primary" style="margin-left:12%; margin-bottom:2%; margin-top:3%;" >Submit</button>
                            <button type="submit" name="asc" class="btn btn-primary" style="margin-bottom:2%; margin-top:3%;" >ASC</button>
                            <button type="submit" name="desc" class="btn btn-primary" style="margin-bottom:2%; margin-top:3%;" >DESC</button></div>
                            </form>
                            <!-- </div> -->

                            
                            <!-- <div class="col-3" style="margin-left:10%;"></div>
                    <div class="col-3">
                    <form action="/search" method="get">
                    <div class="form-group"  >
                    <input type="date" name="search" class="pull-right m-2" placeholder="From">
                    <input type="date" name="search" class="pull-right m-2" style="float:left;margin-right:6rem;margin-bottom:5px;padding-left:11%;padding-right:11%" placeholder="To">

                    </div>

                    </div>
                    <div class="col-3"><div class="form-group-btn">
                    <button type="submit" class="btn btn-primary" style="float:right;margin-right:6rem;margin-bottom:5%;padding-left:11%;padding-right:11%;">Search</button>
                    </div>

                    </form>
                    </div>

                    </div> -->

                            <!-- </center> --> 
                            <form class="pull-right ml-2" style="margin-top:2%; margin-right:170px;">
                                <div class="form-group row">
                                    <label for="customer" class="col-form-label">Customer : </label>
                                    <input type="text" class="form-control col" id="inputEmail3" placeholder="Enter Customer">
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-form-label">Address :</label>
                                    <input type="text" class="form-control col" id="inputEmail3" placeholder="Enter Address">
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="comments" class="col-form-label">Comments :</label>
                                    <input type="text" class="form-control col" id="inputEmail3" placeholder="Enter Comments">
                                    
                                </div>
                            </form>

                            <div class="table-responsive table--no-card m-b-40">
                                  <table id="printTable" class="table table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Date</th>
                                            <th>Quantity</th>
                                            <th>UOM</th>
                                            <th>Item</th>
                                            <th>CCY</th>
                                            <th>Price</th>
                                            <th>Payment Term</th>
                                            <th>Supplier</th>
                                            <th>Remarks History</th>
											<th>Edit</th>
											<th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_data">
                                        <?php if (mysqli_num_rows($query_run1) > 0) {
                                            while ($row2 = mysqli_fetch_assoc($query_run1)) {
                                    ?>
                                    <tr>
                                                    <td><?php echo $row2['id'] ?></td>
                                                    <td><?php echo $row2['date'] ?></td>
                                                    <td><?php echo $row2['qty'] ?></td>
                                                    <td><?php echo $row2['uom'] ?></td>
                                                    <td><?php echo $row2['item'] ?></td>
                                                    <td><?php echo $row2['ccy'] ?></td>
                                                    <td><?php echo $row2['price'] ?></td>
                                                    <td><?php echo $row2['pay_term'] ?></td>
                                                    <td><?php echo $row2['supplier'] ?></td>
                                                    <td><?php echo $row2['supplier'] ?></td>
													<td id="delHide">
														<form id="editHide" action="view_dwr.php" method="post">
                                                                <input type="hidden" name="view_id" value="<?php echo $row2['id']; ?>">
                                                                <button type="submit"   name="view_btn" class="btn btn-primary">View</button>
                                                            </form>
															</td>	
                                                    <td id="delHide">
														<form id="editHide" action="edit_dwr.php" method="post">
                                                                <input type="hidden" name="edit_id" value="<?php echo $row2['id']; ?>">
                                                                <button type="submit"   name="edit_btn" class="btn btn-success">Edit</button>
                                                            </form>
															</td>
															<td id="delHide">
                                                            <form action="DWR.php" method="POST">
                                                                <input type="hidden" name="del_id" value="<?php echo $row2['id']; ?>">
                                                                <button type="submit" name="delete_btn" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </td>
                                                </tr>
                                                <tr>
                                                    <th>Remarks:</th>
                                                    <td colspan="8"><?php echo $row2['remarks'] ?></td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                        else if (mysqli_num_rows($query_run) > 0) {
                                            while ($row = mysqli_fetch_assoc($query_run)) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['date'] ?></td>
                                                    <td><?php echo $row['qty'] ?></td>
                                                    <td><?php echo $row['uom'] ?></td>
                                                    <td><?php echo $row['item'] ?></td>
                                                    <td><?php echo $row['ccy'] ?></td>
                                                    <td><?php echo $row['price'] ?></td>
                                                    <td><?php echo $row['pay_term'] ?></td>
                                                    <td><?php echo $row['supplier'] ?></td>
                                                    <td id="delHide">
														<form id="editHide" action="view_dwr.php" method="post">
                                                                <input type="hidden" name="view_id" value="<?php echo $row['id']; ?>">
                                                                <button type="submit"   name="view_btn" class="btn btn-primary">View</button>
                                                            </form>
															</td>
														<td id="delHide">
														<form id="editHide" action="edit_dwr.php" method="post">
                                                                <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                                                <button type="submit"   name="edit_btn" class="btn btn-success">Edit</button>
                                                            </form>
															</td>
															<td id="delHide">
                                                            <form action="DWR.php" method="POST">
                                                                <input type="hidden" name="del_id" value="<?php echo $row['id']; ?>">
                                                                <button type="submit" name="delete_btn" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </td>
                                                </tr>
                                                <tr>
                                                    <th>Remarks:</th>
                                                    <td colspan="8"><?php echo $row['remarks'] ?></td>
                                                </tr>
                                        <?php
                                            }
                                        }
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
		
$('td:nth-child(10),td:nth-child(11),th:nth-child(10),th:nth-child(11)').hide();
		
		
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
   
   $("#actionHide").show();
   		$('table').css("border","0px");
		$('th').css("border","0px");
		$('td').css("border","0px");		
   $('td:nth-child(10),td:nth-child(11),th:nth-child(10),th:nth-child(11)').show();
}
		
            $("#search").on("keyup", function() {
                var search_term = $(this).val();
                $.ajax({
                    url: "./Ajax_live_search.php",
                    type: "POST",
                    data: {
                        'search': search_term,
                        'table_name': 'dwr'
                    },
                    success: function(data) {
                        $("#table_data").html(data);
                    }
                });
            });
        </script>
</body>

</html>