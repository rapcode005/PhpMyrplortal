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
				
		$foldername = $fn.$gn.$idp;
		
		if (isset($_POST['fileref'])) {
			
			$filename = $_POST['fileref'];
			
			$filepath = "../../reference/".$foldername."/".$filename;
			
			if (file_exists($filepath)) {
				if (unlink($filepath)) {
					$delete = "DELETE FROM reference WHERE id='".$id."'";
					if(mysqli_query($conn,$delete)){
						
						header("Location: ../referencedt.php?".$urlquery."&sr=success");
					}
				}
			}
			else {
			
				$delete = "DELETE FROM reference WHERE id='".$id."'";
					if(mysqli_query($conn,$delete)){
						
						header("Location: ../referencedt.php?".$urlquery."&sr=success");
					}
			
			}
		}
	}