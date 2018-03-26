<?php
	include_once '../header.php';
?>

	<form class="newuser-form" 
		action="studentinfo.php" method="POST" >
		<button class="w3-button w3-blueh w3-hover-green"	
		type="submit" name="newuser">New Student</button>
	</form>
	<table class="w3-table">
		<thead>
			<tr>
				<th>Student Code</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Course</th>
				<th>Birthday</th>
				<th>Age</th>
				<?php
					if (isset($_SESSION['u_r'])) {
						if ($_SESSION['u_r'] == "agent") {
							echo "<th>Edit Infomration</th>";
						}
						elseif ($_SESSION['u_r'] == "assesor") {
							echo "<th>Edit Assesor</th>";
						}
					}
				?>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
<?php
	include_once '../footer.php';
?>

