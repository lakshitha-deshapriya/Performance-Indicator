<?php
session_start();
require_once('../mys.php');



$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];
$type="type";
$log=0;
$pass_w=0;

$query="select * from login";

$responce=@mysqli_query($con,$query);

while($row=mysqli_fetch_array($responce)){
	if($row['username']==$myusername){
		if($row['password']==$mypassword){
		    $_SESSION["user"] = $row['username'];
			$type=$row['type'];
			$log=1;
		}
		else{
			$pass_w=1;
		}
	}
}

if($log==1){
	if($type=="admin"){
		header("location:admin.php");
	}else if($type=="student"){
		header("location:student.php");
	}else if($type=="staff"){
		header("location:staff.php");
	}else if($type=="outsider"){
		header("location:outsiders.php");
	}
	
}else{
	if($pass_w){
		echo "";
		$message="Wrong Password";
		echo "<script type='text/javascript'>alert('$message');</script>";
		
	}else{
		$message="Wrong Username and Password";
		echo "<script type='text/javascript'>alert('$message');</script>";
	}
	
}

?>

<html>
<head>
<title>Performance Indicator for Computer Engineering Students</title>
<style>
body {
    background: url('kwallpaper.png') no-repeat fixed center center;
    background-size: cover;
    font-family: Montserrat;
}

.login-block {
    width: 320px;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 5px solid #0066ff;
    margin: 0 auto;
}

.login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
}

.login-block input {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
}

.login-block input#username {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#username:focus {
    background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input#password {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#password:focus {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input:active, .login-block input:focus {
    border: 1px solid #ff656c;
}

.login-block button {
    width: 100%;
    height: 40px;
    background: #0066cc;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #0066ff;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
}

.login-block button:hover {
    background: #0066cc;
}
.head {

font-family: Montserrat;
padding: 50px;
text-align: center;

}

</style>
</head>

<body>
<div class="head">
	<h1> Performance Indicator for Computer Engineering Students </h1>
	</div>

<div class="login-block">
	
    <h1>Login</h1>
	<form action="logincheck.php" method="post">
		<input type="text" value="" placeholder="Username" id="username" name="myusername" />
		<input type="password" value="" placeholder="Password" id="password" name="mypassword" />
		<button>Login</button>
	<form>
</div>
</body>

</html>