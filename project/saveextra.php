<?php
session_start();

$user=$_SESSION['user'];
$year=$_POST['year'];
$sport=$_POST['activity'];
$colors=$_POST['achievements'];



require_once('../mys.php');

$query="select colors from extra where username='$user' and year='$year' and sport='$sport'";

$responce=mysqli_query($con,$query);

$updateval=mysqli_num_rows($responce);

while($row=mysqli_fetch_array($responce)){
	$colors2=$row['colors'];
}

if($colors=="Full colors"){$valuecolors=1.0;}else if($colors=="Half colors"){$valuecolors=0.7;}else if ($colors=="Participate"){$valuecolors=0.4;}
else if ($colors=="Team Member"){$valuecolors=0.4;}else if ($colors=="For Pleasure"){$valuecolors=0.2;}


if($updateval=="1"){
	$query="update extra set colors='$colors',valuecolors='$valuecolors' where username='$user' and year='$year' and sport='$sport'";
	$responce1=@mysqli_query($con, $query);
	
	$totalcolors=0.0;
	
	$query1="select sum(valuecolors) from extra where username='$user'";
	$responce2=@mysqli_query($con, $query1);
	
	while($row=mysqli_fetch_array($responce2)){
		$totalcolors=$row['sum(valuecolors)'];
	}
	
	$query2="update totalextra set totalvalue='$totalcolors' where username='$user'";
	$responce3=@mysqli_query($con, $query2);
	
	$_SESSION['msg']="3";
	header("Location: ExtraCurAct.php");
	
	
}else{
	$query="insert into extra(username,year,sport,colors,valuecolors) values(?,?,?,?,?)";
		
	$statement=mysqli_prepare($con,$query);
		
	mysqli_stmt_bind_param($statement,"ssssd",$user,$year,$sport,$colors,$valuecolors);
	mysqli_stmt_execute($statement);

	$affected_rows=mysqli_stmt_affected_rows($statement);

	mysqli_stmt_close($statement);
	
	$query="insert into totalextra(username,totalvalue) values(?,?)";
		
	$statement=mysqli_prepare($con,$query);
		
	mysqli_stmt_bind_param($statement,"sd",$user,$valuecolors);
	mysqli_stmt_execute($statement);

	$affected_rows2=mysqli_stmt_affected_rows($statement);

	mysqli_stmt_close($statement);

	if($affected_rows and $affected_rows2){
		$_SESSION['msg']="1";
		header("Location: ExtraCurAct.php"); 
	}else{
		$_SESSION['msg']="2";
		header("Location: ExtraCurAct.php");
	}
}


			


?>