<?php
session_start();
require_once("./config.php");
if (!isset($_SESSION["admin_id"])) {
    header('Location: index.php');
}
if (isset($_GET['img'])) 
{
}

if (isset($_POST['update_btn'])) {
    $id = $_POST['edit_id'];
    $img = $_FILES['img']['name'];
    $image = $_POST['image'];
    $username = $_POST['edit_username'];
    $password = $_POST['edit_password'];
    $email = $_POST['edit_email'];

    if ($img != '') {

        $path = "./Upload/Admin/" . $image;
        unlink($path);
        //file
        $asFileName = $_FILES['img']['name'];
        //rplace space with "_"
        $asFileName = preg_replace("/\s+/", "_", $asFileName);
        $asFileTempName = $_FILES['img']['tmp_name'];
        $asFileSize = $_FILES['img']['size'];
        $asFileType = $_FILES['img']['type'];
        //for extension
        $asFileExt = pathinfo($asFileName, PATHINFO_EXTENSION);
        //for name without extension
        $asFileName = pathinfo($asFileName, PATHINFO_FILENAME);

        $modifiedName =  $asFileName . date("mjYHis") . "." . $asFileExt;
        $FinalFilePath = "./Upload/Admin/" . $modifiedName;
        $upload = move_uploaded_file($asFileTempName,   $FinalFilePath);

        if ($upload) {
            $addasignmentQuery = "UPDATE admins set image='$modifiedName',username='$username',password='$password',email='$email' where a_id='$id'";
            $fire = mysqli_query($con, $addasignmentQuery) or die("data not inserted " . mysqli_error($con));

            if ($fire) {
                header('Location: Edit_admin.php');
            }
        }
    } else {
        $addasignmentQuery = "UPDATE admins set username='$username',password='$password',email='$email' where a_id='$id'";
        $fire = mysqli_query($con, $addasignmentQuery) or die("data not inserted " . mysqli_error($con));

        if ($fire) {
            header('Location: Edit_admin.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./Admin_Dashboard/Dashboard/">
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Edit Admin</title>

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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3" style="background-color: black; border-radius : 4px;">
                            <h6 class="m-0 font-weight-bold text-primary" style="color:white!important; font-size: 20px">Edit Admin Profile</h6>
                        </div>
                        <div class="card-body">
                            <?php

                            require_once("./config.php");
                            if (isset($_POST['admin_edit_btn'])) {
                                $id = $_POST['admin_edit_id'];
                                $query = "SELECT * FROM admins where a_id ='$id'";
                                $query_run = mysqli_query($con, $query);
                                // echo $query_run;
                                // var_dump($query_run);
                                // die;
                                foreach ($query_run as $row) {

                            ?>
                                    <form action="Admin_edit.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['a_id']; ?>">
                                        <div class="form-group"><br>
                                            <label for="exampleInputName">Admin Image</label><br>
                                            <input type="file" name="img" aria-describedby="emailHelp" accept=".png, .jpg, .jpeg">
                                        </div>
                                        <div class="form-group">
                                            <img src="./Upload/Admin/<?php echo $row['image'] ?>" alt="" srcset="" style="width: 200px;height:200px;">
                                            <input type="hidden" name="image" value="<?php echo $row['image'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" name="edit_username" value="<?php echo $row['username'] ?>" class="form-control" placeholder="Enter Username">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="edit_password" value="<?php echo $row['password'] ?>" class="form-control" placeholder="Enter Password">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="edit_email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter Email">
                                        </div>
                                        <a href="Dashboard.php" class="btn btn-danger">Cancel</a>
                                        <button type="submit" name="update_btn" class="btn btn-primary">Update</button>
                                    </form>
                            <?php
                                }
                            }
                            ?>
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
</body>

</html>