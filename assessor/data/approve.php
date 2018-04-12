<?php

	include_once '../../data/dbh.php';
		
	$id = urlencode(base64_encode($_GET['ptid']));
	$nid = $_GET['nid'];
	
	//Link
	$linkfn = $_GET['fnm'];
	$linkgn = $_GET['gnm'];
	$linkid = $_GET['ptid'];
	$querystr = "ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=st";
	
	
	$update = "UPDATE notification SET status = 1
	WHERE id =".$nid;
	
	if (mysqli_query($conn, $update)) {
		header("Location: ../studentinfo.php?".$querystr."&success");
	}