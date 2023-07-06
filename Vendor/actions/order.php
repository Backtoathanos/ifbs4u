<?php
session_start();
include("../../connectionredfield/conn.php");
class order extends dbcon{	
	public function confirmOrder($status){
		
		$result=mysqli_query($this->dbs, "
			SELECT DISTINCT `order_id`, `emp_name`, `ordered_on`, `status` 
			FROM `fbs_order` 
			JOIN `fbs_customer` 
			ON `order_jid`=`jid`
			JOIN `orderedproductitems` 
			ON `jid`=`OPI_cust_id`	
			JOIN `fbs_employees`
			ON `empid`=`order_emp_id` 
			WHERE `OPI_vendor_id`='".$_SESSION['ifbs4u_vendor_id']."' AND `status`='".$status."'
			");
		$op='
			<table class="table table-bordered table-responsive">
				<thead>
					<th>#</th><th>Deliver Boy Name</th><th>Order On</th><th>Status</th><th>Action</th>
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
							
							<td>'.$row['emp_name'].'</td>

							<td>'.$row['ordered_on'].'</td>

							<td>'.$row['status'].'</td>
						
							<td>
								<a href="thisOrder.php?order_id='.$row["order_id"].'" class="btn btn-warning" >View</a>
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
}


if(isset($_POST['confirmorder'])){
	$status=$_POST['status'];
	$objorder=new order();
	$opobj=$objorder->confirmOrder($status);
	echo $opobj;
}
?>