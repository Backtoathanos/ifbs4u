<?php
session_start();
if(empty(@$_SESSION['admin'])){
    header('location:../login.html');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FBS ADMIN PANEL</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <!-- header start -->
        <div class="header">
            <div class="row">
                <h2 align="center">FBS ADMIN PANEL</h2>
            </div>
        </div>
        <!--headers end-->
        <!--navbar start-->
        <div class="navbar">
            <div class="row">
                <nav class="navbar" id="this">
                    <ul class="nav navbar-nav group-btn">
                        <li><a href="../index.php" class="btn btn-success">Home</a></li>
                        <li>
                            <a href="Order.php" class="btn btn-primary">Check Orders
                                <span style="background: black;border-radius: 100%;margin: 5px;padding: 5px;" id="notificationcheckorder"></span>
                            </a>
                        </li>
                        <li><a href="offers.php" class="btn btn-info">Add Offers</a></li>
                        <li><a href="../actions/logout.php" class="btn btn-danger">Log Out</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- navbar end -->
        <!--add Category start-->
        <div class="row">
            <div class="col-sm-6">
                <form id="add-Category" class="form-group">
                    <h2 align="center">Add Category</h2>
                    <table class="table table-responsive table-hover table-striped table-condensed">
                        <tr>
                            <td>Category Name</td>
                            <td><input type="text" name="cdname" class="form-control" placeholder="Enter Category name"></td>
                        </tr>
                        <tr>
                            <td>Category Image</td>
                            <td><input type="file" name="cdimage" class="form-control" placeholder="Enter Category image"></td>
                        </tr>
                        </tr>
                        <tr>
                            <td><input type="hidden" name="addCategory"></td>
                            <td><input type="submit" class="btn btn-default btn-lg" value="Upload"></td>
                        </tr>
                    </table>
                </form>
            </div>
        <!--add Category end-->
    </div>
<!-- <script src="assets/js/bootstrap.min.js"></script> -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>