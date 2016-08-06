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

$msg=$_SESSION['msg'];

if(!strcmp($msg,'1')){
	$message="Account Created Successfully!";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
else if(!strcmp($msg,'2')){
	$message="Error Occured When Saving!";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
else if(!strcmp($msg,'3')){
	$message="Enter a valid Username!";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
else if(!strcmp($msg,'4')){
	$message="There is a Data Missing!";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
$_SESSION['msg']="0";
?>

<!DOCTYPE html>
<html>
<head>
<title>Performance indicator for Computer Engineering Students</title>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="demo.css" media="all" />

    <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="navig_bar_2.css">
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
<body>
<div class="container">
			
            <div class="freshdesignweb-top">
                
            <span class="right"> </span>
                    
			<div class="clr"></div>
            </div>
			<header>
				
			<div id='cssmenu'>

			<ul>
   				<li><a href="admin.php"><span>Add Account</span></a></li>
   				<li class='last'><a href="outside.php"><span>Outsiders</span></a></li>
			</ul>
			</div>
			
				<h1> Add Account </h1>
            </header>       
    <div  class="form">
    		<form action="addaccount.php" method="post" id="contactform"> 
    			<p class="contact"><label for="name">Username</label></p> 
    			<input id="username" name="username" placeholder="Username" required="" tabindex="1" type="text"> 
				
				<p class="contact"><label for="password">Password</label></p> 
    			<input type="password" id="password" placeholder="Password" name="password" required="" tabindex="1"> 
				
				<p class="contact"><label for="firstname">First Name</label></p> 
    			<input id="firstname" name="firstname" placeholder="First name" required="" tabindex="1" type="text"> 
				
				<p class="contact"><label for="lastname">Last Name</label></p> 
    			<input id="lastname" name="lastname" placeholder="last name" required="" tabindex="1" type="text"> 
    			 
    			<p class="contact"><label for="company">Company</label></p> 
    			<input id="company" name="company" placeholder="company" required="" type="text" tabindex="1"> 
                
                <p class="contact"><label for="position">Position</label></p> 
    			<input id="position" name="position" placeholder="position" required="" tabindex="1" type="text"> 
    			 
                
                <p class="contact"><label for="address">Address</label></p> 
    			<textarea name="address" rows="4" cols="50" tabindex="1"></textarea> 
        
		
				<p class="contact"><label for="phone">Mobile phone</label></p> 
				<input id="phone" name="phone" placeholder="phone number" required="" type="text" tabindex="1"> <br>
			
				<p class="contact"><label for="email">Email</label></p> 
    			<input id="email" name="email" placeholder="example@domain.com" required="" type="email" tabindex="1"> <br><br>
                
				<input class="button" name="submit" id="submit" tabindex="5" value="Create Account" type="submit"> 	 
			</form> 
			<form action="login.php" method="post">
				<input class="button" name="logout" id="logout" tabindex="5" value="Logout" type="submit"> 	 
			</form>
		
	</div>      
</div>

</body>
</html>
