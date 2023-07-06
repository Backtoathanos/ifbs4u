<?php
session_start();
	$sesionname=@$_SESSION['admin'];
	$logout=session_destroy();
	if($logout){
		header('location:../login.html');
	}else{
		echo "No logout";
	}
?>