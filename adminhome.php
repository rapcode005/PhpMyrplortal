<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>MYRPLPORTAL</title>
		<link rel="stylesheet" type="text/css" href="link/css/style.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="link/css/w3.css">
		<link rel="stylesheet" type="text/css" href="link/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		</script>
	</head>
<body>

<header>
	<nav class="w3-bar w3-blueh w3-border w3-large" style="font-family: Arial, Helvetica, sans-serif;">
		<button onclick="myFunction('signup')" type='submit'
				class='w3-bar-item w3-button w3-blueh w3-hover-green'>
				Sign up</button>
		<?php 
			if (isset($_SESSION['u_r'])) {
				//Logout
				echo "<form action='data/logout.php' method='POST' >
				<button type='submit' name='submitlogout'
				class='w3-bar-item w3-button w3-button w3-blueh w3-hover-green w3-right'>
				Logout</i></button>
				</form>";
				//Search
				echo "<form action='data/logout.php' method='POST' >
				<input type='text' 
				class='w3-bar-item w3-input w4-grayh' placeholder='Search User..'>
				<button type='submit' name='submitlogout'
				class='w3-bar-item w3-button w3-blueh w3-hover-green'>
				Go</button>
				</form>";
			}
		?>
	</nav>
</header>

<div id="signup" class="w3-container w3-greyb w3-card-4 w3-padding-large w3-hide w3-small"
	style="width:40%; margin-left:20px; margin-top:16px; font-family: Arial, Helvetica, sans-serif">
	<form action="data/signup-codes.php" method="POST">
		<p style="margin-top:20px;">
		<input type="text" name="uid"  placeholder="Username" 
		class='w3-input w3-border w3-animate-input'
		style='width:200px'/></p>
		<p style="margin-top:20px;">
		<input type="password" name="pwd" placeholder="Password" 
		class='w3-input w3-border w3-animate-input'
		style='width:200px' /></p>
		<p style="margin-top:20px;">
		<input type="text" name="fname" placeholder="Firstname" 
		class='w3-input w3-border w3-animate-input'
		style='width:200px' /></p>
		<p style="margin-top:20px;">
		<input type="text" name="lname" placeholder="Lastname" 
		class='w3-input w3-border w3-animate-input'
		style='width:200px' /></p>
		<p style="margin-top:20px;">
		<select name="ur" class='w3-select w3-select-input' style='width:200px'>
			<option value="userrole">Select a User Role</option>
			<option value="admin">Admin</option>
			<option value="agent">Agent</option>
			<option value="aser">Assessor</option>
		</select></p>
		<p style="margin-top:20px;">
		<button type="submit" name="submitsignup"
		class="w3-blueh w3-hover-green w3-padding-large
								w3-border w3-large w3-right" >Save</button></p>
	</form>
</div>

<script>
	function myFunction(id) {
		var x = document.getElementById(id);
		if (x.className.indexOf("w3-show") == -1) {
			x.className += " w3-show";
		} else { 
			x.className = x.className.replace(" w3-show", "");
		}
	}
</script>
<table class="w3-table-all" style="font-family: Arial, Helvetica, sans-serif; margin-top:20px;">
	<thead>
		<tr class="w3-blueh">
			<th>Username</th>
			<th>Firstname</th>
			<th>Lastname</th>
			<th>User Role</th>
		</tr>
	</thead>
	<tbody class="w3-small">
		<?php 
			include_once 'data/dbh.php';
			$sql = "SELECT username,userfname,userlname,userrole
			FROM user_profile;";
			$result = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				
				echo "<td>".$row['username']."</td>
				<td>".$row['userfname']."</td>
				<td>".$row['userlname']."</td>
				<td>".$row['userrole']."</td>";
				
				echo "</tr>";
			}
		?>
	</tbody>
</table>
<?php
	include_once 'footer.php';
?>

