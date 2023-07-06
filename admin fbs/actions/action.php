<?php
include("../../connectionredfield/conn.php");
/*--------------------------------------------------------------------------------------------------------*/
/*-----------------------------------------.Index Page.---------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------------*/
class reload extends dbcon{	
	public function checkOrderNotifications(){
		$result=mysqli_query($this->dbs, "SELECT * FROM `fbs_order` WHERE `status`='unconfirm' AND `order_emp_id`='0'");
		$count=mysqli_num_rows($result);
		return $count;
	}
	public function allUser(){
		$result=mysqli_query($this->dbs, "SELECT * FROM `fbs_signup`");
		$count=mysqli_num_rows($result);
		return $count;
	}
	public function regularCustomer(){
		$result=mysqli_query($this->dbs, "SELECT * FROM `fbs_customer` HAVING `customer_phone` > 1");
		$count=mysqli_num_rows($result);
		return $count;
	}
	public function productCategories(){
		$result=mysqli_query($this->dbs, "SELECT * FROM `fbs_category`");
		$count=mysqli_num_rows($result);
		return $count;
	}
	public function allProducts(){
		$result=mysqli_query($this->dbs, "SELECT * FROM `fbs_products`");
		$count=mysqli_num_rows($result);
		return $count;
	}
	public function ProductSolded(){
		$result=mysqli_query($this->dbs, "SELECT DISTINCT `OPI_Product_id` FROM `orderedproductitems`");
		$count=mysqli_num_rows($result);
		return $count;
	}
	public function vendors(){
		$result=mysqli_query($this->dbs, "SELECT * FROM `fbs_vendors`");
		$count=mysqli_num_rows($result);
		return $count;
	}
	public function employees(){
		$result=mysqli_query($this->dbs, "SELECT * FROM `fbs_employees`");
		$count=mysqli_num_rows($result);
		return $count;
	}
	public function branch(){
		$result=mysqli_query($this->dbs, "SELECT * FROM `fbs_branch`");
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
		$status='';
		$result=mysqli_query($this->dbs, "SELECT * FROM `fbs_products` LEFT JOIN `fbs_vendors` ON `fbs_products`.`vendor_id`=`fbs_vendors`.`vendor_id` WHERE `cat_id`='".$filter."'");
		$op='
			<form id="update-products" class="form-group">
	            <table class="table table-responsive table-hover table-striped table-condensed">
	                <tr>
	                    <td>Products Image</td>
	                    <td>Products Name</td>
	                    <td>Products Price</td>
	                    <td>Stock</td>
	                    <td>Uploaded By Vendor Name</td>
	                    <td>Action</td>
	                </tr>
	        ';

		foreach ($result as $row) {
			if($row["products_status"]=='1'){
				$status='<label style="background-color:green;padding:5px;">Available</label>';
			}else{
				$status='<label style="background-color:red;padding:5px;">Unavailable</label>';
			}
			$op.='
	                <tr>
	                    <td align="center" width="15%>
	                		<div id="apimgt"><img src="../../Product_images/'.$row["products_imagename"].'" width="100%" height="150px" /></div>
	                	</td>
	                    <td align="center">'.$row["products_name"].'<input type="hidden" id="productimage'.$row["products_id"].'" value="'.$row["products_imagename"].'"></td>
	                    <td align="center">'.$row["products_price"].' Rs/Kg</td>
	                    <td align="center">'.$status.'</td>
	                    <td align="center">'.$row["vendor_name"].'</td>
	                    <td>
	                        
	                        <a id="'.$row["products_id"].'" class="delbtn btn btn-danger">Delete</a>
	                    </td>
	                </tr>
	            ';
			
		}

		$op.='		
	            </table>
	        </form>
			';
		return $op;
	}

