<?php
session_start();
if(empty($_SESSION['emp_id_for_sess_ifbs4u'])){
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
                                <span style="background: black;border-radius: 100%;margin: 5px;padding: 5px;" id="notificationcheckorder">0</span>
                            </a>
                        </li>
                        <li><a href="actions/logout.php" class="btn btn-danger logout">Log Out</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- navbar end -->
        <div class="row">
            <!--fields start-->
            <div class="col-md-9">
                <div class="row">
                    <h2 align="center" id="welcome">Welcome <strong><?php echo @$_SESSION['emp_name_for_sess_ifbs4u']; ?></strong>. I know today is your day.<img id="emoji" src="view/assets/download.jpg"></h2>
                </div>
                <div class="fields">
                    <!--Line 1-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section">
                                <a href="#"><h3>You had Delivered Total <strong id="tusers"></strong> Numbers of Orders Yet!!! </h3></a>
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