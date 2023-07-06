<?php
session_start();
require_once "../../connectionredfield/conn.php";
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
        <!-- category bar start -->
       <div class="row">
           <div id="">
<?php
class order extends dbcon{

	public function actiononOrder($order_id){
		$totalprice='';
		$out_product_items='';
		$out_products_weight='';
		$product_details_result=mysqli_query($this->dbs, "
														SELECT * 
														FROM `fbs_order` 
														JOIN `orderedproductitems` 
														ON `fbs_order`.`ordered_on`=`orderedproductitems`.`OPI_order_on`
														JOIN `fbs_products` 
														ON `fbs_products`.`products_id`=`orderedproductitems`.`OPI_Product_id`
														JOIN `fbs_vendors` 
														ON `fbs_vendors`.`vendor_id`=`orderedproductitems`.`OPI_vendor_id`
														WHERE `fbs_order`.`order_id` = '".$order_id."'
														");
		$sl=1;
		$countorderforcountqtyprice=mysqli_num_rows($product_details_result);
		if($countorderforcountqtyprice>0){
			foreach ($product_details_result as $row) {
				$totalprice+=$row['OPI_Product_price'] * $row['OPI_qty'];
				$out_product_items.= $sl . ') ' .
				'<span style="font-size: 15px;font-weight: bolder;color: red;">'.$row['products_name'].' = '.$row['OPI_qty'].' '.$row['product_unit'].'</span>,'.
				' From 
				<span style="font-size: 15px;font-weight: bolder;color: red;">'.$row['vendor_name'].'</span>
				 Shop, Contact - 
				<span style="font-size: 15px;font-weight: bolder;color: red;">'.$row['vendor_contact'].'</span>
				, Address - 
				<span style="font-size: 15px;font-weight: bolder;color: red;">'.$row['vendor_address'].'</span><br>';
				$out_products_weight+=$row['products_weight'] * $row['OPI_qty'];
				$sl++;
			}
		}

		$result=mysqli_query($this->dbs, "
			SELECT * FROM `fbs_order` JOIN `fbs_customer` ON `order_jid`=`jid` JOIN `fbs_employees` ON `empid`=`order_emp_id` WHERE `order_id`= '".$order_id."'
			");
		$op='
			<table align="right" class="table table-bordered table-responsive">
				<thead>
					<th colspan="2">Order</th>
				</thead>
			';
			$countorder=mysqli_num_rows($result);
		if($countorder>0){
			foreach ($result as $row) {
				if($row['status']=='unpaid'){
					$paidbtn='
							<tr>
								<td colspan="2">
									<a class="btn btn-warning paid" id="'.$row["order_id"].'" name="confirm">Paid</a>
								</td>
							</tr>
					';
				}else{
					$paidbtn='';
				}
				$op.='
					<form class="customer_order_not_deliver">
						<tbody >
							<tr>
								<td>Customer Name</td>
								<td>
								'.$row['customer_firstName'].' '.$row['customer_lastName'].'
								<input type="hidden" value="'.$row['order_id'].'" name="oid">
								</td>	
							</tr>
							<tr>
								<td>Customer Contact Number</td>
								<td>'.$row['customer_phone'].'</td>
							</tr>
							<tr>
								<td>Customer Address</td>
								<td>'.$row['customer_address'].'-'.$row['customer_pincode'].'</td>
							</tr>
							<tr>
								<td>Ordered On</td>
								<td>'.$row['ordered_on'].'</td>
							</tr>
							<tr>
								<td>Deliver Boy Name</td>
								<td>
								'.$row['emp_name'].'
								</td>	
							</tr>
							<tr>
								<td>Deliver Boy Contact Number</td>
								<td>'.$row['empcontact'].'</td>
							</tr>
							<tr>
								<td>Total Price </td>
								<td>'.$totalprice.' Rs</td>
							</tr>
							<tr>
								<td>Weight </td>
								<td>'.$out_products_weight.' Kg</td>
							</tr>
							<tr>
								<td>Items</td>
								<td>
									'.$out_product_items.'
								</td>
							</tr>
							<tr>
								<td>Status</td>
								<td><label class="btn btn-info">Not Delivered Yet!!</label></td>
							</tr>
							'.$paidbtn.'
							
						</tbody>
					</form>
				';
				
			}
		}else{
			$op.='<tr><td colspan="10">Oops!! no order for confirm..</td></tr>';
		}
		$op.='
			</table>
			';
		return $op;
	}	

	public function setEmployeetoOrder($empid,$order_id){
		$out='';
		$qry=mysqli_query($this->dbs, "
			UPDATE `fbs_order` 
			SET `order_emp_id`='".$empid."', `status`='not deliver' WHERE `order_id`='$order_id'
			");
		if($qry){
			// $out.="Success";
		}else{
			$out.="Something Wrong in Emp to Product!";
		}
		return $out;
	}

	public function viewEmployeetoOrder($setorder_id,$empid){
		$totalprice='';
		$out_product_items='';
		$out_products_weight='';
		$product_details_result=mysqli_query($this->dbs, "
														SELECT * 
														FROM `fbs_order` 
														JOIN `orderedproductitems` 
														ON `fbs_order`.`ordered_on`=`orderedproductitems`.`OPI_order_on`
														JOIN `fbs_products` 
														ON `fbs_products`.`products_id`=`orderedproductitems`.`OPI_Product_id`
														JOIN `fbs_vendors` 
														ON `fbs_vendors`.`vendor_id`=`orderedproductitems`.`OPI_vendor_id`
														WHERE `order_id` = '".$setorder_id."' AND `status`='not deliver'
														");
		$sl=1;
		$countorderforcountqtyprice=mysqli_num_rows($product_details_result);
		if($countorderforcountqtyprice>0){
			foreach ($product_details_result as $row) {
				$totalprice+=$row['OPI_Product_price'] * $row['OPI_qty'];
				$out_product_items.= $sl . ') ' .
				'<span style="font-size: 15px;font-weight: bolder;color: red;">'.$row['products_name'].' = '.$row['OPI_qty'].' '.$row['product_unit'].'</span>,'.
				' From 
				<span style="font-size: 15px;font-weight: bolder;color: red;">'.$row['vendor_name'].'</span>
				 Shop, Contact - 
				<span style="font-size: 15px;font-weight: bolder;color: red;">'.$row['vendor_contact'].'</span>
				, Address - 
				<span style="font-size: 15px;font-weight: bolder;color: red;">'.$row['vendor_address'].'</span><br>';
				$out_products_weight+=$row['products_weight'] * $row['OPI_qty'];
				$sl++;
			}
		}

		$result=mysqli_query($this->dbs, "
			SELECT * FROM `fbs_order` JOIN `fbs_customer` ON `order_jid`=`jid` WHERE `order_id`= '".$setorder_id."' AND `status`='not deliver' AND `order_emp_id`= '".$empid."'
			");
		$op='
			<table align="right" class="table table-bordered table-responsive">
				<thead>
					<th colspan="2">Order</th>
				</thead>
			';
			$countorder=mysqli_num_rows($result);
		if($countorder>0){
			foreach ($result as $row) {
				$op.='
					<form class="customer_order_not_deliver">
						<tbody >
							<tr>
							<td>Person Name</td>
								<td>
								'.$row['customer_firstName'].' '.$row['customer_lastName'].'
								<input type="hidden" value="'.$row['order_id'].'" name="oid">
								</td>	
							</tr>
							<tr>
								<td>Contact Number</td>
								<td>'.$row['customer_phone'].'</td>
							</tr>
							<tr>
								<td>Address</td>
								<td>'.$row['customer_address'].'-'.$row['customer_pincode'].'</td>
							</tr>
							<tr>
								<td>Ordered On</td>
								<td>'.$row['ordered_on'].'</td>
							</tr>
							<tr>
								<td>Total Price </td>
								<td>'.$totalprice.'</td>
							</tr>
							<tr>
								<td>Weight </td>
								<td>'.$out_products_weight.' Kg</td>
							</tr>
							<tr>
								<td>Items</td>
								<td>
									'.$out_product_items.'
								</td>
							</tr>
							<tr>
								<td>Status</td>
								<td>'.$row['status'].'</td>
							</tr>
							<tr>
								<td colspan="2">
									<input type="submit" class="btn btn-warning paid" id="'.$row["order_id"].'" name="paid" value="Delivered">
									<a href="" class="btn btn-warning cancel" id="'.$row["order_id"].'" name="confirm">Cancel</a>
								</td>
							</tr>
						</tbody>
					</form>
				';
				
			}
		}else{
			$op.='<tr><td colspan="10">Oops!! no order for confirm..</td></tr>';
		}
		$op.='
			</table>
			';
		return $op;
	}
}


if(isset($_GET['order_id'])){
	$order_id=$_GET['order_id'];
	$objorder=new order();
	$opobj=$objorder->actiononOrder($order_id);
	echo $opobj;
}

if(isset($_GET['emp_id'])){
	$order_id=$_GET['order_id'];
	$empid=$_GET['emp_id'];
	$objorder=new order();
	$opobj=$objorder->setEmployeetoOrder($empid,$order_id);
	echo $opobj;
}

if(isset($_GET['set_order_id'])){
	$setorder_id=$_GET['set_order_id'];
	$empid=$_GET['set_emp_id'];
	$objorder=new order();
	$opobj=$objorder->viewEmployeetoOrder($setorder_id,$empid);
	echo $opobj;
}

?>
           </div>
       </div>
       <!-- category bar end -->
       <div id="diplay-this-order" class="row">

       </div>
    </div>
<!-- <script src="assets/js/bootstrap.min.js"></script> -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>