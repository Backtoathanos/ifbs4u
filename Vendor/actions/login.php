<?php
session_start();
require_once "../../connectionredfield/conn.php";
class door extends dbcon{
		public function login($email,$pass){
			$qry=mysqli_query($this->dbs, "SELECT * FROM `fbs_vendors` WHERE `vendor_uname`='".$email."' AND `vendor_password`='".$pass."'");
			if(mysqli_num_rows($qry)>0){
				$user_details=mysqli_fetch_assoc($qry);
				$vendor_name=$user_details['vendor_name'];
				$vendor_id=$user_details['vendor_id'];
				$_SESSION['ifbs4u_vendor_id']=$vendor_id;
				$_SESSION['ifbs4u_vendor_name']=$vendor_name;
				$op="success";
			}else{
				$op="New";
			}
			return $op;
		}
}

// login object section
if(isset($_POST['login'])){
	$email=$_POST['email'];
	$pass=$_POST['password'];
	$objlogin=new door();
	$opobjlogin=$objlogin->login($email,$pass);
	echo $opobjlogin;
}
?>