<?php

	include_once '../../data/dbh.php';
	session_start();
	if(isset($_POST['submit'])) {
		$id = $_POST['submit'];
		$h = $_POST['h'];
		$foldername = $_SESSION['stdfname'].$_SESSION['stdgname'].$_SESSION['stdid'];
		
		if (isset($_POST['fileref'])) {
			
			$filename = $_POST['fileref'];
			
			$filepath = "../../reference/".$foldername."/".$filename;
			
			if (unlink($filepath)) {
				echo "File was deleted";
				$delete = "DELETE FROM reference WHERE id='".$id."'";
				if(mysqli_query($conn,$delete)){
					
					header("Location: ../reference.php?h=".$h."&s=successremove");
				}
			}
		}
		
	}