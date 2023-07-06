<?php
session_start();
require_once "../../connectionredfield/conn.php";
class door extends dbcon{
		public function login($email,$pass){
			$qry=mysqli_query($this->dbs, "SELECT * FROM `fbs_admin` WHERE `admin_username`='".$email."' AND `admin_password`='".$pass."'");
			if(mysqli_num_rows($qry)>0){
				$user_details=mysqli_fetch_assoc($qry);
				$user_name=$user_details['admin_firstname'];
				$user_id=$user_details['admin_id'];
				$_SESSION['admin']=$user_id;
				$_SESSION['admin_name']=$user_name;
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