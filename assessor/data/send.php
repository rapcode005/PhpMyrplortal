<?php

	include_once '../../data/dbh.php';
	session_start();
	
	if (isset($_POST['send'])) {
		$comment = mysqli_real_escape_string($conn, $_POST['comment']);
		$moduletype = mysqli_real_escape_string($conn, $_POST['moduletype']);
		
		//Original Value
		$iden = $_POST['ptid'];
		$fnen = $_POST['fnm'];
		$gnen = $_POST['gnm'];
		$h = $_POST['h'];
		$urlquery = "ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."&h=".$h;
		
		//Decode
		$idp = base64_decode(urldecode($iden));
		$fn = base64_decode(urldecode($fnen));
		$gn = base64_decode(urldecode($gnen));
		
		$userid = $_SESSION['u_id'];
		
		$insert = "Insert into notification(comment,date,stuid,type,
										createduserid,status)
								values('$comment',NOW(),'$idp','$moduletype',
								'$userid',0);";
								
		if(mysqli_query($conn,$insert)){
		
			header("Location: ../request.php?success=success&".$urlquery);
		
		}
		
	}