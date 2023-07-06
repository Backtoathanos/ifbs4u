<?php
session_start();
// This is personal details of user form with ajax
include("../connectionredfield/db.php");
if(isset($_POST['pdetails'])){
	$uid=$_SESSION['user'];
	$pdetails_query=mysqli_query($con,"SELECT * FROM `fbs_signup` WHERE `signup_id`='".$uid."'");
	$print_details=mysqli_fetch_assoc($pdetails_query);
	echo json_encode($print_details);
}

// save details or change detais
if(isset($_POST['save'])){
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$email=$_POST['email'];
	$contact=$_POST['contact'];
	$address=$_POST['address'];
	$update_pdetails=mysqli_query($con, "UPDATE `fbs_signup` SET `signup_firstName`='".$fname."',`signup_lastName`='".$lname."',`signup_email`='".$email."',`signup_contact`='".$contact."',`signup_address`='".$address."' WHERE `signup_id`='".$_SESSION['user']."'");
	if($update_pdetails){
		echo "success";
	}else{
		echo "Error";
	}
}

// update password
if(isset($_POST['update'])){
	$current_password=$_POST['crrntpassword'];
	$new_password=$_POST['npassword'];
	$con_password=$_POST['con_password'];
	if(strlen( $current_password) < 8 && strlen( $new_password) > 16 && strlen( $new_password) < 1)
	{
	    echo "Invalid password!Password must be atleast 8 character";
	}elseif(strlen( $new_password) < 8 && strlen( $new_password) > 16 && strlen( $new_password) < 1)
	{
	    echo "Invalid password!Password must be atleast 8 character";
	}elseif(strlen( $con_password) < 8 && strlen( $new_password) > 16 && strlen( $new_password) < 1)
	{
	    echo "Invalid password!Password must be atleast 8 character";
	}else{
		if($new_password==$current_password){
			echo "You need to try new password!!";
		}elseif($new_password==$con_password){
			$check_password_query=mysqli_query($con, "SELECT * FROM `fbs_signup` WHERE `signup_password`='".$current_password."' AND `signup_id`='".$_SESSION['user']."'");
			if($count=mysqli_num_rows($check_password_query)==1){
				$update_password_query=mysqli_query($con, "UPDATE `fbs_signup` SET `signup_password`='".$new_password."' WHERE `signup_id`='".$_SESSION['user']."'");
				if($update_password_query){
					echo "Password Updated!!";
				}else{
					echo "Some time it takes problem!!!";
				}
			}else{
				echo "Your current password does not Match!!";
			}
		}else{
			echo "Your new & confirm Password does not match!!";
		}
	}

}
?>