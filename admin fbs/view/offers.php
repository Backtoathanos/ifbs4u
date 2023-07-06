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
    <script type="text/javascript"> var infolinks_pid = 3167762; var infolinks_wsid = 0; </script> <script type="text/javascript" src="//resources.infolinks.com/js/infolinks_main.js"></script>
    <title>FBS ADMIN PANEL</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-3085682525857831",
    enable_page_level_ads: true
  });
</script>
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
                        <li><a href="Order.php" class="btn btn-primary">Check Orders</a></li>
                        <li><a href="offers.php" class="btn btn-info">Add Offers</a></li>
                        <li><a href="../actions/logout.php" class="btn btn-danger">Log Out</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- navbar end -->
      
    </div>
<!-- <script src="assets/js/bootstrap.min.js"></script> -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>