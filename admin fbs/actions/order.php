<?php
session_start();
include("../../connectionredfield/conn.php");
class order extends dbcon{	
	public function confirmOrder($status){
		$totalprice='';
		$countqtypriceresult=mysqli_query($this->dbs, "
			SELECT * FROM `orderedproductitems`	
			JOIN `fbs_order` 
			on `OPI_cust_id`=`order_jid` AND `OPI_order_on`=`ordered_on`
			WHERE `status`='".$status."'
			");
		$countorderforcountqtyprice=mysqli_num_rows($countqtypriceresult);
		if($countorderforcountqtyprice>0){
			foreach ($countqtypriceresult as $row) {
				$totalprice=$row['OPI_Product_price'] * $row['OPI_qty'];
			}
		}

		$result=mysqli_query($this->dbs, "
			SELECT * 
			FROM `fbs_order` 
			JOIN `fbs_customer` 
			ON `order_jid`=`jid`	
			WHERE `status`='unconfirm' OR `status`='not deliver' OR `status`='unpaid'
			");
		$op='
			<table class="table table-bordered table-responsive">
				<thead>
					<th>#</th><th>Name</th><th>Address</th><th>Order On</th><th>Status</th><th>Action</th>
				</thead>
			';
			$countorder=mysqli_num_rows($result);
		if($countorder>0){
			$sl=1;				
			foreach ($result as $row) {	
				if ($row['status']=='unconfirm') {
					$status='<label class="btn btn-danger">Not Confirmed Yet!!</label>';
					$btn='';
				}else{
					$status='<label class="btn btn-info">Not Delivered Yet!!</label>';
					$btn='<a href="thisOrder.php?order_id='.$row["order_id"].'" class="btn btn-warning" >View This Order</a>';
				}			
				$op.='
					<form class="customer_order_not_deliver">
						<tbody >
							<td>'.$sl.'<input type="hidden" value="'.$row['order_id'].'" name="oid"></td>	
							
							<td>'.$row['customer_firstName'].' '.$row['customer_lastName'].'</td>

							<td>'.$row['customer_address'].'-'.$row['customer_pincode'].' </td>

							<td>'.$row['ordered_on'].'</td>

							<td>'.$status.'</td>
						
							<td>
								'.$btn.'
							</td>
						</tbody>
					</form>
				';
				$sl++;
				
			}
		}else{
			$op.='<tr><td colspan="10">No Order Yet!!!</td></tr>';
		}
		$op.='
			</table>
			';
		return $op;
	}

	// all orders
	public function allorder($status){
		$result=mysqli_query($this->dbs, "
			SELECT * 
			FROM `fbs_order` 
			JOIN `fbs_customer` 
			ON `fbs_order`.`order_jid`=`fbs_customer`.`jid`
			JOIN `fbs_employees` 
			ON `fbs_order`.`order_emp_id`=`fbs_employees`.`empid`
			JOIN `orderedproductitems` 
			ON `fbs_order`.`order_jid`=`orderedproductitems`.`OPI_cust_id`	
			WHERE `status`='unconfirm' OR `status`='not deliver' OR `status`='paid'
			");
		$op='
			<table class="table table-bordered table-responsive">
				<thead>
					<th>#</th>
					<th>Customer Name</th>
					<th>Customer Address</th>
					<th>Customer Contact</th>
					<th>Order On</th>
					<th>Delivered By</th>
					<th>Items With Qty * Rs & By Vendor</th>
					<th>Totals Price</th>
					<th>Status</th>
				</thead>
			';
			$countorder=mysqli_num_rows($result);
		if($countorder>0){
			$s1=1;				
			foreach ($result as $row) {	
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
																WHERE `fbs_order`.`order_id` = '".$row['order_id']."'
																");
				$s2=1;
				$countorderforcountqtyprice=mysqli_num_rows($product_details_result);
				if($countorderforcountqtyprice>0){
					foreach ($product_details_result as $row2) {
						$totalprice+=$row2['OPI_Product_price'] * $row2['OPI_qty'];
						$out_product_items.= $s2 . ') ' .
						'<span style="font-size: 15px;font-weight: bolder;color: red;">'.$row2['products_name'].' = '.$row2['OPI_qty'].' '.$row2['product_unit'].'</span>,'.
						' From 
						<span style="font-size: 15px;font-weight: bolder;color: red;">'.$row2['vendor_name'].'</span>
						 Shop, Contact - 
						<span style="font-size: 15px;font-weight: bolder;color: red;">'.$row2['vendor_contact'].'</span>
						, Address - 
						<span style="font-size: 15px;font-weight: bolder;color: red;">'.$row2['vendor_address'].'</span><br>';
						$out_products_weight+=$row2['products_weight'] * $row2['OPI_qty'];
						$s2++;
					}
				}
	
						$op.='
							<form class="customer_order_not_deliver">
								<tbody >
									<td>'.$s1.'<input type="hidden" value="'.$row['order_id'].'" name="oid"></td>	
									
									<td>'.$row['customer_firstName'].' '.$row['customer_lastName'].'</td>

									<td>'.$row['customer_address'].'-'.$row['customer_pincode'].' </td>

									<td>'.$row['customer_phone'].'</td>

									<td>'.$row['ordered_on'].'</td>

									<td>'.$row['emp_name'].'<br> + '.$row['empcontact'].'</td>
								
									<td>
										'.$out_product_items.'
									</td>

									<td>'.$totalprice.'</td>

									<td>'.$row['status'].'</td>
								</tbody>
							</form>
						';
				$s1++;
				
			}
		}else{
			$op.='<tr><td colspan="10">No Order Yet!!!</td></tr>';
		}
		$op.='
			</table>
			';
		return $op;
	}

	// paid order
	public function paid($status,$order_id){
		$result=mysqli_query($this->dbs, "UPDATE `fbs_order` SET `status`='".$status."' WHERE `order_id`='".$order_id."'");
		return $op;
	}
}


if(isset($_POST['confirmorder'])){
	$status=$_POST['status'];
	$objorder=new order();
	$opobj=$objorder->confirmOrder($status);
	echo $opobj;
}

if(isset($_POST['paidorder'])){
	$status=$_POST['status'];
	$objorder=new order();
	$opobj=$objorder->allorder($status);
	echo $opobj;
}

if(isset($_POST['paid'])){
	$status=$_POST['status'];
	$order_id=$_POST['order_id'];
	$objorder=new order();
	$opobj=$objorder->paid($status,$order_id);
	echo $opobj;
}

?>