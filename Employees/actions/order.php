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
			WHERE `status`='".$status."'
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
				$op.='
					<form class="customer_order_not_deliver">
						<tbody >
							<td>'.$sl.'<input type="hidden" value="'.$row['order_id'].'" name="oid"></td>	
							
							<td>'.$row['customer_firstName'].' '.$row['customer_lastName'].'</td>

							<td>'.$row['customer_address'].'-'.$row['customer_pincode'].' </td>

							<td>'.$row['ordered_on'].'</td>

							<td>'.$row['status'].'</td>
						
							<td>
								<a href="thisOrder.php?order_id='.$row["order_id"].'&emp_id='.$_SESSION['emp_id_for_sess_ifbs4u'].'" class="btn btn-warning" >Accept & Confirm</a>
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

	public function deliveredOrder($status){
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
			WHERE `status`='".$status."' AND `order_emp_id`='".$_SESSION['emp_id_for_sess_ifbs4u']."'
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
				$op.='
					<form class="customer_order_not_deliver">
						<tbody >
							<td>'.$sl.'<input type="hidden" value="'.$row['order_id'].'" name="oid"></td>	
							
							<td>'.$row['customer_firstName'].' '.$row['customer_lastName'].'</td>

							<td>'.$row['customer_address'].'-'.$row['customer_pincode'].' </td>

							<td>'.$row['ordered_on'].'</td>

							<td>'.$row['status'].'</td>
						
							<td>
								<a href="thisOrder.php?set_order_id='.$row["order_id"].'&set_emp_id='.$_SESSION['emp_id_for_sess_ifbs4u'].'" class="btn btn-warning" >View</a>
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

	public function operationordercancel($status,$id){
		$qry=mysqli_query($this->dbs,"UPDATE `fbs_order` SET `status` = '".$status."',`cancel_on`=NOW() WHERE `fbs_order`.`order_id` = '".$id."'");
		if($qry){
			$op="yes";
		}else{
			$op="error";
		}
		return $op;
	}

	public function operationorderpaid($status,$id){
		$qry=mysqli_query($this->dbs,"UPDATE `fbs_order` SET `status` = '".$status."' WHERE `fbs_order`.`order_id` = '".$id."'");
		if($qry){
			$op="yes";
		}else{
			$op="error";
		}
		return $op;
	}
	
}


if(isset($_POST['confirmorder'])){
	$status=$_POST['status'];
	$objorder=new order();
	$opobj=$objorder->confirmOrder($status);
	echo $opobj;
}

if(isset($_POST['deliverorder'])){
	$status=$_POST['status'];
	$objorder=new order();
	$opobj=$objorder->deliveredOrder($status);
	echo $opobj;
}

if(isset($_POST['cancel'])){
	$id=$_POST['order_id'];
	$status=$_POST['status'];
	$objorder=new order();
	$opobj=$objorder->operationordercancel($status,$id);
	echo $opobj;
}

if(isset($_POST['paid'])){
	$id=$_POST['order_id'];
	$status=$_POST['status'];
	$objorder=new order();
	$opobj=$objorder->operationorderpaid($status,$id);
	echo $opobj;
}

?>