<?php
session_start();

$user=$_SESSION['user'];
$batch=$_POST['batch'];
$grade=$_POST['grade'];
$course_id=$_POST['course_id'];

$_SESSION['grade']=$grade;
$_SESSION['batch']=$batch;
$_SESSION['course_id']=$course_id;

$prev_ave_gpa=0.0;
$totalcredit=0.0;
$totalcumilative=0.0;
$prev_repeated=false;
$cumilative=0.0;
$up=false;
$location="0";

require_once('../mys.php');

$query1="select course_id from courses";

$responce1=@mysqli_query($con,$query1);

$alert="0";

while($row = mysqli_fetch_array($responce1)){
	if(!strcmp($course_id,$row['course_id'])){
		$alert="1";
	}
}
if($alert=="0"){
	$_SESSION['msg']="1";
	header("Location: student.php");
}else{
	$entered=1;
	if($grade=='A'){$gp =4.0;} else if ($grade=='A+'){$gp =4.0;} else if($grade=='A-'){$gp=3.7;} else if($grade=='B+'){$gp=3.3;}
	else if($grade=='B'){$gp=3.0;} else if($grade=='B-'){$gp=2.7;} else if($grade=='C+'){$gp=2.3;} else if($grade=='C'){$gp=2.0;}  else if($grade=='C-'){$gp=1.7;}
	else if($grade=='D+'){$gp=1.3;} else if($grade=='D'){$gp=1.0;} else if($grade=='E'){$gp=0.0;} else{
		$_SESSION['msg']="2";
		header("Location: student.php");
		$entered=0;
	}
	$_SESSION['gp']=$gp;
	
	if($entered){

		$query3="select course_name,credit,type,semester from courses where course_id='$course_id'";

		$responce=@mysqli_query($con,$query3);

		while($row=mysqli_fetch_array($responce)){
			$course_name=$row['course_name'];
			$credit=$row['credit'];
			$type=$row['type'];
			$semester=$row['semester'];
		}
		$_SESSION['credit']=$credit;
		$_SESSION['type']=$type;

		$query="select course_id from results where username='$user'";

		$responce2=@mysqli_query($con,$query);
		$row1="0";

		while($row=mysqli_fetch_array($responce2)){
			if(!strcmp($row['course_id'],$course_id)){
				$row1="1";
			}
		}
		$query5="select ave_gpa,totalcredit,totalcumilative,repeated from student where username='$user'";

		$responce=@mysqli_query($con,$query5);

		while($row=mysqli_fetch_array($responce)){
			$up=true;
			$prev_ave_gpa=$row['ave_gpa'];
			$totalcredit=$row['totalcredit'];
			$totalcumilative=$row['totalcumilative'];
			$prev_repeated=$row['repeated'];
		}
		$_SESSION['totalcumilative']=$totalcumilative;
		$_SESSION['totalcredit']=$totalcredit;
		$_SESSION['prev_repeated']=$prev_repeated;

		if($row1){
			$location="2";
		}else{
			
			if($type=='general'){
				$gpa=0.0;
				if($gp<2.0){
					$repeated=false;
					if($gp==1.7){$cumilative=$credit/2;} else if ($gp==1.3){$cumilative=(2*$credit/3);} else if ($gp==1.0) {$cumilative=$credit;} else if($gp==0.0){$repeated=true;} else {$cumilative=0.0;}
		
					require_once('../mys.php');
		
					$query4="insert into results(username,course_id,course_name,type,credit,semester,grade,gp,batch) values(?,?,?,?,?,?,?,?,?)";
		
					$statement=mysqli_prepare($con,$query4);
			
					mysqli_stmt_bind_param($statement,"ssssdssds",$user,$course_id,$course_name,$type,$credit,$semester,$grade,$gpa,$batch);
					mysqli_stmt_execute($statement);
		
					$affected_rows=mysqli_stmt_affected_rows($statement);
		
					mysqli_stmt_close($statement);
		
					if(!$repeated){
						$totalcredit=$totalcredit+$credit;
						$totalcumilative=$totalcumilative+$cumilative;
					}
		
					if($up){
						if(!$prev_repeated){
							$query7="update student set totalcredit='$totalcredit',totalcumilative='$totalcumilative',repeated='$repeated' where username='$user'";
							$statement=mysqli_prepare($con,$query7);
							mysqli_stmt_execute($statement);
			
							$affected_rows2=mysqli_stmt_affected_rows($statement);
			
							mysqli_stmt_close($statement);
			
							if($affected_rows and $affected_rows2){
								$_SESSION['msg']="3";
								$location="1";
							}
				
						}else{
							$query7="update student set totalcredit='$totalcredit',totalcumilative='$totalcumilative' where username='$user'";
							$statement=mysqli_prepare($con,$query7);
							mysqli_stmt_execute($statement);
			
							$affected_rows2=mysqli_stmt_affected_rows($statement);
			
							mysqli_stmt_close($statement);
			
							if($affected_rows and $affected_rows2){
								$_SESSION['msg']="3";
								$location="1";
							}
						}
					}else{
						$query6="insert into student(username,ave_gpa,totalcredit,totalcumilative,repeated) values(?,?,?,?,?)";
		
						$statement=mysqli_prepare($con,$query6);
		
						mysqli_stmt_bind_param($statement,"sddds",$user,$prev_ave_gpa,$totalcredit,$totalcumilative,$repeated);
						mysqli_stmt_execute($statement);
			
						$affected_rows3=mysqli_stmt_affected_rows($statement);
			
						if($affected_rows and $affected_rows3){
							$_SESSION['msg']="3";
							$location="1";
						}
					}
		
			
				}else{
					$repeated=false;
					require_once('../mys.php');
		
					$query4="insert into results(username,course_id,course_name,type,credit,semester,grade,gp,batch) values(?,?,?,?,?,?,?,?,?)";
		
					$statement=mysqli_prepare($con,$query4);
			
					mysqli_stmt_bind_param($statement,"ssssdssds",$user,$course_id,$course_name,$type,$credit,$semester,$grade,$gpa,$batch);
					mysqli_stmt_execute($statement);
		
					$affected_rows=mysqli_stmt_affected_rows($statement);
		
					mysqli_stmt_close($statement);
		
					$totalcredit=$totalcredit+$credit;
					$totalcumilative=$totalcumilative+$cumilative;
		
					if($up){
						if(!$prev_repeated){
							$query7="update student set totalcredit='$totalcredit',totalcumilative='$totalcumilative',repeated='$repeated' where username='$user'";
							$statement=mysqli_prepare($con,$query7);
							mysqli_stmt_execute($statement);
			
							$affected_rows2=mysqli_stmt_affected_rows($statement);
			
							mysqli_stmt_close($statement);
			
							if($affected_rows and $affected_rows2){
								$_SESSION['msg']="3";
								$location="1";
							}
						}else{
							$query7="update student set totalcredit='$totalcredit',totalcumilative='$totalcumilative' where username='$user'";
							$statement=mysqli_prepare($con,$query7);
							mysqli_stmt_execute($statement);
			
							$affected_rows2=mysqli_stmt_affected_rows($statement);
			
							mysqli_stmt_close($statement);
			
							if($affected_rows and $affected_rows2){
								$_SESSION['msg']="3";
								$location="1";
							}
				
						}
					}else{
						$query6="insert into student(username,ave_gpa,totalcredit,totalcumilative,repeated) values(?,?,?,?,?)";
		
						$statement=mysqli_prepare($con,$query6);
		
						mysqli_stmt_bind_param($statement,"sddds",$user,$prev_ave_gpa,$totalcredit,$totalcumilative,$repeated);
						mysqli_stmt_execute($statement);
			
						$affected_rows3=mysqli_stmt_affected_rows($statement);
			
						if($affected_rows and $affected_rows3){
							$_SESSION['msg']="3";
							$location="1";
						}
					}
				}
	
			}else {
				if($gp<2.0){
					$repeated=false;
					if($gp==1.7){$cumilative=$credit/2;} else if ($gp==1.3){$cumilative=(2*$credit/3);} else if ($gp==1.0) {$cumilative=$credit;} else if($gp==0.0){$repeated=true;} else {$cumilative=0.0;}

					require_once('../mys.php');	
		
					$query4="insert into results(username,course_id,course_name,type,credit,semester,grade,gp,batch) values(?,?,?,?,?,?,?,?,?)";
		
					$statement=mysqli_prepare($con,$query4);
			
					mysqli_stmt_bind_param($statement,"ssssdssds",$user,$course_id,$course_name,$type,$credit,$semester,$grade,$gp,$batch);
					mysqli_stmt_execute($statement);
		
					$affected_rows=mysqli_stmt_affected_rows($statement);
		
					mysqli_stmt_close($statement);
		
					if(!$repeated){
						$totalcredit=$totalcredit+$credit;
						$totalcumilative=$totalcumilative+$cumilative;
					}
		
		
					if($up){
						require_once('../mys.php');
			
						$query8="select sum(gp*credit),sum(credit) from results where username='$user' and type!='general'";
			
						$responce=@mysqli_query($con,$query8);

						while($row=mysqli_fetch_array($responce)){
							$sumadd=$row['sum(gp*credit)'];
							$sumcredit=$row['sum(credit)'];
						}
			
						$ave_gpa=$sumadd/$sumcredit;
			
			
						if(!$prev_repeated){
							$query7="update student set totalcredit='$totalcredit',totalcumilative='$totalcumilative',repeated='$repeated',ave_gpa='$ave_gpa' where username='$user'";
							$statement=mysqli_prepare($con,$query7);
							mysqli_stmt_execute($statement);
			
							$affected_rows2=mysqli_stmt_affected_rows($statement);
			
							mysqli_stmt_close($statement);
			
							if($affected_rows and $affected_rows2){
								$_SESSION['msg']="3";
								$location="1";
							}
						}else{
							$query7="update student set totalcredit='$totalcredit',totalcumilative='$totalcumilative',ave_gpa='$ave_gpa' where username='$user'";
							$statement=mysqli_prepare($con,$query7);
							mysqli_stmt_execute($statement);
			
							$affected_rows2=mysqli_stmt_affected_rows($statement);
			
							mysqli_stmt_close($statement);
			
							if($affected_rows and $affected_rows2){
								$_SESSION['msg']="3";
								$location="1";
							}
						}
			
					}else{
						$query6="insert into student(username,ave_gpa,totalcredit,totalcumilative,repeated) values(?,?,?,?,?)";
		
						$statement=mysqli_prepare($con,$query6);
		
						mysqli_stmt_bind_param($statement,"sddds",$user,$gp,$totalcredit,$totalcumilative,$repeated);
						mysqli_stmt_execute($statement);
			
						$affected_rows3=mysqli_stmt_affected_rows($statement);
			
						if($affected_rows and $affected_rows3){
							$_SESSION['msg']="3";
							$location="1";
						}
					}	
				}else{
					$repeated=false;
					require_once('../mys.php');
		
					$query4="insert into results(username,course_id,course_name,type,credit,semester,grade,gp,batch) values(?,?,?,?,?,?,?,?,?)";
		
					$statement=mysqli_prepare($con,$query4);
			
					mysqli_stmt_bind_param($statement,"ssssdssds",$user,$course_id,$course_name,$type,$credit,$semester,$grade,$gp,$batch);
					mysqli_stmt_execute($statement);
		
					$affected_rows=mysqli_stmt_affected_rows($statement);
		
					mysqli_stmt_close($statement);
		
					$totalcredit=$totalcredit+$credit;
					$totalcumilative=$totalcumilative+$cumilative;
		
					if($up){
						require_once('../mys.php');
			
						$query8="select sum(gp*credit),sum(credit) from results where username='$user' and type!='general'";
			
						$responce=@mysqli_query($con,$query8);

						while($row=mysqli_fetch_array($responce)){
							$sumadd=$row['sum(gp*credit)'];
							$sumcredit=$row['sum(credit)'];
						}
			
						$ave_gpa=$sumadd/$sumcredit;
			
						if(!$prev_repeated){
							$query7="update student set totalcredit='$totalcredit',totalcumilative='$totalcumilative',repeated='$repeated',ave_gpa='$ave_gpa' where username='$user'";
							$responce=@mysqli_query($con,$query7);
			
							if($affected_rows and $responce){
								$_SESSION['msg']="3";
								$location="1";
							}
						}else{
							$query7="update student set totalcredit='$totalcredit',totalcumilative='$totalcumilative',ave_gpa='$ave_gpa' where username='$user'";
							$statement=mysqli_prepare($con,$query7);
							mysqli_stmt_execute($statement);
			
							$affected_rows2=mysqli_stmt_affected_rows($statement);
			
							mysqli_stmt_close($statement);
			
							if($affected_rows and $affected_rows2){
								$_SESSION['msg']="3";
								$location="1";
							}
						}
			
			
					}else{
						$query6="insert into student(username,ave_gpa,totalcredit,totalcumilative,repeated) values(?,?,?,?,?)";
		
						$statement=mysqli_prepare($con,$query6);
		
						mysqli_stmt_bind_param($statement,"sddds",$user,$prev_ave_gpa,$totalcredit,$totalcumilative,$repeated);
						mysqli_stmt_execute($statement);
			
						$affected_rows3=mysqli_stmt_affected_rows($statement);
			
						if($affected_rows and $affected_rows3){
							$_SESSION['msg']="3";
							$location="1";
						}
					}
		
				}
			}
			
		}
		if($location=="1"){
			header("Location:student.php");
		}else if($location=="2"){
			header("Location:edit2.php");
		}
	}
}



?>

