<?php
session_start();

require_once('../mys.php');

$user=$_SESSION['user'];

$grade=$_SESSION['grade'];
$gp=$_SESSION['gp'];
$batch=$_SESSION['batch'];
$course_id=$_SESSION['course_id'];
$type=$_SESSION['type'];
$credit=$_SESSION['credit'];
$totalcumilative=$_SESSION['totalcumilative'];
$totalcredit=$_SESSION['totalcredit'];
$prev_repeated=$_SESSION['$prev_repeated'];

$repeated=false;
$location="0";
if($gp==1.7){$cumilative=$credit/2;} else if ($gp==1.3){$cumilative=(2*$credit/3);} else if ($gp==1.0) {$cumilative=$credit;} else if($gp==0.0){$repeated=true;} else {$cumilative=0.0;}
		

if($type=='general'){
	$query="update results set grade='$grade',batch='$batch' where username='$user' and course_id='$course_id'";
	$responce2=mysqli_query($con,$query);
	$row1="0";
	if($responce2){
		$row1="1";
	}
	if($repeated){
		
		$query2="update student set repeated='$repeated' where username='$user' and course_id='$course_id'";
		$responce=mysqli_query($con,$query2);
		
		$row2="0";
		if($responce2){
			$row2="1";
		}
	}else{
		$totalcumilative2=$totalcumilative+$cumilative;
		$totalcredit2=$totalcredit+$credit;
		
		$query2="update student set totalcredit='$totalcredit2',totalcumilative='$totalcumilative2' where username='$user' and course_id='$course_id'";
		$responce=mysqli_query($con,$query2);
		
		$row3="0";
		if($responce){
			$row3="1";
		}
	}
	if($row1 and $row2 and $row3){
		$location="1";
	}
	
}else{
	$query="update results set grade='$grade',batch='$batch',gp='$gp' where username='$user' and course_id='$course_id'";
	$responce2=mysqli_query($con,$query);
	$row1="0";
	if($responce2){
		$row1="1";
	}
	$query="select avg(gp) from results where username='$user' and type='core'";
	$responce=mysqli_query($con,$query);
		
	while($row=mysqli_fetch_array($responce)){
		$ave_gpa=$row['avg(gp)'];
	}
	if($repeated){
		$query2="update student set ave_gpa='$ave_gpa',repeated='$repeated' where username='$user' and course_id='$course_id'";
		$responce=mysqli_query($con,$query2);
		
		$row2="0";
		if($responce2){
			$row2="1";
		}
	}else{
		$totalcumilative2=$totalcumilative+$cumilative;
		$totalcredit2=$totalcredit+$credit;
		
		$query2="update student set totalcredit='$totalcredit2',totalcumilative='$totalcumilative2',ave_gpa='$ave_gpa' where username='$user' and course_id='$course_id'";
		$responce=mysqli_query($con,$query2);
		
		$row3="0";
		if($responce){
			$row3="1";
		}
	}
	if($row1 and $row2 and $row3){
		$location="1";
	}
	
}
if($location=='1'){
	$_SESSION['msg']="4";
	header("Location:student.php");
}else{
	$_SESSION['msg']="5";
	header("Location:student.php");
}



?>