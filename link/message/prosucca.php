<?php
if (isset($_GET['s'])) {
	$s = $_GET['s'];
	switch ($s) {
		case "approve":
		case "success":
			echo "<h6>The proccess is successfully.</h6>";
			break;
		case "successupload":
			echo "<h6>The file has successfully uploaded.</h6>";
			break;
		case "please_select":
			echo "<h6 style='color: red'>Select a file before upload.</h6>";
			break;
		case "errorupload":
			echo "<h6 style='color: red'>File extension is not supported.</h6>";
			break;
		case "successremove":
			echo "<h6>The file has successfully removed.</h6>";
			break;
		case "requestsuccess":
			echo "<h6>The request has been successfully processed.</h6>";
			break;
	}
}
