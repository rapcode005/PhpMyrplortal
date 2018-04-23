<?php

	include_once '../../data/dbh.php';
		
	$id = urlencode(base64_encode($_GET['ptid']));
	$nid = $_GET['nid'];
	
	//Link
	$linkfn = $_GET['fnm'];
	$linkgn = $_GET['gnm'];
	$linkid = $_GET['ptid'];
	
	
	
	$update = "UPDATE notification SET status = 1
	WHERE id =".$nid;
	
	if (mysqli_query($conn, $update)) {
		if (isset($_GET['h'])) {
			$h = $_GET['h'];
			switch ($h) {
				case "st":
					$querystr = "ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=st";
					header("Location: ../studentinfo.php?".$querystr."&s=approve");
					break;
				case "rf":
					$querystr = "ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=rf";
					header("Location: ../reference.php?".$querystr."&s=approve");
					break;
				case "ev":
					$querystr = "ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=ev";
					header("Location: ../evidence.php?".$querystr."&s=approve");
					break;
			}
		}	
	}