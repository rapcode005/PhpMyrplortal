<?php
	include_once '../../data/dbh.php';
	session_start();
	if(isset($_POST['submit'])) {
		$id = $_POST['submit'];
		
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
		
		$delete = "DELETE FROM evidence WHERE id='".$id."'";
		if(mysqli_query($conn,$delete)){
			$foldername = $fn.$gn.$idp;
			$filename = $_POST['filename'];
			unlink("../../evidence/".$foldername."/".$filename);
			header("Location: ../evidencedt.php?".$urlquery."&sr=success");
		}
	}
	else {
		echo $_POST['filename'];
	}