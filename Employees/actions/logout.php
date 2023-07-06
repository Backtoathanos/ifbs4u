<?php
session_start();
	$sesionname=@$_SESSION['emp_id_for_sess_ifbs4u'];
	$logout=session_destroy();
	if($logout){
		header('location:../login.html');
	}else{
		echo "No logout";
	}
?>