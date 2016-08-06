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

if(!strcmp($msg,'1')){
	$message="Successfullly Saved!";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
else if(!strcmp($msg,'2')){
	$message="Error Occured when Saving!";
	echo "<script type='text/javascript'>alert('$message');</script>";
}else if(!strcmp($msg,'3')){
	$message="Successfully Updated!";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
$_SESSION['msg']="0";

?>

<html>
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
   <link rel="stylesheet" href="navig_bar_4.css">
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

  			<h1> Add Extra Curricular Activities </h1>
			     
    <div  class="form">
		<form action="saveextra.php" method="post" id="contactform"> 
    	
				
				<p class="contact"><label for="year">Year</label></p> <br>
    			<input id="year" name="year" placeholder="Year" required="" tabindex="1" type="text"> 
    			 
    			<p class="form_control"><label for="sCombo box">Activity</label></p> <br>
    			<p class="contact">
    			<select name="activity" style="width:110px" > 
                <option>Athletic</option>
                <option>Volleyball</option>
                <option>Cricket</option>
				<option>Football</option>
				<option>Netball</option>
				<option>Hockey</option>
			    </select></p><br>
				
				<p class="form_control"><label for="sCombo box">Achievements</label></p> <br>
    			<p class="contact">
    			<select name="achievements" style="width:110px" > 
                <option>Full colors</option>
                <option>Half colors</option>
                <option>Participate</option>
				<option>Team Member</option>
				<option>For Pleasure</option>
				</select></p><br>

                <input class="button" name="save" id="save" tabindex="5" value="Save" type="submit" tabindex="1">
				<input class="button" name="edit" id="edit" tabindex="5" value="Edit" type="submit" tabindex="1"> </form>
				
		</form> 
	</div>      
</div>


</body>

</html>