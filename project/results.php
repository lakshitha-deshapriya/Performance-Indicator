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

  <h1> Grades Of The Students </h1>

  
		<div class="container">
      <!-- Horizonatal Form -->
      <div class="row">
        <div class="col-xs-6">
          <form action="results2.php" method="post"  class="form-horizontal">
            <div class="form-group">
              <label for="course_id" class="col-xs-2"> Course Id :- </label>
              <div class="col-xs-10">
                <input id="1" name="course_id" type="text" class="form-control" id="course_id" placeholder="Course Id" />
			
              </div>
            </div>
          
            <div class="form-group">
              <label for="batch" class="col-xs-2"> Batch :- </label>
              <div class="col-xs-10">
                <input id="2" name="batch" type="text" class="form-control" id="batch" placeholder="Batch" />
              </div>
            </div>
          
          
            <div class="col-xs-10 col-xs-offset-2">
              <button type="submit" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-default">Reset</button>
            </div>
			
          </form>
		 
        </div>
      </div>
    </div>

	<table class="one">
<tr>

	<style type="text/css">
	
	table {
		font-family: "Lato","sans-serif";

    }		

	table caption {
		padding-bottom: 1em;

    }

	table.one {									 
	margin-bottom: 7em;	
	border-collapse:collapse;
	display: inline-block;
	
  margin-left: auto;
  margin-right: auto;
  padding-top: 40px;



  }	

	
	table.one td {								
	text-align: center;     
	width: 10em;					
	padding-top: 1em;

  }		


	table.one th {								
	text-align: center;					
	padding: 1em;
	background-color: #e8503a;			
	color: white;	

  }			      

	table.one tr {	
	height: 1em;

  }

	table.one tr:nth-child(even) {			
    background-color: #eee;

    }

	table.one tr:nth-child(odd) {			
	background-color:#fff;

  }

  h1 {

    text-align: center;
    padding-bottom: 20px;

  }

  body {

    background: url("kwallpaper.png");

  }
	

	</style>

	

</body>
</html>
