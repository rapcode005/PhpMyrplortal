<?php

if (isset($_GET['cnt']) && isset($_GET['fnm']) &&
isset($_GET['gnm']) && isset($_GET['nid'])) {
	$cnt = base64_decode(urldecode($_GET['cnt']));
	
	$linkid = $_GET['ptid'];
	$linkfn = $_GET['fnm'];
	$linkgn = $_GET['gnm'];
	
	$notifyid = $_GET['nid'];
	
	echo "<div class='w3-display-bottom'>";
	
	echo "<div class=' w3-card-4 w3-padding-large'
			style='width:50%; margin-top:20px;'>
			<h6 style='margin-bottom:20px;'><b>Comment: </b>".$cnt."</h6>";
	//button update
	echo "<a 
	class='w3-button w3-blueh w3-hover-green w3-padding-large w3-border' 
	href='data/approve.php?ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=rf
	&nid=".$notifyid."'>
	Approve</a></div></div>";
}