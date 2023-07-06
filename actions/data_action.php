<?php include("../connectionredfield/conn.php"); ?>

<?php
session_start();
/* --------------------------------------------------------Class Area------------------------------------------------------- */
class reload_operation extends dbcon{
    // category of product show
    public function show_proucts_category(){
        $category_query=mysqli_query($this->dbs, "SELECT * FROM `fbs_category`");
        return $category_query;
    }

    // retrieve products in products page
    public function Product_reload($product_category){
        $product_query=mysqli_query($this->dbs, "SELECT * FROM `fbs_products` WHERE `cat_id`='$product_category' AND `products_status`='1' ORDER BY RAND()");
        return $product_query;
    }

    public function search_Product_reload($products_name){
        $product_query=mysqli_query($this->dbs, "SELECT * FROM `fbs_products` WHERE `products_name` LIKE '%".$products_name."%' AND `products_status`='1'");
        return $product_query;
    }
}

/* --------------------------------------------------------Object Area------------------------------------------------------- */

// retrieve products
if (isset($_POST['nav_category'])) {
    $nav_op='';
    $objretrieve=new reload_operation();
    $opretrieve=$objretrieve->show_proucts_category();
    if(mysqli_num_rows($opretrieve) > 0){
        while($row=mysqli_fetch_assoc($opretrieve)){
            $nav_op.= '
                    <li><a href="product.php?cat='.$row["category_id"].'">'.$row["category_name"].'</a></li>             
                    ';
        }
    }else{
        $nav_op.= "No Category Found!!!";
    }
    echo json_encode($nav_op);
}

// index page categor show
if (isset($_POST['index_category'])) {
    $index_op='';
    $objretrieve=new reload_operation();
    $opretrieve=$objretrieve->show_proucts_category();
    if(mysqli_num_rows($opretrieve) > 0){
        while($row=mysqli_fetch_assoc($opretrieve)){
            $cat_id=$row['category_id'];
            $cat_name=$row['category_name'];
            $cat_image=$row['img_name'];

            $index_op.= '
                        <div class="col-sm-2 col-xs-3 Home-pro">
                            <a href="product.php?cat='.$row["category_id"].'">                      
                                <div class="col-sm-12" "="">
                                    <div class="main-category-unit">
                                        <img class="home-img" src="include/assets/images/'.$cat_image.'">
                                    </div>
                                </div>
                                <div class="col-sm-12"><h3 class="text-center">'.$cat_name.'</h3></div>
                            </a>    
                        </div>
                        ';
        }

    }else{
        $index_op.= "No Category Found!!!";
    }
    echo json_encode($index_op);
}

// retrieve products
if (isset($_POST['product_category'])) {
    $product_category=$_POST['product_category'];
    $objretrieve=new reload_operation();
    $jsonretrieve=$objretrieve->Product_reload($product_category);
    if(mysqli_num_rows($jsonretrieve) > 0){
        while($row=mysqli_fetch_assoc($jsonretrieve)){
            echo '
             <div class="col-md-3" >  
                <div class="items-block" align="center">
                <a href="Product Details.php?product_number='.$row["products_id"].'&product_category='.$row["cat_id"].'">
                    <img src="Product_images/'.$row["products_imagename"].'" width="90%" height="50%" /><br />  
                    <h4 class="text-info" style="height:10%;"> '.$row["products_name"].'</h4>  
                </a>
                <h4 class="text-danger"><i class="fas fa-rupee-sign"></i> '.$row["products_price"].'/'.$row["product_unit"].'</h4> 
                <select name="quantity" id="quantity'.$row["products_id"].'" class="form-control">
                    <option value="1" selected>1 '.$row["product_unit"].'</option>
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
            </div>  
            ';
        }
    }else{
        echo "No Products Found!!!";
    }
}

// search products header
if(isset($_POST['search_product'])){
    $products_name=$_POST['search_products_name'];
    $objretrieve=new reload_operation();
    $jsonretrieve=$objretrieve->search_Product_reload($products_name);
    if(mysqli_num_rows($jsonretrieve) > 0){
        while($row=mysqli_fetch_assoc($jsonretrieve)){

            echo '
                <div class="col-sm-12 form-group">
                    <div class="col-sm-3">
                        <img src="Product_images/'.$row["products_imagename"].'" width="10%" height="50%" />
                    </div>
                    <div class="col-sm-3">
                        <h4 class="text-info" style="height:10%;"> '.$row["products_name"].'</h4>  
                        <h4 class="text-danger"><i class="fas fa-rupee-sign"></i> '.$row["products_price"].'/'.$row["product_unit"].'</h4>
                    </div>
                    <div class="col-sm-3">
                        <select name="quantity" id="quantity'.$row["products_id"].'" class="form-control" style="margin-top:10px;">
                            <option value="1" selected>1 '.$row["product_unit"].'</option>
                            <option value="2">2 '.$row["product_unit"].'</option>
                            <option value="3">3 '.$row["product_unit"].'</option>
                            <option value="4">4 '.$row["product_unit"].'</option>
                            <option value="5">5 '.$row["product_unit"].'</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <input type="hidden" name="hidden_name" id="name'.$row["products_id"].'" value="'.$row["products_name"].'" /> 
                        <input type="hidden" name="hidden_name" id="product_vendor_id'.$row["products_id"].'" value="'.$row["vendor_id"].'" />   
                        <input type="hidden" name="hidden_price" id="price'.$row["products_id"].'" value="'.$row["products_price"].'" />  
                        <a name="add_to_cart" id="'.$row["products_id"].'" style="margin-top:5px;font-size:35px;" class="btn btn-dfault add_to_cart "><i class="fa fa-shopping-cart"></i></a>
                    </div>
                </div>
            ';
        }
    }else{
        echo "Sorry we Don't have ".$products_name;
    }
}

// search products
if(isset($_POST['find_product'])){
    $products_name=ucwords($_POST['products_name']);
    $objretrieve=new reload_operation();
    $jsonretrieve=$objretrieve->search_Product_reload($products_name);
    if(mysqli_num_rows($jsonretrieve) > 0){
        while($row=mysqli_fetch_assoc($jsonretrieve)){
            echo '
             <div class="col-md-3" >  
                <div class="items-block" align="center">  
                <img src="Product_images/'.$row["products_imagename"].'" width="90%" height="50%" /><br />  
                <h4 class="text-info" style="height:10%;"> '.$row["products_name"].'</h4>  
                <h4 class="text-danger"><i class="fas fa-rupee-sign"></i> '.$row["products_price"].'/'.$row["product_unit"].'</h4> 
                <select name="quantity" id="quantity'.$row["products_id"].'" class="form-control">
                    <option value="1" selected>1 '.$row["product_unit"].'</option>
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
            </div>  
            ';
        }
    }else{
        echo "No Products Found!!!";
    }
}


?>