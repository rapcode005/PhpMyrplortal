<?php

	include_once '../../data/dbh.php';
	session_start();
	if(isset($_POST['submit'])) {
		$id = $_POST['submit'];
		
		//Original Value
		$iden = $_POST['ptid'];
		$fnen = $_POST['fnm'];
		$gnen = $_POST['gnm'];
		$urlquery = "ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen;
		
		//Decode
		$idp = base64_decode(urldecode($iden));
		$fn = base64_decode(urldecode($fnen));
		$gn = base64_decode(urldecode($gnen));
				
		$foldername = $fn.$gn.$idp;
		
		if (isset($_POST['fileref'])) {
			
			$filename = $_POST['fileref'];
			
			$filepath = "../../reference/".$foldername."/".$filename;
			
			if (unlink($filepath)) {
				echo "File was deleted";
				$delete = "DELETE FROM reference WHERE id='".$id."'";
				if(mysqli_query($conn,$delete)){
					
					header("Location: ../referencedt.php?".$urlquery);
				}
			}
			else {
				echo "File was not deleted";
			}
		
		}
		else
			echo "Rap";
		
	}