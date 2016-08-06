<?php
session_start();

require_once('../mys.php');

$user=$_SESSION['user'];

$query="select type from login where username='$user'";

$responce=@mysqli_query($con,$query);
			
	while($row=mysqli_fetch_array($responce)){
				$type=$row['type'];
	}
	
if(strcmp($type,'admin')){
	header("Location: login.php");
}

?>
<?php

if(isset($_POST['submit'])){
	
	$data_missing=array();
	
	if(empty($_POST['username'])){
		$data_missing[]='username';
	}else{
		$user=trim($_POST['username']);
	}
	if(empty($_POST['password'])){
		$data_missing[]='password';
	}else{
		$pass=trim($_POST['password']);
	}
	if(empty($_POST['firstname'])){
		$data_missing[]='firstname';
	}else{
		$firstname=trim($_POST['firstname']);
	}
	if(empty($_POST['company'])){
		$data_missing[]='company';
	}else{
		$company=trim($_POST['company']);
	}
	if(empty($_POST['lastname'])){
		$data_missing[]='lastname';
	}else{
		$lastname=trim($_POST['lastname']);
	}
	if(empty($_POST['position'])){
		$data_missing[]='position';
	}else{
		$position=trim($_POST['position']);
	}
	if(empty($_POST['address'])){
		$data_missing[]='address';
	}else{
		$address=trim($_POST['address']);
	}
	if(empty($_POST['phone'])){
		$data_missing[]='phone';
	}else{
		$phone=trim($_POST['phone']);
	}
	if(empty($_POST['email'])){
		$data_missing[]='email';
	}else{
		$email=trim($_POST['email']);
	}

	if(empty($data_missing)){
		
		require_once('../mys.php');
		
		$q1="select username from outsiders";
		$q2="select username from login";
		
		$responce=@mysqli_query($con,$q1);
		$responce2=@mysqli_query($con,$q2);
		
		$count1=1;
		$count2=1;
		
		while($row=mysqli_fetch_array($responce)){
			if($row['username']==$user){
				$count1=0;
			}
		}
		while($row=mysqli_fetch_array($responce2)){
			if($row['username']==$user){
				$count2=0;
			}
			
		}
		
		if($count1==1 && $count2==1){
			
			$query="Insert into outsiders(username,password,fname,lname,company,position,address,mobile,email) values(?,?,?,?,?,?,?,?,?)";
			$query2="insert into login(username,password,type) values(?,?,?)";
	
			$statement=mysqli_prepare($con,$query);
			$statement2=mysqli_prepare($con,$query2);
		
		
			mysqli_stmt_bind_param($statement,"sssssssss",
						$user,$pass,$firstname,$lastname,$company,
						$position,$address,$phone,$email);
						
			$outside="outsider";
							
			mysqli_stmt_bind_param($statement2,"sss",$user,$pass,$outside);
							
			mysqli_stmt_execute($statement);
			mysqli_stmt_execute($statement2);
	
			$affected_rows=mysqli_stmt_affected_rows($statement);
			$affected_rows2=mysqli_stmt_affected_rows($statement2);
	
			if($affected_rows==1 && $affected_rows2==1){
				$_SESSION['msg']="1";
				
				mysqli_stmt_close($statement);
				mysqli_stmt_close($statement2);
				mysqli_close($con);
		
			}else{
				$_SESSION['msg']="2";
				
				echo mysqli_error($statement);
				echo mysqli_error($statement2);
		
				mysqli_stmt_close($statement);
				mysqli_stmt_close($statement2);
				mysqli_close($con);
			}
			
		}else{
			$_SESSION['msg']="3";
			
		}
		
	
	}else{
		$_SESSION['msg']="4";
		
		
	}


}
header("location:admin.php");
?>

