<?php
	if (isset($_POST['submitlogout'])) {
		session_start();
		session_unset();
		session_destroy();
		header("Location: ../index.php");
		exit();
	}
