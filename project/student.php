<?php
session_start();

require_once('../mys.php');

$user=$_SESSION['user'];

$query="select type from login where username='$user'";

$responce=@mysqli_query($con,$query);
			
	while($row=mysqli_fetch_array($responce)){
				$type=$row['type'];
	}
	
if(strcmp($type,'student')){
	header("Location: login.php");
}

$msg=$_SESSION['msg'];

if(!strcmp($msg,"1")){
	$message="Enter a Valid Course Id!";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
else if(!strcmp($msg,'2')){
	$message="Enter a Valid Grade!";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
else if(!strcmp($msg,'3')){
	$message="Successfully Saved!";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
else if(!strcmp($msg,'4')){
	$message="Successfully Updated!";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
else if(!strcmp($msg,'5')){
	$message="Successfully Updated!";
	echo "<script type='text/javascript'>alert('$message');</script>";
}



$_SESSION['msg']="0";

?>

<html lang=''>
<head>
<title>Performance Indicator for Computer Engineering Students</title>
</head>
<body>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="demo.css" media="all" />

    <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="navig_bar.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
	<style>	
	body {
    background: url('kwallpaper.png') no-repeat fixed center center;
    background-size: cover;
    font-family: Montserrat;
	}
	</style>
</head>


<div class="container">
			
            <div class="freshdesignweb-top">
                
            <span class="right"> </span>
                    
			<div class="clr"></div>
            </div>
			<header>
			</header>

            <div id='cssmenu'>
			<ul>
   				<li><a href="student.php"><span>Add Grades</span></a></li>
   				<li><a href="ExtraCurAct.php"><span>Add Extra Curricular Activities</span></a></li>
   				<li><a href="myperformance.php"><span>My Results</span></a></li>
				<li><a href="myextra.php"><span>My Extra Curricular Activities</span></a></li>
				<li><a href="overallperformance.php"><span>Rank with Results</span></a></li>
				<li class='last'><a href="sort_extra.php"><span>Rank with Extra Curricular Activities</span></a></li>
			</ul>
			</div>

            <h1> Add Grades </h1>      
    <div  class="form">
		<form action="savenew.php" method="post" id="contactform"> 
    	
				<p class="contact"><label for="course_id">Course Id</label></p><br>
    			<input id="course_id" name="course_id" placeholder="Course Id" required="" tabindex="1" type="text"> 
				
				
				<p class="contact"><label for="batch">Batch</label></p> <br>
    			<input id="batch" name="batch" placeholder="Batch" required="" tabindex="1" type="text"> 
                
				<p class="contact"><label for="grade">Grade</label></p> <br>
    			<input id="grade" name="grade" placeholder="Grade" required="" tabindex="1" type="text">
				<p class="contact"><label for="grade">(For Grade Enter Capital Letters)</label><br> <br>
    			 
                <input class="button" name="save" id="save" tabindex="5" value="Save" type="submit" tabindex="1">
				
				</form>
				
				
		
		
		
		<form action="login.php" method="post">
				<input class="button" name="logout" id="logout" tabindex="5" value="Logout" type="submit"> 	 
		</form>
				
	</div>      
</div>


</body>

</html>