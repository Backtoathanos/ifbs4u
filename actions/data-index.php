<?php include("../connectionredfield/conn.php"); ?>
<?php
session_start();
/*--------------------------------------------------------------------------------------------------------*/
/*-----------------------------------------.Reload Operation.--------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------------*/
class reload_operation extends dbcon{
   
     // category of product show
    public function reload_index_category($cat_type){
        $category_query=mysqli_query($this->dbs, "SELECT * FROM `fbs_products` WHERE `cat_id`='".$cat_type."' AND `products_status`='1' order by rand() LIMIT 4");
        return $category_query;
    }
}


/*-----------------------------------------.Product Page.---------------------------------------------------*/

// Juice
if(isset($_POST['juice_index'])){
    $cat_type=$_POST['juice_index'];
    $objretrieve=new reload_operation();
    $jsonretrieve=$objretrieve->reload_index_category($cat_type);
    if(mysqli_num_rows($jsonretrieve) > 0){
		while($row=mysqli_fetch_assoc($jsonretrieve)){
			echo '
			 <div class="col-sm-3 col-xs-6" >                  
                <div class="items-block-index" align="center">
                    <a href="Product Details.php?product_number='.$row["products_id"].'&product_category='.$row["cat_id"].'">
                        <img src="Product_images/'.$row["products_imagename"].'" width="90%"/><br />   
                        <h4 class="text-info" style="height:10%;"> '.$row["products_name"].'</h4>  
                    </a>  
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
            </div>  
			';
		}
	}else{
		echo "Products Empty";
	}
}

// veg
if(isset($_POST['veg_index'])){
    $cat_type=$_POST['veg_index'];
    $objretrieve=new reload_operation();
    $jsonretrieve=$objretrieve->reload_index_category($cat_type);
    if(mysqli_num_rows($jsonretrieve) > 0){
        while($row=mysqli_fetch_assoc($jsonretrieve)){
            echo '
             <div class="col-sm-3 col-xs-6">
                <a href="Product Details.php?product_number='.$row["products_id"].'&product_category='.$row["cat_id"].'">
                    <div class="items-block-index" align="center">  
                    <a href="Product Details.php?product_number='.$row["products_id"].'&product_category='.$row["cat_id"].'">
                        <img src="Product_images/'.$row["products_imagename"].'" width="90%"/><br />   
                        <h4 class="text-info" style="height:10%;"> '.$row["products_name"].'</h4>  
                    </a>
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
    }else{
        echo "Products Empty";
    }
}

// non veg
if(isset($_POST['non_veg_index'])){
   $cat_type=$_POST['non_veg_index'];
    $objretrieve=new reload_operation();
    $jsonretrieve=$objretrieve->reload_index_category($cat_type);
    if(mysqli_num_rows($jsonretrieve) > 0){
        while($row=mysqli_fetch_assoc($jsonretrieve)){
            echo '
             <div class="col-sm-3 col-xs-6" >  
                <div class="items-block-index" align="center">  
                <a href="Product Details.php?product_number='.$row["products_id"].'&product_category='.$row["cat_id"].'">
                    <img src="Product_images/'.$row["products_imagename"].'" width="90%"/><br />   
                    <h4 class="text-info" style="height:10%;"> '.$row["products_name"].'</h4>  
                </a>  
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
            </div>  
            ';
        }
    }else{
        echo "Products Empty";
    }
}

// fruits
if(isset($_POST['fruits_index'])){
    $cat_type=$_POST['fruits_index'];
    $objretrieve=new reload_operation();
    $jsonretrieve=$objretrieve->reload_index_category($cat_type);
    if(mysqli_num_rows($jsonretrieve) > 0){
        while($row=mysqli_fetch_assoc($jsonretrieve)){
            echo '
             <div class="col-sm-3 col-xs-6" >  
                <div class="items-block-index" align="center">  
                <a href="Product Details.php?product_number='.$row["products_id"].'&product_category='.$row["cat_id"].'">
                    <img src="Product_images/'.$row["products_imagename"].'" width="90%"/><br />   
                    <h4 class="text-info" style="height:10%;"> '.$row["products_name"].'</h4>  
                </a>  
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
            </div>  
            ';
        }
    }else{
        echo "Products Empty";
    }
}

// dryfruits
if(isset($_POST['dry_fruits_index'])){
    $cat_type=$_POST['dry_fruits_index'];
    $objretrieve=new reload_operation();
    $jsonretrieve=$objretrieve->reload_index_category($cat_type);
    if(mysqli_num_rows($jsonretrieve) > 0){
        while($row=mysqli_fetch_assoc($jsonretrieve)){
            echo '
             <div class="col-sm-3 col-xs-6" >  
                <div class="items-block-index" align="center">  
                <a href="Product Details.php?product_number='.$row["products_id"].'&product_category='.$row["cat_id"].'">
                    <img src="Product_images/'.$row["products_imagename"].'" width="90%"/><br />   
                    <h4 class="text-info" style="height:10%;"> '.$row["products_name"].'</h4>  
                </a>  
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
            </div>  
            ';
        }
    }else{
        echo "Products Empty";
    }
}
?>