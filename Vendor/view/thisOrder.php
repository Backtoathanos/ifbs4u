<?php
session_start();
require_once "../../connectionredfield/conn.php";
if(empty(@$_SESSION['ifbs4u_vendor_id'])){
    header('location:../login.html');
}
?>
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/Article">
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
														FROM `orderedproductitems` 
														JOIN `fbs_products` 
														ON `products_id`=`OPI_Product_id`
														JOIN `fbs_order` 
														ON `ordered_on`=`OPI_order_on`
														JOIN `fbs_employees`
														ON `empid`=`order_emp_id`
														WHERE `order_id` = '".$order_id."' AND `status`='not deliver' AND `vendor_id`='".$_SESSION['ifbs4u_vendor_id']."'
														");
		$sl=1;
		$countorderforcountqtyprice=mysqli_num_rows($product_details_result);
		if($countorderforcountqtyprice>0){
			foreach ($product_details_result as $row) {
				$totalprice+=$row['OPI_Product_price'] * $row['OPI_qty'];
				$out_product_items.= $sl . ') ' .$row['products_name'].' = '.$row['OPI_qty'].' '.$row['product_unit'].'<br>';
				$out_products_weight+=$row['products_weight'] * $row['OPI_qty'];
				$sl++;
			}
		}

		$result=mysqli_query($this->dbs, "
			SELECT * FROM `fbs_order` 
			JOIN `fbs_customer` 
			ON `order_jid`=`jid` 
			JOIN `fbs_employees`
			ON `empid`=`order_emp_id`
			WHERE `order_id`= '".$order_id."' AND `status`='not deliver' AND `order_emp_id`!= '0' 
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
							<td>Deliver Boy Name</td>
								<td>
								'.$row['emp_name'].'
								<input type="hidden" value="'.$row['order_id'].'" name="oid">
								</td>	
							</tr>
							<tr>
								<td>Contact Number</td>
								<td>'.$row['empcontact'].'</td>
							</tr>
							<tr>
								<td>Ordered On</td>
								<td>'.$row['ordered_on'].'</td>
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
								<td>'.$row['status'].'</td>
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