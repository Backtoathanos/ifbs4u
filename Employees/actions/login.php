<?php
session_start();
require_once "../../connectionredfield/conn.php";
class door extends dbcon{
		public function login($email,$pass){
			$qry=mysqli_query($this->dbs, "SELECT * FROM `fbs_employees` WHERE `emp_uname`='".$email."' AND `emp_password`='".$pass."'");
			if(mysqli_num_rows($qry)==1){
				$user_details=mysqli_fetch_assoc($qry);
				$user_name=$user_details['emp_name'];
				$user_id=$user_details['empid'];
				$_SESSION['emp_id_for_sess_ifbs4u']=$user_id;
				$_SESSION['emp_name_for_sess_ifbs4u']=$user_name;
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