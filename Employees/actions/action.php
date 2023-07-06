<?php
session_start();
include("../../connectionredfield/conn.php");
/*--------------------------------------------------------------------------------------------------------*/
/*-----------------------------------------.Index Page.---------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------------*/
class reload extends dbcon{	
	public function checkOrderNotifications(){
		$result=mysqli_query($this->dbs, "SELECT * FROM `fbs_order` WHERE `status`='unconfirm' AND `order_emp_id`='0'");
		$count=mysqli_num_rows($result);
		return $count;
	}
	public function allUser(){
		$result=mysqli_query($this->dbs, "SELECT * FROM `fbs_order` WHERE `order_emp_id`='".@$_SESSION['emp_id_for_sess_ifbs4u']."'");
		$count=mysqli_num_rows($result);
		return $count;
	}

}


/*--------------------------------------------------------------------------------------------------------*/
/*---------------------------------.FROM HERE OBJECT'S AREA STARTED.--------------------------------------*/
/*--------------------------------------------------------------------------------------------------------*/

// fecth data from db in home page
if(isset($_POST["reload"])){
	
	$allusers=new reload();
	$checkOrdernot=new reload();
	$au=$allusers->allUser();
	$noc=$checkOrdernot->checkOrderNotifications();
	$op=array($au,$noc);
	echo json_encode($op);
}

?>