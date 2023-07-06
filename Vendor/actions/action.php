<?php
session_start();
include("../../connectionredfield/conn.php");
/*--------------------------------------------------------------------------------------------------------*/
/*-----------------------------------------.Index Page.---------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------------*/
class reload extends dbcon{	
	public function checkOrderNotifications(){
		$result=mysqli_query($this->dbs, "
		    SELECT DISTINCT `OPI_cust_id` FROM `fbs_order` 
		    LEFT JOIN `orderedproductitems`
		    ON `order_jid`=`OPI_cust_id`
           	LEFT JOIN `fbs_products`
		    ON `OPI_Product_id`=`products_id`
		    WHERE `status`='not deliver' AND `vendor_id`='".@$_SESSION['ifbs4u_vendor_id']."'
		");
		
		  //  SELECT * FROM `fbs_order` 
		  //  LEFT JOIN `orderedproductitems`
		  //  ON ``=``
		  //  WHERE `status`='not deliver'
		$count=mysqli_num_rows($result);
		return $count;
	}
	public function productCategories(){
		$result=mysqli_query($this->dbs, "SELECT * FROM `fbs_category`");
		$count=mysqli_num_rows($result);
		return $count;
	}
	public function allProducts(){
		$result=mysqli_query($this->dbs, "SELECT * FROM `fbs_products` WHERE `vendor_id`='".@$_SESSION['ifbs4u_vendor_id']."'");
		$count=mysqli_num_rows($result);
		return $count;
	}
	public function ProductSolded(){
		$result=mysqli_query($this->dbs, "SELECT * FROM `orderedproductitems` WHERE `OPI_vendor_id`='".@$_SESSION['ifbs4u_vendor_id']."'");
		$count=mysqli_num_rows($result);
		return $count;
	}
}

/*--------------------------------------------------------------------------------------------------------*/
/*-----------------------------------------.Product Page.-------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------------*/
class products extends dbcon{
	// retrieve data function
	public function retrieve($filter){
		$op='';
		$result=mysqli_query($this->dbs, "SELECT * FROM `fbs_products` WHERE `cat_id`='".$filter."' AND `vendor_id`='".@$_SESSION['ifbs4u_vendor_id']."'");
		if($countresult=mysqli_num_rows($result)>0){
			$op.='
				<form id="update-products" class="form-group">
		            <table class="table table-responsive table-hover table-striped table-condensed">
		                <tr>
		                    <td>Products Name</td>
		                    <td>Products Price</td>
		                    <td>Stock</td>
		                    <td>Action</td>
		                </tr>
		        ';

			foreach ($result as $row) {
				$op.='
		                <tr>
		                    <td align="center">'.$row["products_name"].'<input type="hidden" id="productimage'.$row["products_id"].'" value="'.$row["products_imagename"].'"></td>
		                    <td align="center">'.$row["products_price"].' Rs/Kg<input type="text" id="updateprice'.$row["products_id"].'" class="form-control" placeholder="Enter products Price" value="'.$row["products_price"].'"></td>
		                    <td align="center">'.$row["products_status"].'
		                        <select class="form-control" id="status'.$row["products_id"].'">
		                            <option value="1" selected>Available</option>
		                            <option value="0">Not-Available</option>
		                        </select>
		                    </td>
		                    <td>
		                        <a id="'.$row["products_id"].'" class="updatebtn btn btn-success">Update</a>
		                        <a id="'.$row["products_id"].'" class="delbtn btn btn-danger" disabled>Delete</a>
		                    </td>
		                </tr>
		            ';
				
			}

			$op.='		
		            </table>
		        </form>
				';
		}else{
			$op.='
				<form id="update-products" class="form-group">
		        <table class="table table-responsive table-hover table-striped table-condensed">
		            <tr>
		                <td>Products Name</td>
		                <td>Products Price</td>
		                <td>Stock</td>
		                <td>Action</td>
		            </tr>
		    	';
			$op.="<tr><td colspan='4' align='center'>No Items Found!!</td></tr>";
			$op.='		
			        </table>
			    </form>
				';
		}
		return $op;
	}

