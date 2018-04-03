<?php
	include_once 'headerhomeadmin.php';
?>

<section class="main-container">
	<div class="main-wrapperC">
		<button onclick="myFunction('signup')" 
		class="w3-button w3-left-align w3-blueh w3-hover-green">
		Sign up</button> 
		<div id="signup" class="w3-container w3-hide">
			<form class="signup-form" action="data/signup-codes.php" method="POST">
				<input type="text" name="uid" placeholder="Username" />
				<input type="password" name="pwd" placeholder="Password" />
				<input type="text" name="fname" placeholder="Firstname" />
				<input type="text" name="lname" placeholder="Lastname" />
				<select name="ur">
					<option value="userrole">Select a User Role</option>
					<option value="admin">Admin</option>
					<option value="agent">Agent</option>
					<option value="aser">Assessor</option>
				</select>
				<button type="submit" name="submitsignup"
				class="w3-blueh w3-hover-green" >Save</button>
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
		<table>
			<thead>
				<tr>
					<th>Username</th>
					<th>Firstname</th>
					<th>Lastname</th>
					<th>User Role</th>
				</tr>
			</thead>
			<tbody>
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
	</div>
</section>
<?php
	include_once 'footer.php';
?>

