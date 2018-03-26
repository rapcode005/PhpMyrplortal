<?php

	if (isset($_POST['submitsignup'])) {
		include 'dbh.php';
		
		$first = mysqli_real_escape_string($conn, $_POST['fname']);
		$last = mysqli_real_escape_string($conn, $_POST['lname']);
		$uid = mysqli_real_escape_string($conn, $_POST['uid']);
		$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
		$ur = mysqli_real_escape_string($conn, $_POST['ur']);
		
		//Error handlers
		//Check for empty fields
		if (empty($first) || empty($last) || $ur == 'userrole' || 
			empty($uid) || empty($pwd)) {
			header("Location: ../adminhome.php?signup=empty");
			exit();
		}
		else {
			
			//Check if username already exist in database
			$sql = "SELECT * FROM user_profile WHERE username = '".$uid."'";
			$result =  mysqli_query($conn, $sql);
			$resultcheck = mysqli_num_rows($result);
			if ($resultcheck >= 1) {
				header("Location: ../adminhome.php?signup=usernametaken");
				exit();
			}
			else {
				//Hashing Password
				$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
				//Insert the user into the database
				$sqlInsert = "INSERT INTO user_profile(userfname,userlname,username,
				password,userrole) 
				VALUES('$first','$last','$uid','$hashedPwd','$ur');";
				if (mysqli_query($conn,$sqlInsert)) {
					header("Location: ../adminhome.php");
				} 
				else {
					echo mysqli_error($conn);
				}
				exit();
			}
			
		}
	}
	else {
		header("Location: ../adminhome.php");
		exit();
	}