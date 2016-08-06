<?php
session_start();

if(!isset($_SESSION['user']))
{
 header("Location: login.php");
}

require_once('../mys.php');

    $q1="select username,course_id,course_name,semester,grade,gpa from course";
	$response=@mysqli_query($con,$q1);
	
	  echo '<table align= "left" border="3" style="width:50%">
				  <tr>
				  <td align= "left"> <b>Course id </b></td>
				  <td align= "left"> <b>Course name </b></td>
				  <td align= "left"> <b>Semester </b></td>
				  <td align= "left"> <b>Grade </b></td>
				  <td align= "left"> <b>GPA </b></td>
				  </tr>';

	
    while($row=mysqli_fetch_array($response)){	
	  if($_SESSION['user']==$row['username']){
			  $query= "select course_id,course_name,semester,grade,gpa from course";
		      $response1=@mysqli_query($con,$query);
			  echo '<tr><td align= "left">'. 
			  $row['course_id'].'</td><td align= "left">'.
			  $row['course_name'].'</td><td align= "left">'.
			  $row['semester'].'</td><td align= "left">'.
			  $row['grade'].'</td><td align= "left">'.
			  $row['gpa'].'</td><td align= "left">';
			  
			  echo '<tr>';
	  }
	}
	 echo'</table><br><br>';
    
     $q2="SELECT  username,SUM(credit),AVG(gpa),@curRank := @curRank + 1 AS rank FROM course c,(SELECT @curRank := 0) r  
	 group by username ORDER BY  avg(gpa) desc";
	 $q3="SELECT username ,AVG(gpa),semester FROM course  where username = '{$_SESSION['user']}' group by semester";
	 $response1=@mysqli_query($con,$q2);
	 $response2=@mysqli_query($con,$q3);
	 
	    echo '<table align= "left" border="3" style="width:50%">
				  <tr>
				  <td align= "left"> <b>Semester </b></td>
				  <td align= "left"> <b>GPA</b></td>
				  </tr>';
	 
	    while($row=mysqli_fetch_array($response2)){	
	     echo '<tr><td align= "left">'. 
			  $row['semester'].'</td><td align= "left">'.
			  $row['AVG(gpa)'].'</td><td align= "left">';
	          echo '<tr>';
              echo '<br>';
	    }
		 echo'</table>';
		 echo '<br><br>';
		 
		 while($row=mysqli_fetch_array($response1)){	
	      if($_SESSION['user']==$row['username']){
			  echo '<br>';
			  echo " Your Grade point average until now is " . $row['AVG(gpa)'];
			  echo '<br>';
			  echo "Your are at the Rank" .$row['rank'];
			  echo '<br>';
			  echo " Your have earned " . $row['SUM(credit)']. "credits ";
			  echo '<br>';
			  
		  }
	 }
	 
	
	
	
mysqli_close($con);
?>
<html>
<head>
<title>Performance indicator for Computer Engineering Students</title>
</head>
<body>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="demo.css" media="all" />
	
	<style>	
	body {
    background: url('kwallpaper.png') no-repeat fixed center center;
    background-size: cover;
    font-family: Montserrat;
	}
	</style>
	
	    <form action="student.php" method="post">
				<input class="button" name="Home" id="perform" tabindex="5" value="Home" type="submit"> 	 
		</form>
		<form action="login.php" method="post">
				<input class="button" name="logout" id="logout" tabindex="5" value="Logout" type="submit"> 	 
		</form>
</head>
<body>