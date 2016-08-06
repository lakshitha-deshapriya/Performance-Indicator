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
	background-color: red;			
	color: white;		}			      

	table.two tr {	
	height: 1em;	}

  div.bod{

    margin-left: 20.5em;

  }
	
	</style>
	<div class="freshdesignweb-top">
                
            <span class="right"> </span>
                    
			<div class="clr"></div>
            </div>
			<header>
				<h1> <?php  echo " Hi " . $_SESSION['user'] ?> </h1>
            </header> 

  <div id='cssmenu'>
      <ul>
          <li><a href="student.php"><span>Add Grades</span></a></li>
          <li><a href="ExtraCurAct.php"><span>Add Extra Curricular Activities</span></a></li>
		  <li><a href="myperformance.php"><span>My Performance</span></a></li>
          <li class='last'><a href=""><span>Performance</span></a></li>
      </ul>
      </div>

  <div class="bod">
	<table class="two">
	<caption><h1>PERFORMANCE</h1></caption>
	<tr>
    <th>REG. NO.</th>
    <th>NAME</th> 
    <th>RANK</th>
  </tr>
  <tr>
    <td>E/12/100</td>
    <td>Nimal</td> 
    <td>20</td>
  </tr>
  <tr>
    <td>E/12/345</td>
    <td>Supun</td> 
    <td>18</td>
  </tr>
    <tr>
    <td>E/12/277</td>
    <td>Wicky</td> 
    <td>35</td>
  </tr>
    <tr>
    <td>E/12/125</td>
    <td>Donald</td> 
    <td>29</td>
  </tr>
   </tr>
    <tr>
    <td>E/12/289</td>
    <td>Bhagya</td> 
    <td>15</td>
  </tr>
  <tr>
    <td>E/12/300</td>
    <td>Ruwan</td> 
    <td>1</td>
  </tr>
  <tr>
    <td>E/12/389</td>
    <td>Nazir</td> 
    <td>21</td>
  </tr>
  <tr>
    <td>E/12/007</td>
    <td>Bhashitha</td> 
    <td>31</td>
  </tr>
  <tr>
    <td>E/12/400</td>
    <td>Lahiru</td> 
    <td>50</td>
  </tr>
  <tr>
    <td>E/12/259</td>
    <td>Nuwan</td> 
    <td>35</td>
  </tr>
  <tr>
    <td>E/12/309</td>
    <td>Yeshan</td> 
    <td>45</td>
  </tr>
  <tr>
    <td>E/12/302</td>
    <td>Wasana</td> 
    <td>29</td>
  </tr>
  <tr>
    <td>E/12/200</td>
    <td>Kasun</td> 
    <td>55</td>
  </tr>
  <tr>
    <td>E/12/123</td>
    <td>Manoj</td> 
    <td>9</td>
  </tr>
  <tr>
    <td>E/12/409</td>
    <td>Onila</td> 
    <td>3</td>
  </tr>
</table>

</div>
	
</body>
</html>
