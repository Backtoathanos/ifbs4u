<?php
session_start();
include("../connectionredfield/db.php");
	if(isset($_GET['deliver'])){
        $fname=$_POST['FirstName'];
        $lname=$_POST['lastName'];
        $mobno=$_POST['mobileno'];
        $addresssec=$_POST['Addresssec'];
        $max_result=@date(dmyHis);        
        $uid=$fname.$max_result;

        $udetails_qry=mysqli_query($con, "INSERT INTO `fbs_customer`
            (`jid`, `customer_firstName`, `customer_lastName`, `customer_phone`, `customer_address`, `customer_pincode`, `customer_state`) 
            VALUES
             ('$uid', '$fname', '$lname', '$mobno', '$addresssec', '832110', 'JHARKHAND')
             ");
        if ($udetails_qry) {
            $itemdata='';
            $total=0;
            foreach($_SESSION["fbs_shopping_cart"] as $keys => $values){  
                $lineitemqry=mysqli_query($con, "
                    INSERT INTO `orderedproductitems`
                    (`OPI_cust_id`, `OPI_Product_id`, `OPI_vendor_id`, `OPI_qty`, `OPI_Product_price`,`OPI_order_on`) 
                    VALUES 
                    ('".$uid."', '".$values["product_id"]."', '".$values["product_vendor_id"]."', '".$values["product_quantity"]."', '".$values["product_price"]."', NOW())
                    ");
                if($lineitemqry){
                    $itemdata.=$values["product_name"]." = ".$values["product_quantity"]." , ";
                    $total= $total + ($values["product_quantity"] * $values["product_price"]);  
                }else{
                    echo "Hmmmm!!!! Something went Wrong! on Products";
                }
            } 
            $checkout_qry=mysqli_query($con, "INSERT INTO `fbs_order`( `order_jid`, `order_emp_id`, `status`, `ordered_on`) VALUES ('$uid','0','unconfirm',NOW())");
            if($checkout_qry){
                unset($_SESSION["fbs_shopping_cart"]);
                    echo "success";
            }else{
                echo "Please Check and Try Again!!!";
            }
        }else{
            echo "Hmmmm!!!! Something went Wrong! on Customer";
        }            	
	}

?>