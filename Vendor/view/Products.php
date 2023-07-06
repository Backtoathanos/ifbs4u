<?php
session_start();
include("../../connectionredfield/db.php");
if(empty(@$_SESSION['ifbs4u_vendor_id'])){
    header('location:../login.html');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ifbs4u Vendors</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <!-- header start -->
        <div class="header">
            <div class="row">
                <h2 align="center">ifbs4u Vendor</h2>
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
                        <!-- <li><a href="offers.php" class="btn btn-info">Add Offers</a></li> -->
                        <li><a href="../actions/logout.php" class="btn btn-danger">Log Out</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- navbar end -->
        <!--add products start-->
        <div class="row">
            <div class="col-sm-9">
                <a href="#" id="forshowHideproductform">Want to Add Products</a>
                <form id="add-products" class="form-group" enctype="multipart/form-data">
                    <h2 align="center">Add Products</h2>
                    <table class="table table-responsive table-hover table-striped table-condensed">
                        <tr>
                            <td>Product's Name</td>
                            <td><input type="text" name="pdname" class="form-control" placeholder="Enter product's name"></td>
                        </tr>
                        <tr>
                            <td>Product's Image</td>
                            <td><input type="file" name="pdimage" class="form-control" placeholder="Enter product's image"></td>
                        </tr>
                        <tr>
                            <td>Product's Price</td>
                            <td><input type="number" name="pdprice" class="form-control" placeholder="Enter product's price"></td>
                        </tr>
                        <tr>
                            <td>Product's Unit</td>
                            <td>
                                <select name="unit" class="form-control">
                                    <option value="Pkt" selected>Pkt</option>
                                    <option value="Bundle">Bundle</option>
                                    <option value="Kg">Kg</option>
                                    <option value="Ltr">Ltr</option>
                                    <option value="ML">ML</option>
                                    <option value="Nos">NOS</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Product's Category</td>
                            <td>
                                <select name="category" class="form-control">
                                    <?php 
                                        // Fetch Category of Products
                                        $sql_category = "SELECT * FROM `fbs_category`";
                                        $category_data = mysqli_query($con,$sql_category);
                                        while($row = mysqli_fetch_assoc($category_data) ){
                                           $category_id = $row['category_id'];
                                           $category_name = $row['category_name'];
                                           
                                           // Option
                                           echo "<option value='".$category_id."' >".$category_name."</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Product's Weight</td>
                            <td><input type="text" name="pdweight" class="form-control" placeholder="Enter product's Weight. For ex 2.4 "></td>
                        </tr>
                        <tr>
                            <td>Product's Status</td>
                            <td>
                                <select name="status" class="form-control">
                                    <option value="1">Available</option>
                                    <option value="0">Not-Available</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="hidden" name="add_pro"></td>
                            <td><input type="submit" class="btn btn-default btn-lg" name="" value="Add Product"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="progress">
                                    <div class="progress-bar"></div>
                                    <div id="uploadStatus"></div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <!--add products end-->
        <div class="row" id="search-d">
            <h2 align="center">Update or Change Products Price</h2>
            <!--search fields start-->
               <div class="row">
                    <form class="form-group">
                        <div class="col-md-2">
                            <label>Find By Product's Name</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="search-data" name="searchproduct" class="form-control" placeholder="Find with product's name">
                        </div>
                        <div class="col-md-2">
                            <label>Or By Categories</label>
                        </div>
                        <div class="form-group col-md-3">
                            <select name="category" id="filterSelect" class="form-control">
                                <?php 
                                // Fetch Category of Products
                                $sql_category = "SELECT * FROM `fbs_category`";
                                $category_data = mysqli_query($con,$sql_category);
                                while($row = mysqli_fetch_assoc($category_data) ){
                                   $category_id = $row['category_id'];
                                   $category_name = $row['category_name'];
                                   
                                   // Option
                                   echo "<option value='".$category_id."' >".$category_name."</option>";
                                }
                            ?>
                            </select>
                        </div>
                    </form>
               </div>
               <div class="row" id="search-field">
               </div>
            <!--search fields end-->
        </div>
        <!--update and delete products start-->
                        
        <!-- <div class="row">
            <div id="updatedfields">
                
            </div>
        </div> -->
        <!--update and delete products end-->
    </div>
<!-- <script src="assets/js/bootstrap.min.js"></script> -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>