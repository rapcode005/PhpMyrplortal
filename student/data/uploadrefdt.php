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
		
		//Original Value
		$iden = $_POST['ptid'];
		$fnen = $_POST['fnm'];
		$gnen = $_POST['gnm'];
		$urlquery = "ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen;
		
		if (in_array($fileActualExt, $allowed)) {
			if($fileError === 0) {
				
				//Decode
				$id = base64_decode(urldecode($iden));
				$fn = base64_decode(urldecode($fnen));
				$gn = base64_decode(urldecode($gnen));
				
				//FolderName
				$foldername = $fn.$gn.$id;
				$folder = "../../reference/".$foldername."/";
				
				if (!file_exists($folder)) {
					mkdir($folder, 0777, true);
				}
				
				$fileDestionation = $folder.
				$fileName;
				move_uploaded_file($fileTmpName, 
				$fileDestionation);
				$insert = "INSERT INTO reference(filename,stuid)
				VALUES('".$fileName."','".$id."')";
				mysqli_query($conn,$insert);
				
				header("Location: ../referencedt.php?".$urlquery);
				
				
			}
			else {
				header("Location: ../referencedt.php?".$urlquery."&error=error_upload");;
			}
		}
		else {
			header("Location: ../referencedt.php?".$urlquery."&error=cannot_upload_file_not_supported");
		}
					
	}