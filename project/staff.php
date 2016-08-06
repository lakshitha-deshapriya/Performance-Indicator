<?php
session_start();

require_once('../mys.php');

$user=$_SESSION['user'];

$query="select type from login where username='$user'";

$responce=@mysqli_query($con,$query);
			
	while($row=mysqli_fetch_array($responce)){
				$type=$row['type'];
	}
	
if(strcmp($type,'staff')){
	header("Location: login.php");
}

$msg=$_SESSION['msg'];

$grade="any";

if(!strcmp($msg,'1')){
	$grade=$_SESSION['grade'];
}
$_SESSION['msg']="0";



?>

<!DOCTYPE html>
<html lang="en">
<head>



<link rel="stylesheet"
  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet"
  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script
  src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script
  src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="navig_bar_3.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>

<link type="text/css" rel="stylesheet" href="indiv.css">
<link rel="stylesheet" type="text/css" href="navigationindiv.css">
</head>
<body style='margin:30px'>

  <div id='cssmenu'>

      <ul>
          <li><a href="staff.php"><span>Individual Performance</span></a></li>
          <li><a href="compare1.php"><span>Present & Past Results</span></a></li>
          <li class='last'><a href="results.php"><span>Grades Of The Class</span></a></li>
      </ul>
      </div>

    <h2> Individual Performence </h2>


    <div class="container">
      <!-- Horizonatal Form -->
      <div class="row">
        <div class="col-xs-6">
          <form action="new.php" method="post"  class="form-horizontal">
            <div class="form-group">
              <label for="username" class="col-xs-2"> Username: </label>
              <div class="col-xs-10">
                <input id="1" name="username" type="text" class="form-control" id="username" placeholder="Username" />
			
              </div>
            </div>
          
            <div class="form-group">
              <label for="course_id" class="col-xs-2"> Course Id: </label>
              <div class="col-xs-10">
                <input id="2" name="course_id" type="text" class="form-control" id="course_id" placeholder="Course Id" />
              </div>
            </div>
          
          
            <div class="col-xs-10 col-xs-offset-2">
				<button type="submit" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-default">Reset</button>
            </div>
			
          </form>
		  <form action="login.php" method="post"  class="form-horizontal">
			<div class="col-xs-10 col-xs-offset-2">
        <br>
				<button type="submit" class="btn btn-primary">Logout</button>
            </div>
		  </form>
		  <form class="form-horizontal">
            <div class="form-group">
              
              <?php
				if(strcmp($grade,"any")){
					echo '<label for="Results" class="col-xs-2"> Results :- </label>';
					echo '<label class="col-xs-2">'.$grade.'</label>';
				}
			  ?>
            </div>
          
			
          </form>
        </div>
      </div>
    </div>
</body>
</html>