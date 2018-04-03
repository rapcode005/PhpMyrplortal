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
		
		$allowed = array('pdf','doc','dot','wbk','docx','docm','dotx',
		'dotm','docb','txt');
		
		if (in_array($fileActualExt, $allowed)) {
			if($fileError === 0) {
				
				//FolderName
				$foldername = $_SESSION['stdfname'].$_SESSION['stdgname'].$_SESSION['stdid'];
				$folder = "../../reference/".$foldername."/";
				
				if (!file_exists($folder)) {
					mkdir($folder, 0777, true);
				}
				
				$fileDestionation = $folder.
				$fileName;
				move_uploaded_file($fileTmpName, 
				$fileDestionation);
				$insert = "INSERT INTO reference(filename,stuid)
				VALUES('".$fileName."','".$_SESSION['stdid']."')";
				mysqli_query($conn,$insert);
				
				header("Location: ../reference.php");
				
				
			}
			else {
				header("Location: ../reference.php?error_upload");;
			}
		}
		else {
			header("Location: ../reference.php?cannot_upload_file_not_supported");
		}
					
	}
