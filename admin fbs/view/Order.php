<?php
session_start();
if(empty(@$_SESSION['admin'])){
    header('location:../login.html');
}
?>
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/Article">
<head>
    <meta charset="UTF-8">
    <title>FBS ADMIN PANEL</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

<script type="text/javascript"> var infolinks_pid = 3167762; var infolinks_wsid = 0; </script> <script type="text/javascript" src="//resources.infolinks.com/js/infolinks_main.js"></script>
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
        <!-- category bar start -->
        <div class="row">
           <div class="btn-group">
                <a href="" id="confirm" class="btn btn-default">Order Status Check Kar</a>
                <a href="" id="paidbtn" class="btn btn-default">Poora Order Dekhega</a>
           </div>
       </div>
       <!-- end cat btn -->
       <div class="row">
        <h3 align="center"> Total Order</h3>
            <div id="diplay-order">
            </div>
       </div>
    </div>
<!-- <script src="assets/js/bootstrap.min.js"></script> -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>