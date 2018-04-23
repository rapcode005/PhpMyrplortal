<?php

if (isset($_GET['cnt'])) {
	$cnt = base64_decode(urldecode($_GET['cnt']));
	echo "<div class='w3-container w3-card-4'
			style='width:50%; margin-top:20px;'><h6><b>Comment: </b>".$cnt."</h6></div>";
}