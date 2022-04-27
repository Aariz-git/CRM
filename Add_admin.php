<?php

//connection
session_start();
require_once("./config.php");
if (!isset($_SESSION["admin_id"])) {
    header('Location: index.php');
}

if (isset($_POST["Ad_submit"])) {

    $username   = $_POST["Ad_username"];
    $password   = $_POST["Ad_pass"];
    $email      = $_POST["Ad_email"];


    $check_query = mysqli_query($con, "Select * from admin where email = '$email'");
    $check = mysqli_num_rows($check_query);
    if ($check > 0 ) {
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

            // if ($nameValidation && $emailValidation && $passwordValidation) {

            $addasignmentQuery = "INSERT INTO `admins` (`image`, `username`, `password`, `email`) VALUES ('$modifiedName', '$username', '$password', '$email')";
            $fire = mysqli_query($con, $addasignmentQuery) or die("data not inserted " . mysqli_error($con));
        
            if ($fire) {
                header('Location: Edit_admin.php');
            }
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
    <title>Add Admin</title>

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

                <div class="container">

                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                        <h1>Add Admin</h1><br>
                        <div class="form-group">
                            <label for="exampleInputName">Admin Image</label><br>
                            <input type="file" name="img" aria-describedby="emailHelp" accept=".png, .jpg, .jpeg" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Admin Username</label>
                            <input type="text" name="Ad_username" class="form-control" aria-describedby="emailHelp" placeholder="Enter Username" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Admin Password</label>
                            <input type="text" name="Ad_pass" class="form-control" aria-describedby="emailHelp" placeholder="Enter Password" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Admin Email</label>
                            <input type="email" name="Ad_email" class="form-control" aria-describedby="emailHelp" placeholder="Enter Email" required>

                        </div>
                        <button type="submit" name="Ad_submit" class="btn btn-primary mt-1">Submit</button>
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
        <script src="./Admin_Dashboard/Dashboard/vendor/select2/select2.min.js">
        </script>

        <!-- Main JS-->
        <script src="./Admin_Dashboard/Dashboard/js/main.js"></script>
</body>

</html>