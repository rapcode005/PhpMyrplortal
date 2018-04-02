<?php 
	include_once '../header.php';
	include_once 'menu.php';
	include_once '../data/dbh.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
?>

<div class="w3-main" style="width:25%">
	<button class="w3-button w3-blueh w3-hover-green w3-teal w3-xlarge w3-hide-large" 
	onclick="w3_open()">&#9776;</button>
</div>



<?php
	include_once '../footer.php';
?>