
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

?>

<html>
<head>
	<title>Outsiders</title>

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
	background-color: 66A1CE;			
	color: black;		}			      

	table.two tr {	
	height: 1em;	}

  div.bod{

    margin-left: 13.5em;
    margin-top: 2em;
  }
	
	</style>
	<div class="freshdesignweb-top">
                
            <span class="right"> </span>
                    
			<div class="clr"></div>
            </div>
			

  <div id='cssmenu'>

			<ul>
   				<li><a href="admin.php"><span>Add Account</span></a></li>
   				<li class='last'><a a href="outside.php"><span>Outsiders</span></a></li>
			</ul>
			</div>

  <div class="bod">
	<table class="two">
	<tr>
    <th>Username</th>
    <th>First Name</th> 
	<th>company</th> 
	<th>Position</th> 
  </tr>
  
	<?php
		
		$query="select username,fname,company,position from outsiders";
		
		$responce=@mysqli_query($con,$query);
			
		while($row=mysqli_fetch_array($responce)){
			echo '<tr><td>'.
			$row['username'].'</td><td>'.
			$row['fname'].'</td><td>'.
			$row['company'].'</td><td>'.
			$row['position'].'</td></tr>';
		}
		echo '</table></div>'
		
		
	?>
  

</body>
</html>


