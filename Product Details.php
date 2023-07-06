<?php include "connectionredfield/db.php"; ?>
<?php  include("include/header.php"); ?>

<!-- product details page products sections -->
        <div class="row">   
            <div class="container">
                <div id="product-details-page-form">
                    <div id="pd_det_op" class="row">
                       <?php
                           if(isset($_GET['product_number'])){
                            $queryofproductdetails=mysqli_query($con, "SELECT * FROM `fbs_products` JOIN `fbs_vendors` ON `fbs_products`.`vendor_id`=`fbs_vendors`.`vendor_id` WHERE `products_id`='".$_GET['product_number']."'");
                            $fetchproductdetailssinglerow=mysqli_fetch_assoc($queryofproductdetails);
                            $checkname=$fetchproductdetailssinglerow["products_name"];
                                echo '
                                     <div class="col-sm-4">
                                        <div class="product-img-sec">
                                            <div class="product-img">
                                                <img src="Product_images/'.$fetchproductdetailssinglerow["products_imagename"].'">
                                            </div>
                                        </div>
                                        </div>  
                                        <div class="col-sm-5">
                                            <div class="product-description">

                                                <input type="hidden" name="hidden_name" id="name'.$fetchproductdetailssinglerow["products_id"].'" value="'.$fetchproductdetailssinglerow["products_name"].'" />
                                                <input type="hidden" name="hidden_name" id="product_vendor_id'.$fetchproductdetailssinglerow["products_id"].'" value="'.$fetchproductdetailssinglerow["vendor_id"].'" />    
                                                <input type="hidden" name="hidden_price" id="price'.$fetchproductdetailssinglerow["products_id"].'" value="'.$fetchproductdetailssinglerow["products_price"].'" />

                                                <h3>'.$fetchproductdetailssinglerow["products_name"].'</h3>
                                                <h4><i class="fas fa-rupee-sign"></i> '.$fetchproductdetailssinglerow["products_price"].'/'.$fetchproductdetailssinglerow["product_unit"].'</h4>
                                                <div style="width:200px;" class="form-group">
                                                    <select name="quantity" id="quantity'.$fetchproductdetailssinglerow["products_id"].'" class="form-control">
                                                        <option value="1">1 '.$fetchproductdetailssinglerow["product_unit"].'</option>
                                                        <option value="2">2 '.$fetchproductdetailssinglerow["product_unit"].'</option>
                                                        <option value="3">3 '.$fetchproductdetailssinglerow["product_unit"].'</option>
                                                        <option value="4">4 '.$fetchproductdetailssinglerow["product_unit"].'</option>
                                                        <option value="5">5 '.$fetchproductdetailssinglerow["product_unit"].'</option>
                                                    </select>
                                                </div>
                                                
                                                <a name="add_to_cart" id="'.$fetchproductdetailssinglerow["products_id"].'" style="margin-top:5px;"  class="btn btn-primary add_to_cart">ADD TO CART</a>
                                                <br>
                                                <p>COD Available, Delivery in 24 Business Hrs</p>
                                                <p>Easy Returns and Replacement</p>
                                                <p>Payment Options: (Only COD)</p>
                                            </div>
                                        </div>  
                                        <div class="col-sm-3">
                                            <div class="product-description">
                                                <div class="seller">
                                                    <p> SOLD BY :</p>
                                                    <h4>'.$fetchproductdetailssinglerow["vendor_name"].'</h4>
                                                    <h4>Jamshedpur</h4>

                                                    <p>4.2 (2) Reviews</p>
                                                    <a href="#'.$fetchproductdetailssinglerow["vendor_id"].'">Visit Seller Store</a>
                                                </div>
                                            </div>
                                        </div> 
                                    ';
                            


                            // <p>Color Family : Yellow + White + Black</p>
                            //                     <p>Size</p>
                            //                         <p>XS S M L XL</p>
                            //                     <p>Select Color : Yellow</p>
                           }
                       ?> 
                    </div>
                </div>
            </div>
        </div>

        <!-- Product similar to this -->
        <div class="row">   
            <div class="container">
                <div id="product-details-page-form">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 align="center">Product Similar to This!!</h2>
                            <?php
                               if(isset($_GET['product_category'])){
                                    $queryofproductdetails=mysqli_query($con, "SELECT * FROM `fbs_products` WHERE `cat_id`='".$_GET['product_category']."' AND `products_status`='1' order by rand() LIMIT 5");
                                    $row=mysqli_fetch_assoc($queryofproductdetails); 
                                    while($row=mysqli_fetch_assoc($queryofproductdetails)){                            
                                        echo '
                                                <div class="col-sm-3 col-xs-6">
                                                    <a href="Product Details.php?product_number='.$row["products_id"].'&product_category='.$row["cat_id"].'"> 
                                                        <div class="items-block-index" align="center">  
                                                        <img src="Product_images/'.$row["products_imagename"].'" width="90%"/><br />  
                                                        <h4 class="text-info" style="height:10%;"> '.$row["products_name"].'</h4>  
                                                        <h4 class="text-danger"><i class="fas fa-rupee-sign"></i> '.$row["products_price"].'/'.$row["product_unit"].'</h4> 
                                                        <select name="quantity" id="quantity'.$row["products_id"].'" class="form-control">
                                                            <option value="1">1 '.$row["product_unit"].'</option>
                                                            <option value="2">2 '.$row["product_unit"].'</option>
                                                            <option value="3">3 '.$row["product_unit"].'</option>
                                                            <option value="4">4 '.$row["product_unit"].'</option>
                                                            <option value="5">5 '.$row["product_unit"].'</option>
                                                        </select> 
                                                        <input type="hidden" name="hidden_name" id="name'.$row["products_id"].'" value="'.$row["products_name"].'" />
                                                        <input type="hidden" name="hidden_name" id="product_vendor_id'.$row["products_id"].'" value="'.$row["vendor_id"].'" />    
                                                        <input type="hidden" name="hidden_price" id="price'.$row["products_id"].'" value="'.$row["products_price"].'" />  
                                                        <input type="button" name="add_to_cart" id="'.$row["products_id"].'" style="margin-top:5px;" class="btn btn-success form-control add_to_cart" value="Add to Cart" />
                                                        </div>
                                                    </a>
                                                </div>
                                            ';
                                    
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php  include("include/footer.php"); ?>

