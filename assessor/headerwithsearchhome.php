<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
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
	<nav class="w3-bar w3-blueh w3-border w3-large" style="font-family: Arial, Helvetica, sans-serif;">
		<a href='../assessor/' class="w3-bar-item w3-button w3-blueh w3-hover-green"
		style="margin-right:55px;">
		MYRPLPORTAL</a>
		<?php 
			if (isset($_SESSION['u_r'])) {
							
				//Search
				if (isset($_GET['st']) && !empty($_GET['st'])) {
					
					$search = $_GET['st'];
					
					echo "<form action='../assessor/' method='GET' >
					<input type='text' name='st'
					class='w3-bar-item w3-input w4-grayh'
					value='".$search."'
					placeholder='Search Student..'>
					<button type='submit' name='submitsearch'
					class='w3-bar-item w3-button w3-blueh w3-hover-green'
					value='search'>
					Go</button>
					</form>";
					
				}
				else {
					
					echo "<form action='../assessor/' method='GET' >
					<input type='text' name='st'
					class='w3-bar-item w3-input w4-grayh' placeholder='Search Student..'>
					<button type='submit' name='submitsearch'
					class='w3-bar-item w3-button w3-blueh w3-hover-green'
					value='search'>
					Go</button>
					</form>";
					
				}
				
				//Logout
				echo "<form action='../data/logout.php' method='POST' >
				<button type='submit' name='submitlogout'
				class='w3-bar-item w3-button w3-button w3-blueh w3-hover-green' style='float: right;'>
				Logout</button>
				</form>";
			}
		?>
		
		<!-- Notification -->
		<div class="w3-dropdown-hover w3-blueh w3-right">
			<button class="w3-button w3-blueh w3-hover-green">
			<i class='fa fa-bell'><span id="bdnum" class="badge1"></i>
			</button >
			<div id="notify" class="w3-dropdown-content w3-bar-block w3-card-4" 
			style="right:0">
			</div>
		</div>
		
		<script>
		$(document).ready(function(){
			function load_unseen_notification() {
				$.ajax({
					url:"data/fetch.php",
					type:"POST",
					dataType:"json",
					contentType: "application/json; charset=utf-8",
					success:function(data) {
						$('#notify').html(data.notification);
							if(data.count > 0) {
								//$('#bdnum').html(data.count);
								$('#bdnum').attr('data-badge',data.count);
							}
					}
				});
			}
			
			load_unseen_notification();

			// load new notifications
			$(document).on('click', '.dropdown-toggle', function(){

				//$('.count').html('');

				load_unseen_notification();

			});

			setInterval(function(){

				load_unseen_notification();;

			}, 5000);
			
		});
	</script>
		
	</nav>
</header>