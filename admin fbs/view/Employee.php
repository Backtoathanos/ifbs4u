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
        <!--add products start-->
        <div class="row">
            <div class="col-sm-12">
                <form id="add-Employee" class="form-group">
                    <h2 align="center">Add Employee</h2>
                    <table class="table table-responsive table-hover table-striped table-condensed">
                        <tr>
                            <td>Employee's Full Name</td>
                            <td><input type="text" name="empname" class="form-control" placeholder="Enter Employee's name"></td>
                        </tr>
                        <tr>
                            <td>Employee's Father's Name</td>
                            <td><input type="text" name="empfatname" class="form-control" placeholder="Enter Employee's name"></td>
                        </tr>
                         <tr>
                            <td>Employee's D.O.B</td>
                            <td><input type="date" class="form-control" name="empbirthday"></td>
                        </tr>
                        <tr>
                            <td>Employee's Pic</td>
                            <td><input type="file" name="empimage" class="form-control" placeholder="Enter Employee's Pic"></td>
                        </tr>
                        <tr>
                            <td>Employee's Contact Number</td>
                            <td><input type="number" name="empcontact" class="form-control" placeholder="Enter Employee's Contact Number"></td>
                        </tr>
                        <tr>
                            <td>Employee's About</td>
                            <td><textarea name="empaddress" class="form-control" placeholder="Enter Employee's About"></textarea> </td>
                        </tr>
                        </tr>
                        <tr>
                            <td><input type="hidden" name="addEmployee"></td>
                            <td><input type="submit" class="btn btn-default btn-lg" value="Add Employee"></td>
                        </tr>
                    </table>
                </form>
                <div id="out_Employee">
                </div>
            </div>
        <!-- </div>
        <div class="row"> -->
            <div class="col-sm-12">
                <div id="show_Employee">
                    
                </div>
            </div>
        </div>
        <!--add products end-->
    </div>
<!-- <script src="assets/js/bootstrap.min.js"></script> -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>