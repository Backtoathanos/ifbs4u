<?php
session_start();
if(empty(@$_SESSION['admin'])){
    header('location:login.html');
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="view/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="view/assets/css/style.css">
</head>
<body>
    <div class="container">
        <!-- header start -->
        <div class="header">
            <div class="row">
                <h2 align="center">IFBS4U ADMIN PANEL</h2>
            </div>
        </div>
        <!--headers end-->
        <!--navbar start-->
        <div class="navbar">
            <div class="row">
                <nav class="navbar" id="this">
                    <ul class="nav navbar-nav group-btn">
                        <li><a href="index.php" class="btn btn-success">Home</a></li>
                        <li>
                            <a href="view/Order.php" class="btn btn-primary">Check Orders
                                <span style="background: black;border-radius: 100%;margin: 5px;padding: 5px;" id="notificationcheckorder"></span>
                            </a>
                        </li>
                        <!-- <li><a href="view/offers.php" class="btn btn-info">Add Offers</a></li> -->
                        <li><a href="actions/logout.php" class="btn btn-danger logout">Log Out</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- navbar end -->
        <div class="row">
            <!--sidebar start-->
            <div class="col-md-3">
                <div class="sidebar">
                    <ul><li>Category
                            <ul>
                                <li><a href="view/Category.php" class="">Add Category</a></li>
                            </ul>
                        </li>
                        <li>Products
                            <ul>
                                <li><a href="view/Products.php" class="">View Products</a></li>
                            </ul>
                        </li>
                        <li>Vendors
                            <ul>
                                <li><a href="view/Vendor.php" class="">Add Vendors</a></li>
                            </ul>
                        </li>
                        <li>Employees
                            <ul>
                                <li><a href="view/Employee.php" class="">Add Employees</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!--sidebar end-->
            <!--fields start-->
            <div class="col-md-9">
                <div class="row">
                    <h2 align="center" id="welcome">Welcome <strong><?php echo @$_SESSION['admin_name']; ?></strong>. I know today is your day.<img id="emoji" src="view/assets/download.jpg"></h2>
                </div>
                <div class="fields">
                    <!--Line 1-->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="section">
                                <a href="#"><h3>Total Users :- <strong id="tusers"></strong></h3></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="section">
                                <a href="#"><h3>Total Viewers :- <strong id="viewers">Soon</strong></h3></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="section">
                                <a href="#"><h3>Regular Customers :-  <strong id="rcustomers">NA</strong></h3></a>
                            </div>
                        </div>
                    </div>
                    <!--Line 2-->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="section">
                                <a href="#"><h3>Total Categories :- <strong id="categories">NA</strong></h3></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="section">
                                <a href="view/Products.php"><h3>Total Products :- <strong id="aproducts"></strong></h3></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="section">
                                <a href="#"> <h3>Products Sold :- <strong id="psolded">NA</strong></h3>
                            </div>
                        </div>
                    </div>
                    <!--Line 3-->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="section">
                                <a href="view/Vendor.php"><h3>Our Vendors :- <strong id="vendors"></strong></h3></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="section">
                                <a href="#"><h3>Our Employees :- <strong id="employees"></strong></h3></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="section">
                                <a href="#"><h3>Our Branch :- <strong id="branch"></strong></h3></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--fields end-->
        </div>
        <!--show data start-->
        <div class="row">
            <div id="show-data">

            </div>
        </div>
    </div>
<!-- <script src="view/assets/js/bootstrap.min.js"></script> -->
<script src="view/assets/js/jquery.min.js"></script>
<script src="view/assets/js/main.js"></script>
</body>
</html>