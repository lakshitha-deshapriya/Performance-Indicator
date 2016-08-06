<?php
if(isset($_POST['edit'])){
	
	$data_missing=array();
	
	
	if(empty($_POST['username'])){
		$data_missing[]='username';
	}else{
		$user=trim($_POST['username']);
	}
	if(empty($_POST['course_id'])){
		$data_missing[]='course_id';
	}else{
		$cid=trim($_POST['course_id']);
	}
	if(empty($_POST['course_name'])){
		$data_missing[]='course_name';
	}else{
		$cname=trim($_POST['course_name']);
	}
	if(empty($_POST['semester'])){
		$data_missing[]='semester';
	}else{
		$semi=trim($_POST['semester']);
	}
	if(empty($_POST['grade'])){
		$data_missing[]='grade';
	}else{
		$grade=trim($_POST['grade']);
	}
	if(empty($_POST['gpa'])){
		$data_missing[]='gpa';
	}else{
		$gpa=trim($_POST['gpa']);
	}
    
	if(empty($data_missing)){
		$message="Edited Successfully!";
				echo "<script type='text/javascript'>alert('$message');</script>";
		
		require_once('../mys.php');
		
		
		
		$q1="select username,course_id from course";
		
		$response=@mysqli_query($con,$q1);		
		$count1=1;
		
		
		while($row=mysqli_fetch_array($response)){
			if($row['username']==$user && $row['course_id']==$cid){
				$count1=0;
			}
		}
		
		if($count1==0 ){
			
			
			$query= "Update course set course_name=?,semester=?,grade=?,gpa=? where username=? AND course_id=?";
            $statement=mysqli_prepare($con,$query);
			
		    mysqli_stmt_bind_param($statement,"sissss",
						$cname,$semi,$grade,$gpa,$user,$cid);
						
			mysqli_stmt_execute($statement);
			if (!$statement) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
	
			$affected_rows=mysqli_stmt_affected_rows($statement);
			
	
			if($affected_rows==1){
		
				$message="Edited Successfully!";
				echo "<script type='text/javascript'>alert('$message');</script>";
			
				mysqli_stmt_close($statement);
				mysqli_close($con);
		
			}else{
				$message="Error Occured When Updating";
				echo "<script type='text/javascript'>alert('$message');</script>";
				
				echo mysqli_error($statement);
				
		
				mysqli_stmt_close($statement);
			    mysqli_close($con);
			}
			
		}
		
	
	}else{
		echo "You need to enter following data<br />";
		
		foreach($data_missing as $missing) {
			echo "$missing<br />";
			
		}
		
	}


}
?>

