<?php
session_start();
if(empty(@$_SESSION['ifbs4u_vendor_id'])){
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
                <h4 align="center">ifbs4u Vendor</h4>
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
                    <ul>
                        <li>Products
                            <ul>
                                <li><a href="view/Products.php" class="">Click Here to Add/Update Products</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!--sidebar end-->
            <!--fields start-->
            <div class="col-md-9">
                <div class="row">
                    <h3 align="center" id="welcome">Welcome <strong><?php echo @$_SESSION['ifbs4u_vendor_name']; ?></strong>. I know today is your day.<img id="emoji" src="view/assets/download.jpg"></h3>
                </div>
                <div class="fields">
                    <!--Line 1-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section">
                                <a href="#"><h4>We Have Total <strong id="categories">0</strong>  Nos Of Products Categories. You can see On Products Page During Adding Of Products. </h4></a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="section">
                                <a href="view/Products.php"><h4>Here is Total <strong id="aproducts">0</strong> Nos of Products Added By You. </h4></a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="section">
                                <a href="#"> <h4>And Total <strong id="psolded">0</strong> Nos of Products Solded From your Shop.</h4>
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