	// add products function
	public function add($name,$image,$price,$unit,$cat_id,$vendor_id,$status){
			$qry=mysqli_query($this->dbs, "INSERT INTO 
				`fbs_products`(`cat_id`, `vendor_id`, `products_name`, `products_imagename`, `products_price`, `product_unit`, `products_status`) 
				VALUES('".$cat_id."', '".$vendor_id."', '".$name."','".$image."','".$price."','".$unit."','".$status."')");
			return $qry;		
	}	

	// update data function
	public function update($updateid,$updateprice,$updatestatus){
		$updateqry=mysqli_query($this->dbs, "UPDATE `fbs_products` SET `products_price`='".$updateprice."',`products_status`='".$updatestatus."' WHERE `products_id`='".$updateid."'");
		return $updateqry;
	}

	// delete products function
	public function delete($deleteid){
		$deleteqry=mysqli_query($this->dbs, "DELETE FROM `fbs_products` WHERE `products_id`='".$deleteid."'");
		return $deleteqry;
	}

	// search products function
	public function search($searchkeyword){
		$status='';
		$searchkeywordqry=mysqli_query($this->dbs, "SELECT * FROM `fbs_products` LEFT JOIN `fbs_vendors` ON `fbs_products`.`vendor_id`=`fbs_vendors`.`vendor_id` WHERE `products_name` LIKE '%".$searchkeyword."%'");
		$searchop='
			<form id="update-products" class="form-group">
	            <table class="table table-responsive table-hover table-striped table-condensed">
	                <tr>
	                	<td>Products Image</td>
	                    <td>Products Name</td>
	                    <td>Products Price</td>
	                    <td>Stock</td>
	                    <td>Uploaded By Vendor Name</td>
	                    <td>Action</td>
	                </tr>
	        ';

		foreach ($searchkeywordqry as $row) {
			if($row["products_status"]=='1'){
				$status='<label style="background-color:green;padding:5px;">Available</label>';
			}else{
				$status='<label style="background-color:red;padding:5px;">Unavailable</label>';
			}

			$searchop.='
	                <tr>
	                	<td align="center" width="15%>
	                		<div id="apimgt"><img src="../../Product_images/'.$row["products_imagename"].'" width="100%" height="150px" /></div>
	                	</td>
	                    <td align="center">'.$row["products_name"].'<input type="hidden" id="productimage'.$row["products_id"].'" value="'.$row["products_imagename"].'"></td>
	                    <td align="center">'.$row["products_price"].' Rs/Kg</td>
	                    <td align="center">'.$status.'</td>
	                    <td align="center">'.$row["vendor_name"].'</td>
	                    <td>
	                        
	                        <a id="'.$row["products_id"].'" class="delbtn btn btn-danger">Delete</a>
	                    </td>
	                </tr>
	            ';
	            // <a id="'.$row["products_id"].'" class="updatebtn btn btn-success">Update</a>
			
		}

		$searchop.='		
	            </table>
	        </form>
			';
		return $searchop;
	}
}

/*--------------------------------------------------------------------------------------------------------*/
/*-----------------------------------------.Vendor Page.--------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------------*/

class Vendor extends dbcon{	
	public function addVendor($name,$image,$contactperson,$contact,$address,$strippeduname,$strippedpassword){
		$qry=mysqli_query($this->dbs, "INSERT INTO `fbs_vendors`(`vendor_name`, `vendor_image`, `venodr_contact_person`, `vendor_contact`, `vendor_address`, `vendor_uname`, `vendor_password`) VALUES ('".$name."','".$image."','".$contactperson."','".$contact."','".$address."','".$strippeduname."','".$strippedpassword."')");
		return $qry;
	}

	// delete Vendor function
	public function delete($deleteid){
		$deleteqry=mysqli_query($this->dbs, "DELETE FROM `fbs_vendors` WHERE `vendor_id`='".$deleteid."'");
		return $deleteqry;
	}

	public function show_vendor(){
		$result=mysqli_query($this->dbs, "SELECT * FROM `fbs_vendors`");
		$op='
			<h3 align="center">All Vendors</h3>
			<form id="show-vendors" class="form-group">
	            <table class="table table-responsive table-hover table-striped table-condensed">
	                <tr>
	                    <td>Vendor Id</td>
	                    <td>Vendor Image</td>
	                    <td>Vendor Name</td>
	                    <td>Vendor Contact No</td>
	                    <td>Vendor Address</td>
	                    <td>Action</td>
	                </tr>
	        ';

		foreach ($result as $row) {
			$op.='
	                <tr>
	                    <td align="center">'.$row["vendor_id"].'</td>
	                    <td align="center"><img style="height: 105px;width: 105px;" src="../../Vendor_images/'.$row["vendor_image"].'"><input type="hidden" id="productimage'.$row["vendor_id"].'" value="'.$row["vendor_image"].'"></td>
	                    <td align="center">'.$row["vendor_name"].'</td>
	                    <td align="center">'.$row["vendor_contact"].'</td>
	                    <td align="center">'.$row["vendor_address"].'</td>
	                    <td>
	                        <a id="'.$row["vendor_id"].'" class="vendordelbtn btn btn-danger">Delete</a>
	                    </td>
	                </tr>
	            ';
			
		}

		$op.='		
	            </table>
	        </form>
			';
		return $op;
	}
}

class Category extends dbcon{	
	public function addCategory($name,$image){
		$qry=mysqli_query($this->dbs, "INSERT INTO `fbs_category`(`category_name`, `img_name`) VALUES ('".$name."','".$image."')");
		return $qry;
	}
}

class Employee extends dbcon{	
	public function addemployee($name,$empfatname,$empbirthday,$image,$contact,$about,$strippedempuname,$strippedemppassword){
		$qry=mysqli_query($this->dbs, "INSERT INTO `fbs_employees`(`emp_name`, `emp_fathername`, `emp_dob`, `emp_pic`, `emp_uname`, `emp_password`, `empcontact`, `emp_notes`) VALUES ('".$name."','".$empfatname."','".$empbirthday."','".$image."','".$strippedempuname."','".$strippedemppassword."','".$contact."','".$about."')");
		return $qry;
	}

