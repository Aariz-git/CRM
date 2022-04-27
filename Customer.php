<?php

//connection
session_start();
require_once("./config.php");
$msg = '';

if (!isset($_SESSION["admin_id"])) {
    header('Location: index.php');
}

if (isset($_POST["upload"])) {
    if ($_FILES["customer_csv"]["name"]) {
        $filename = explode(".", $_FILES["customer_csv"]["name"]);
        if (end($filename) == "csv") {
            $handle = fopen($_FILES['customer_csv']['tmp_name'], "r");
            while ($data = fgetcsv($handle)) {

                $name = mysqli_real_escape_string($con, $data[0]);
                $email = mysqli_real_escape_string($con, $data[1]);
                $contact_person = mysqli_real_escape_string($con, $data[2]);
                $designation = mysqli_real_escape_string($con, $data[3]);
                $company_address = mysqli_real_escape_string($con, $data[4]);
                $company_tel = mysqli_real_escape_string($con, $data[5]);
                $cell_no = mysqli_real_escape_string($con, $data[6]);
                $query = "INSERT INTO `customer`(`customer_name`, `customer_email`, `contact_person`, `designation`, `company_address`, `company_tel`, `cell_number`) VALUES ('$name','$email',' $contact_person','$designation','$company_address','$company_tel','$cell_no')";
                $query_run = mysqli_query($con, $query);
                if($query_run){
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
    <title>Customer</title>

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
                        $query = "Select * from customer";
                        $query_run = mysqli_query($con, $query);
                        ?>
                        <div class="col-lg-12">
                            <h2 class="title-1 m-b-25">Customer <input type='button' id='printData' class="btn btn-success ml-5" value='Print' onclick='printData();'></h2>							
                            <form method="POST" enctype="multipart/form-data" class="pull-left m-2">
                                <input type="file" name="customer_csv" accept=".csv">
                                <button type="submit" name="upload" class="btn btn-info">Upload CSV</button>
                            </form>
                            <input class="form-control mr-sm-2 w-25 ml-lg-5 mt-lg-2 mb-lg-2 rounded pull-left" id="search" type="text" placeholder="Search" aria-label="Search" autocomplete="off" >							
                           
                            <a href="Add_customer.php" class="btn btn-success pull-right m-2" style="margin-top:20%;">Add Customer</a>
                           
                            <!-- <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" class="col-3" style="float:left 20%;">
                          
                                <label for="">From</label><br>
                            <span><input class="form-control" type="date" name="frrooms" id='' placeholder="From" ></span>
                        
                                <label for="" style="margin-top:5px;">To</label>
                            <input class="form-control" type="date" name="ttwooo" id='' placeholder="To" style="margin-bottom:2%;">
                        
                            <div class="form-group"><button type="submit" name="submitss" class="btn btn-primary" style="margin-left:12%; margin-bottom:2%; margin-top:3%;" >Submit</button>
                            <button type="submit" name="asc" class="btn btn-primary" style="margin-bottom:2%; margin-top:3%;" >ASC</button>
                            <button type="submit" name="desc" class="btn btn-primary" style="margin-bottom:2%; margin-top:3%;" >DESC</button></div>
                            </form> -->
                           
                           
                           <!-- <div style="margin-top:10px;"> -->
                            
                            <!-- </div> -->

                            




                            <?php echo $msg ?>
                            <div class="table-responsive table--no-card m-b-40">
                                <table id="printTable" class="table table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>Customer Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact Person</th>
                                            <th>Designation</th>
                                            <th>Company Address</th>
                                            <th>Company Telephone</th>
                                            <th>Cell Number</th>
											<th id="actionHide">Edit</th>
											<th >Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_data">
                                        <?php if (mysqli_num_rows($query_run) > 0) {
                                            while ($row = mysqli_fetch_assoc($query_run)) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['customer_id'] ?></td>
                                                    <td><?php echo $row['customer_name'] ?></td>
                                                    <td><?php echo $row['customer_email'] ?></td>
                                                    <td><?php echo $row['contact_person'] ?></td>
                                                    <td><?php echo $row['designation'] ?></td>
                                                    <td><?php echo $row['company_address'] ?></td>
                                                    <td><?php echo $row['company_tel'] ?></td>
                                                    <td><?php echo $row['cell_number'] ?></td>
																											<td >
                                                            <form id="editHide" action="EditCustomer.php" method="post">
                                                                <input type="hidden" name="Customer_edit_id" value="<?php echo $row['customer_id']; ?>">
                                                                <button type="submit"   name="Customer_edit_btn" class="btn btn-success">Edit</button>
                                                            </form>
                                                        </td>
																											<td id="delHide">
                                                            <form action="Dashboard.php" method="POST">
                                                                <input type="hidden" name="Customer_edit_id" value="<?php echo $row['customer_id']; ?>">
                                                                <button type="submit" name="Customer_delete_btn" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
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
		
		$('td:nth-child(9),td:nth-child(10),th:nth-child(9),th:nth-child(10)').hide();
		
		
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
   
   $("#actionHide").show();
   		$('table').css("border","0px");
		$('th').css("border","0px");
		$('td').css("border","0px");		
   $('td:nth-child(9),td:nth-child(10),th:nth-child(9),th:nth-child(10)').show();
}
            $("#search").on("keyup",function(){
                var search_term = $(this).val();
                $.ajax({
                    url: "./Ajax_live_search.php",
                    type: "POST",
                    data: {'search' : search_term, 'table_name': 'customer'},
                    success: function(data){
                        $("#table_data").html(data);
                    }
                });
            });
        </script>
</body>

</html>