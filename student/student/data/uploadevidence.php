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
				
		if ($resultCheck > 0) {
			if($fileError === 0) {
				
				while ($row = mysqli_fetch_assoc($resultallow)) {
					$filetypes = $row['filetype'];
				}
				
				//FolderName
				$foldername = $_SESSION['stdfname'].$_SESSION['stdgname'].$_SESSION['stdid'];
				$folder = "../../evidence/".$foldername."/";
				
				if (!file_exists($folder)) {
					mkdir($folder, 0777, true);
				}
				
				$fileDestionation = $folder.
				$fileName;
				move_uploaded_file($fileTmpName, 
				$fileDestionation);
				$insert = "INSERT INTO evidence(filename,filetype,stuid)
				VALUES('".$fileName."','".$filetypes."','".$_SESSION['stdid']."')";
				mysqli_query($conn,$insert);
				
				header("Location: ../evidence.php");
				
				
			}
			else {
				header("Location: ../evidence.php?error_upload");;
			}
		}
		else {
			header("Location: ../evidence.php?cannot_upload_file_not_supported");
		}
					
	}
