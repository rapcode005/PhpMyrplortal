<?php

if (isset($_GET['cnt']) && isset($_GET['nid'])) {
	$cnt = base64_decode(urldecode($_GET['cnt']));
	
	$linkid = urlencode(base64_encode($ptid));
	$linkfn = urlencode(base64_encode($_SESSION['stdfname']));
	$linkgn = urlencode(base64_encode($_SESSION['stdgname']));
	
	$notifyid = $_GET['nid'];
	
	echo "<div class='w3-display-bottom'>";
	
	echo "<div class='w3-white w3-bar w3-card-4 w3-padding-large'
			style='margin-top:20px; width: 100%'>";
	
	echo "<h6><b>Comment: </b>".$cnt."</h6>";
	
	//button update
	echo "<a 
	class='w3-blueh w3-hover-green w3-padding-large w3-border w3-medium w3-button' 
	href='data/approve.php?ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=st
	&nid=".$notifyid."'>
	Approve</a>";
	
	echo "</div></div>";
}