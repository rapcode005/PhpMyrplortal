<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>MYRPLPORTAL</title>
		<link rel="stylesheet" type="text/css" href="../link/css/style.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../link/css/w3.css">
		<link rel="stylesheet" type="text/css" href="../link/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		</script>
	</head>
<body>

<header>
	<nav class="w3-bar w3-blueh w3-border w3-small">
		<a href='index.php' class="w3-bar-item w3-button w3-blueh w3-hover-green">
		<i class="fa fa-home"></i></a>
		<?php 
			if (isset($_SESSION['u_r'])) {
				echo "<form action='../data/logout.php' method='POST' >
				<button type='submit' name='submitlogout'
				class='w3-bar-item w3-button w3-button w3-blueh w3-hover-green'>
				Logout</button>
				</form>";
			}
		?>
	</nav>
</header>