	// add products function
	public function add($name,$image,$price,$unit,$cat_id,$pd_weight,$status){
			$qry=mysqli_query($this->dbs, "INSERT INTO 
				`fbs_products`(`cat_id`, `vendor_id`, `products_name`, `products_imagename`, `products_price`, `product_unit`, `products_weight`, `products_status`) 
				VALUES('".$cat_id."', '".$_SESSION['ifbs4u_vendor_id']."', '".$name."','".$image."','".$price."','".$unit."','".$pd_weight."','".$status."')");
			return $qry;		
	}	

	// update data function
	public function update($updateid,$updateprice,$updatestatus){
		$updateqry=mysqli_query($this->dbs, "UPDATE `fbs_products` SET `products_price`='".$updateprice."',`products_status`='".$updatestatus."' WHERE `products_id`='".$updateid."'");
		return $updateqry;
	}

	// search products function
	public function search($searchkeyword){
		$searchkeywordqry=mysqli_query($this->dbs, "SELECT * FROM `fbs_products` WHERE `products_name` LIKE '%".$searchkeyword."%' AND `vendor_id`='".@$_SESSION['ifbs4u_vendor_id']."'");
		$searchop='
			<form id="update-products" class="form-group">
	            <table class="table table-responsive table-hover table-striped table-condensed">
	                <tr>
	                    <td>Products Name</td>
	                    <td>Products Price</td>
	                    <td>Stock</td>
	                    <td>Action</td>
	                </tr>
	        ';

		foreach ($searchkeywordqry as $row) {
			$searchop.='
	                <tr>
	                    <td align="center">'.$row["products_name"].'<input type="hidden" id="productimage'.$row["products_id"].'" value="'.$row["products_imagename"].'"></td>
	                    <td align="center">'.$row["products_price"].' Rs/Kg<input type="text" id="updateprice'.$row["products_id"].'" class="form-control" placeholder="Enter products Price" value="'.$row["products_price"].'"></td>
	                    <td align="center">'.$row["products_status"].'
	                        <select class="form-control" id="status'.$row["products_id"].'">
	                            <option value="1" selected>Available</option>
	                            <option value="0">Not-Available</option>
	                        </select>
	                    </td>
	                    <td>
	                        <a id="'.$row["products_id"].'" class="updatebtn btn btn-success">Update</a>
	                        <a id="'.$row["products_id"].'" class="delbtn btn btn-danger" disabled>Delete</a>
	                    </td>
	                </tr>
	            ';
			
		}

		$searchop.='		
	            </table>
	        </form>
			';
		return $searchop;
	}
}

/*--------------------------------------------------------------------------------------------------------*/
/*---------------------------------.FROM HERE OBJECT'S AREA STARTED.--------------------------------------*/
/*--------------------------------------------------------------------------------------------------------*/

// fecth data from db in home page
if(isset($_POST["reload"])){
	
	$allproducts=new reload();
	$objproSolded=new reload();
	$checkOrdernot=new reload();
	$productcategores=new reload();
	$outcategories=$productcategores->productCategories();
	$ap=$allproducts->allProducts();
	$outobjproductSolded=$objproSolded->ProductSolded();
	$noc=$checkOrdernot->checkOrderNotifications();
	$op=array($outcategories,$ap,$outobjproductSolded,$noc);
	echo json_encode($op);
}

/*-----------------------------------------.Product Page.---------------------------------------------------*/
// retrive products from db
if(isset($_POST['loadproducts'])){
	$filter=$_POST['filter'];
	$objretrieve=new products();
	$jsonretrieve=$objretrieve->retrieve($filter);
	echo json_encode($jsonretrieve);
}

// insert products
if(isset($_POST["add_pro"])){
	// object creation of products class for add products
	$add=new products();
	
	// Posted value
	$name=$_POST['pdname'];
	$image=$_FILES['pdimage']['name'];
	$tmpname=$_FILES['pdimage']['tmp_name'];
	$price=$_POST['pdprice'];
	$unit=$_POST['unit'];
	$cat_id=$_POST['category'];
	// $vendor_id=$_POST['vendor_c'];
	$pd_weight=$_POST['pdweight'];
	$status=$_POST['status'];	
	$timgname=$name.' '.$image;
	if(empty($name) || empty($image) || empty($price)){
		echo "Don't empty these fields!!";
	}else{
		$imgupload=move_uploaded_file($tmpname, "../../Product_images/$timgname");
		if($imgupload){
			// function calling
			$sql=$add->add($name,$timgname,$price,$unit,$cat_id,$pd_weight,$status);
			if($sql){
				echo "Product's added!!";
			}else{
				echo "Hmmm!!! I found something Error on Adding Products...";
			}
		}else{
			echo "Hmmm!!! I found something Error on image upload";
		}
	}	
}

// update products from db
if(isset($_POST['update'])){
	$updateid=$_POST['product_id'];
	$updateprice=$_POST['product_price'];
	$updatestatus=$_POST['status'];
	$objupdate=new products();
	$jsonupdate=$objupdate->update($updateid,$updateprice,$updatestatus);
	if($jsonupdate){
		echo "yes";
	}else{
		echo "error";
	}
}

// search object field
if(isset($_POST['searchproducts'])){
	$searchkeyword=$_POST['search'];
	$searchobj=new products();
	$searchobjop=$searchobj->search($searchkeyword);
	echo $searchobjop;
}


?>