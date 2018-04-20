<?php
	
	session_start();
	
	if (isset($_POST['submit'])) {
	
		include_once 'dbh.php';
		
		$uid = mysqli_real_escape_string($conn,$_POST['uid']);
		$pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
		
		//Error handlers
		//Check if inputs are empty
		if (empty($uid) || empty($pwd)) {
			header("Location: ../index.php?login=empty");
			exit();
		}
		else {
			$sql = "SELECT * FROM user_profile WHERE username='".$uid."'";
			$result = mysqli_query($conn,$sql);
			$resultCheck = mysqli_num_rows($result);
			if ($resultCheck < 1) {
				header("Location: ../index.php?login=error");
				exit();
			}
			else {
				if ($row = mysqli_fetch_assoc($result)) {
					//De-hashing the password
					$hashedPwdCheck = password_verify($pwd,$row['password']);
					if ($hashedPwdCheck == false) {
						header("Location: ../index.php?login=error");
						exit();
					}
					elseif  ($hashedPwdCheck == true) {
						//Log in the user here
						$_SESSION['u_id'] = $row['userid'];
						$_SESSION['u_first'] = $row['userfname'];
						$_SESSION['u_last'] = $row['userlname'];
						$_SESSION['uid'] = $row['username'];
						$_SESSION['u_r'] = $row['userrole'];
						if ($row['userrole'] == "admin") {
							header("Location: ../admin/");
						}
						elseif ($row['userrole'] == "agent") {
							header("Location: ../student/");
						}
						elseif  ($row['userrole'] == "aser") {
							header("Location: ../assessor/");
						}
						exit();
					}
				}
			}
		}
	}
		