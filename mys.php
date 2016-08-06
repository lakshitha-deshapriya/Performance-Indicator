<?php
	$servername="localhost";
	$username="username";
	$password="password";
	$db="performance";
	
	$con=new mysqli($servername,$username,$password,$db);
	
	if($con){
		
	}else{
		die("Connectionn failed:".mysqli_error());
	}



?>