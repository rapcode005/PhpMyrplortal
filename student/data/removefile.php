<?php
	include_once '../../data/dbh.php';
	session_start();
	if(isset($_POST['submit'])) {
		$id = $_POST['submit'];
		$h = $_POST['h'];
		$delete = "DELETE FROM evidence WHERE id='".$id."'";
		if(mysqli_query($conn,$delete)){
			$foldername = $_SESSION['stdfname'].$_SESSION['stdgname'].$_SESSION['stdid'];
			$filename = $_POST['filename'];
			unlink("../../evidence/".$foldername."/".$filename);
			header("Location: ../evidence.php?h=".$h."&sr=success");
		}
	}