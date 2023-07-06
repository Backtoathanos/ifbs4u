<?php
session_start();
include "../connectionredfield/db.php";
if(isset($_POST)){
	$email=$_POST['email'];
	$pass=$_POST['password'];
	$login_sql=mysqli_query($con,"SELECT * FROM `fbs_signup` WHERE `signup_email`='".$email."' AND `signup_password`='".$pass."'");
		$login_check=mysqli_num_rows($login_sql);
		if($login_check>0){
			$user_details=mysqli_fetch_assoc($login_sql);
			$user=$user_details['signup_id'];
			$user_name=$user_details['signup_firstName'];
			$_SESSION['user']=$user;
			$_SESSION['user_name']=$user_name;
			$_SESSION['start'] = time(); 
			 // taking now logged in time
			 $_SESSION['expire'] = $_SESSION['start'] + (43800 * 60) ;
			echo "Success";
		}else{
			echo "Error";
		}
}
?>