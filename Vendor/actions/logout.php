<?php
session_start();
	$sesionname=@$_SESSION['ifbs4u_vendor_id'];
	$logout=session_destroy();
	if($logout){
		header('location:../login.html');
	}else{
		echo "No logout";
	}
?>