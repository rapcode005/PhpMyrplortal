<?php
	
	session_start();
	
	include_once '../../data/dbh.php';
	
	if (isset($_POST['submitupload'])) {
		$fileName = $_FILES['file']['name'];
		$fileTmpName= $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileError = $_FILES['file']['error'];
		$fileType = $_FILES['file']['type'];
		
		$fileExt = explode('.',$fileName);
		$fileActualExt = strtolower(end($fileExt));
		
		//Get All Allowed File ext.
		$sqlallow = "SELECT filetype FROM fileextinfo
		WHERE extfile='".$fileActualExt."';";
		
		$resultallow  = mysqli_query($conn,$sqlallow);
		
		$resultCheck = mysqli_num_rows($resultallow);
		
		//Original Value
		$iden = $_POST['ptid'];
		$fnen = $_POST['fnm'];
		$gnen = $_POST['gnm'];
		$h = $_POST['h'];
		$urlquery = "ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."&h=".$h;
		
		if ($resultCheck > 0) {
			if($fileError === 0) {
				
				while ($row = mysqli_fetch_assoc($resultallow)) {
					$filetypes = $row['filetype'];
				}
				
				//Decode
				$id = base64_decode(urldecode($iden));
				$fn = base64_decode(urldecode($fnen));
				$gn = base64_decode(urldecode($gnen));
				
				//FolderName
				$foldername = $fn.$gn.$id;
				$folder = "../../evidence/".$foldername."/";
				
				if (!file_exists($folder)) {
					mkdir($folder, 0777, true);
				}
				
				$fileDestionation = $folder.
				$fileName;
				move_uploaded_file($fileTmpName, 
				$fileDestionation);
				$insert = "INSERT INTO evidence(filename,filetype,stuid)
				VALUES('".$fileName."','".$filetypes."','".$id."')";
				mysqli_query($conn,$insert);
				
				//Check if for notification	
				if (isset($_POST['n']) && isset($_POST['nid']) &&
					 !empty($_POST['n']) && !empty($_POST['nid'])) {
					$userid = $_SESSION['u_id'];
					$notifyid =$_POST['nid'];
					$updatenotify = "UPDATE notification SET updateduserid=".$userid." 
					WHERE id = ".$notifyid;
					if(mysqli_query($GLOBALS['conn'],$updatenotify)) {
						header("Location: ../evidencedt.php?".$urlquery."&s=success");
					}
				}
				else {
					header("Location: ../evidencedt.php?".$urlquery."&s=success");
				}
				
				
				
				
			}
			else {
				header("Location: ../evidencedt.php?".$urlquery."&error=upload");;
			}
		}
		else {
			header("Location: ../evidencedt.php?".$urlquery."&selecterror=please_select");
		}
					
	}