	// delete Vendor function
	public function deleteemployee($deleteid){
		$deleteqry=mysqli_query($this->dbs, "DELETE FROM `fbs_employees` WHERE `empid`='".$deleteid."'");
		return $deleteqry;
	}

	public function show_employee(){
		$result=mysqli_query($this->dbs, "SELECT * FROM `fbs_employees`");
		$op='
			<h3 align="center">All Employee</h3>
			<form id="show-vendors" class="form-group">
	            <table class="table table-responsive table-hover table-striped table-condensed">
	                <tr>
	                    <td>Employee Id</td>
	                    <td>Employee Image</td>
	                    <td>Employee Name</td>
	                    <td>Employee Contact No</td>
	                    <td>Employee Address</td>
	                    <td>Action</td>
	                </tr>
	        ';

		foreach ($result as $row) {
			$op.='
	                <tr>
	                    <td align="center">'.$row["empid"].'</td>
	                    <td align="center"><img style="height: 105px;width: 105px;" src="../../Employee_images/'.$row["emp_pic"].'"><input type="hidden" id="productimage'.$row["empid"].'" value="'.$row["emp_pic"].'"></td>
	                    <td align="center">'.$row["emp_name"].'</td>
	                    <td align="center">'.$row["empcontact"].'</td>
	                    <td align="center">'.$row["emp_notes"].'</td>
	                    <td>
	                        <a id="'.$row["empid"].'" class="empdelbtn btn btn-danger">Delete</a>
	                    </td>
	                </tr>
	            ';
			
		}

		$op.='		
	            </table>
	        </form>
			';
		return $op;
	}
}

/*--------------------------------------------------------------------------------------------------------*/
/*---------------------------------.FROM HERE OBJECT'S AREA STARTED.--------------------------------------*/
/*--------------------------------------------------------------------------------------------------------*/

// fecth data from db in home page
if(isset($_POST["reload"])){
	
	$allusers=new reload();
	$regularcustomer=new reload();
	$allproducts=new reload();
	$objproSolded=new reload();
	$vendors=new reload();
	$employees=new reload();
	$branch=new reload();
	$checkOrdernot=new reload();
	$productcategores=new reload();
	$au=$allusers->allUser();
	$rc=$regularcustomer->regularCustomer();
	$outcategories=$productcategores->productCategories();
	$ap=$allproducts->allProducts();
	$outobjproductSolded=$objproSolded->ProductSolded();
	$vendors=$allusers->vendors();
	$employees=$regularcustomer->employees();
	$branch=$allproducts->branch();

	$noc=$checkOrdernot->checkOrderNotifications();
	$op=array($au,$rc,$ap,$vendors,$employees,$branch,$noc,$outcategories,$outobjproductSolded);
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
	$vendor_id=$_POST['vendor_c'];
	$status=$_POST['status'];	
	$timgname=$name.' '.$image;
	if(empty($name) || empty($image) || empty($price)){
		echo "Don't empty these fields!!";
	}else{
		$imgupload=move_uploaded_file($tmpname, "../../Product_images/$timgname");
		if($imgupload){
			// function calling
			$sql=$add->add($name,$timgname,$price,$unit,$cat_id,$vendor_id,$status);
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

// delete products from db
if(isset($_POST['delete'])){
	$deleteid=$_POST['product_id'];
	$pdimage=$_POST['pdimage'];
	$delete=unlink('../../Product_images/'.$pdimage);
	if($delete){
		$objdelete=new products();
		$jsondelete=$objdelete->delete($deleteid);
		if($jsondelete){
			echo "deleted";
		}else{
			echo "Products can't Deleted.";
		}
	}else{
		echo "Image Can't Deleted";
	}
}


// search object field
if(isset($_POST['searchproducts'])){
	$searchkeyword=$_POST['search'];
	$searchobj=new products();
	$searchobjop=$searchobj->search($searchkeyword);
	echo $searchobjop;
}

/*-----------------------------------------.Vendor Page.--------------------------------------------------*/
 // fecth data from db in home page
if(isset($_POST["show_vendor"])){	
	$objshow_vendor=new Vendor();
	$sv=$objshow_vendor->show_vendor();
	echo $sv;
}
// insert Vendor
if(isset($_POST["addVendor"])){
	// object creation of products class for add products
	$add=new Vendor();
	
	// Posted value
	$name=$_POST['vdname'];
	$image=$_FILES['vdimage']['name'];
	$tmpname=$_FILES['vdimage']['tmp_name'];
	$contactperson=$_POST['vdcontp'];
	$contact=$_POST['vdcontact'];
	$address=$_POST['vdaddress'];

	$strippeduname = '@'.preg_replace('/\s/', '', $name);
	$strippedpassword = preg_replace('/\s/', '', $name);


	if(empty($name) || empty($image) || empty($contact)){
		echo "Don't empty these fields!!";
	}else{
		$imgupload=move_uploaded_file($tmpname, "../../Vendor_images/$image");
		if($imgupload){
			// function calling
			$sql=$add->addVendor($name,$image,$contactperson,$contact,$address,$strippeduname,$strippedpassword);
			if($sql){
				echo '<label class="label label-success">Congrats!!! Your Vendor is added.</label><br>
				<label class="label label-danger">Please Note Vendor Username And Passwords Below!</label><br>
				<label class="label label-info">Username : '.$strippeduname.'</label><br>
				<label class="label label-info">Password : '.$strippedpassword.'</label>';
			}else{
				echo "Hmmm!!! I found something wrong on Adding Vendor..";
			}
		}else{
			echo "Hmmm!!! I found something wrong on image upload";
		}
	}	
}
// delete vendor
// delete products from db
if(isset($_POST['deletevendor'])){
	$deleteid=$_POST['product_id'];
	$pdimage=$_POST['pdimage'];
	$delete=unlink('../../Vendor_images/'.$pdimage);
	if($delete){
		$objdelete=new Vendor();
		$jsondelete=$objdelete->delete($deleteid);
		if($jsondelete){
			echo "Vendor Deleted!";
		}else{
			echo "Vendor can't Deleted.";
		}
	}else{
		echo "Vendor Image Can't Deleted";
	}
}

/*-----------------------------------------.Category Page.--------------------------------------------------*/
// Add Cateory Objects
if(isset($_POST["addCategory"])){
	// object creation of products class for add Category
	$add=new Category();
	
	// Posted value
	$name=$_POST['cdname'];
	$image=$_FILES['cdimage']['name'];
	$tmpname=$_FILES['cdimage']['tmp_name'];
	if(empty($name) || empty($image) ){
		echo "Don't empty these fields!!";
	}else{
		$imgupload=move_uploaded_file($tmpname, "../../include/assets/images/$image");
		if($imgupload){
			// function calling
			$sql=$add->addCategory($name,$image);
			if($sql){
				echo "Category added!!";
			}else{
				echo "Hmmm!!! I found something Error on Adding Category..";
			}
		}else{
			echo "Hmmm!!! I found something Error on image upload";
		}
	}	
}


/*-----------------------------------------.Employee Page.--------------------------------------------------*/
// fecth data from db in home page
if(isset($_POST["show_employee"])){	
	$objshow_vendor=new Employee();
	$sv=$objshow_vendor->show_employee();
	echo $sv;
}
// insert employee
if(isset($_POST["addEmployee"])){
	// object creation of products class for add products
	$add=new Employee();
	
	// Posted value
	$name=$_POST['empname'];
	$empfatname=$_POST['empfatname'];
	$empbirthday=$_POST['empbirthday'];
	$image=$_FILES['empimage']['name'];
	$tmpname=$_FILES['empimage']['tmp_name'];
	$contact=$_POST['empcontact'];
	$about=$_POST['empaddress'];

	$strippedempuname = '@'.preg_replace('/\s/', '', $name);
	$strippedemppassword = preg_replace('/\s/', '', $contact);


	if(empty($name) || empty($image) || empty($contact)){
		echo "Don't empty these fields!!";
	}else{
		$imgupload=move_uploaded_file($tmpname, "../../Employee_images/$image");
		if($imgupload){
			// function calling
			$sql=$add->addemployee($name,$empfatname,$empbirthday,$image,$contact,$about,$strippedempuname,$strippedemppassword);
			if($sql){
				echo '<label class="label label-success">Congrats!!! Your Employee is added to ifbs4u.</label><br>
				<label class="label label-danger">Please Note Employee Username & Passwords Below!</label><br>
				<label class="label label-info">Username : '.$strippedempuname.'</label><br>
				<label class="label label-info">Password : '.$strippedemppassword.'</label>';
			}else{
				echo "Hmmm!!! I found something wrong on Adding Employee..";
			}
		}else{
			echo "Hmmm!!! I found something wrong on image upload";
		}
	}	
}
// delete employee
if(isset($_POST['deleteemployee'])){
	$deleteid=$_POST['product_id'];
	$pdimage=$_POST['pdimage'];
	$delete=unlink('../../Employee_images/'.$pdimage);
	if($delete){
		$objdelete=new Employee();
		$jsondelete=$objdelete->deleteemployee($deleteid);
		if($jsondelete){
			echo "Employee Deleted!";
		}else{
			echo "Employee can't Deleted.";
		}
	}else{
		echo "Employee Image Can't Deleted";
	}
}

?>