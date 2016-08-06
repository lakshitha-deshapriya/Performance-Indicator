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

?>

<html>
<head>
	<title>Performance</title>

  <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="navig_bar.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
</head>
<body>

	<style type="text/css">
	body{
    margin-left: 0em;
    margin-right: 0em;
    margin-top: 1em;
    background: url('kwallpaper.png') no-repeat fixed center center;
  }
	
	table {
		font-family: "Lato","sans-serif";
    font-size: 1.2em;
    	}	

	table caption {
		padding-bottom: 1em;		}

	table.two {									 
	margin-bottom: 3em;	
	border-collapse:collapse;
	display: inline-block;
	margin-right: 3em;		}	
	
	table.two td {								
	text-align: center;     
	width: 10em;
	border: 0.1em black solid;					
	padding: 1em; 		}		

	table.two th {								
	text-align: center;					
	padding: 1em;
	background-color: #66A1CE;			
	color: black;		}			      

	table.two tr {	
	height: 1em;	}

  div.bod{

    margin-left: 28em;

  }
	
	</style>
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

  <div class="bod">
	<table class="two">
	<caption><h1></h1></caption>
	<tr>
    <th>Reg. No</th>
    <th>Rank With Results</th> 
  </tr>
  
	<?php
		$query="select username from student order by ave_gpa desc";
		
		$responce=@mysqli_query($con,$query);
		
		$rank=1;
			
		while($row=mysqli_fetch_array($responce)){
			echo '<tr><td>'.
			$row['username'].'</td><td>'.
			$rank.'</td>';
			$rank=$rank+1;
		}
	?>
  
</table>

</div>
	
</body>
</html>
