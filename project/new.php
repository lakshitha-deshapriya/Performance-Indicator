
<?php
session_start();

require_once('../mys.php');

$user=$_SESSION['user'];
$username=$_POST['username'];
$course_id=$_POST['course_id'];

$query="select type from login where username='$user'";

$responce=@mysqli_query($con,$query);
			
	while($row=mysqli_fetch_array($responce)){
				$type=$row['type'];
	}
	
if(strcmp($type,'staff')){
	header("Location: login.php");
}
			

$query="select grade from results where username='$username' and course_id='$course_id' ";
			
$responce=@mysqli_query($con,$query);
$grade="any";			

$rows=mysqli_num_rows($responce);

while($row=mysqli_fetch_array($responce)){
	$grade=$row['grade'];			
}
$_SESSION['grade']=$grade;

$_SESSION['msg']="1";

$query="select course_id from results where username='$username'";

$responce=mysqli_query($con,$query);

$row1=mysqli_num_rows($responce);

if(!$row1){
	$_SESSION['msg1']="1";
	
}
header("Location:staff.php");


?>

