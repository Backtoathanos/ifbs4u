<?php
session_start();
include("../connectionredfield/db.php");
if(isset($_POST['user_order'])){
		$user_order_query=mysqli_query($con, "SELECT * FROM `fbs_order` WHERE `uid`='".$_SESSION['user']."'");
		$count_order=mysqli_num_rows($user_order_query);
		if($count_order==0){
			$print_user= "<p style='float: left;font-size: 30px;font-weight: bold;background: lightgreen;padding: 5px;border-radius: 10px;'>You have not ordered yet.</p>";
		}else{
			$print_user="
				<table class='table bordered stripped'>
			        <tr>
			            <th>Order Item</th>
			            <th>Total Price</th>
			            <th>Deliver Date</th>
			            <th>Cancel Date</th>
			        </tr>
			";
			while($row=mysqli_fetch_assoc($user_order_query)){
				$print_user.="
					<tr>
	                    <td>".$row['order_item']."</td>
	                    <td>".$row['order_total_price']." <i class='fa fa-rupee'></i></td>
	                    <td>".$row['delivered_on']."</td>
	                    <td>".$row['cancel_on']."</td>
	                </tr>
					";
			}
			$print_user.="
				</table>
			";
		}
		echo json_encode($print_user);

}
?>