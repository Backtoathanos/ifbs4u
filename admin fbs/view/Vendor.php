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
                <form id="add-vendor" class="form-group">
                    <h2 align="center">Add Vendor</h2>
                    <table class="table table-responsive table-hover table-striped table-condensed">
                        <tr>
                            <td>Vendor's Name</td>
                            <td><input type="text" name="vdname" class="form-control" placeholder="Enter Vendor's name"></td>
                        </tr>
                        <tr>
                            <td>Vendor's Image</td>
                            <td><input type="file" name="vdimage" class="form-control" placeholder="Enter Vendor's image"></td>
                        </tr>
                        <tr>
                            <td>Vendor's Contact Person</td>
                            <td><input type="text" name="vdcontp" class="form-control" placeholder="Enter Vendor's Contact Person"></td>
                        </tr>
                        <tr>
                            <td>Vendor's Contact Number</td>
                            <td><input type="number" name="vdcontact" class="form-control" placeholder="Enter Vendor's Contact Number"></td>
                        </tr>
                        <tr>
                            <td>Vendor's Address</td>
                            <td><textarea name="vdaddress" class="form-control" placeholder="Enter Vendor's Address"></textarea> </td>
                        </tr>
                        </tr>
                        <tr>
                            <td><input type="hidden" name="addVendor"></td>
                            <td><input type="submit" class="btn btn-default btn-lg" value="Add Vendor"></td>
                        </tr>
                    </table>
                </form>
                <div id="out_vendor">
                </div>
            </div>
        <!-- </div>
        <div class="row"> -->
            <div class="col-sm-12">
                <div id="show_vendor">
                    
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