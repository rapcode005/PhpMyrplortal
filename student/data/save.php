<?php
	
	if (isset($_POST['submitsave'])) {
		include '../../data/dbh.php';
		
		//Insert Personal Details
		$stcode = mysqli_real_escape_string($conn, $_POST['stdcode']);
		$stfname = mysqli_real_escape_string($conn, $_POST['stdfname']);
		$stgname = mysqli_real_escape_string($conn, $_POST['stdgname']);
		$stpname = mysqli_real_escape_string($conn, $_POST['stdpname']);
		$stbth = mysqli_real_escape_string($conn, $_POST['stdbth']);
		$stage = mysqli_real_escape_string($conn, $_POST['stdage']);
		$course = mysqli_real_escape_string($conn,$_POST['optcourse']);
		
		$sqlper = "SELECT IFNULL(max(id),0) as maxid FROM personaldt";
		$resultper = mysqli_query($conn,$sqlper);
		
		if ($row = mysqli_fetch_assoc($resultper)) {
			$maxid = $row['maxid'];
		}
		
		$maxid += 1;
		
		$insertper = "INSERT INTO personaldt(code,fname,gname,pname,brhday,age)
		VALUES('$stcode','$stfname','$stgname','$stpname','$stbth','$stage');";
		
		if (mysqli_query($conn,$insertper)) {
			
			$insertstud ="INSERT INTO studentinfo(stdcode,stdcourse) 
			VALUES(".$maxid.",'$course');";
			
			if (mysqli_query($conn,$insertstud)) {
				header("Location: ../index.php");
			}
			else {
				echo mysqli_error($conn);
			}
			exit();
		} 
		else {
			echo mysqli_error($conn);
			exit();
		}
		
	}

?>