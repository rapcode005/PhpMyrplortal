<?php
	include_once '../header.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
?>

	<form class="newuser-form" 
		action="studentinfo.php" method="POST" >
		<button class="w3-button w3-blueh w3-hover-green"	
		type="submit" name="newuser">New Student</button>
	</form>
	<table class="w3-table">
		<thead>
			<tr>
				<th>Family Name</th>
				<th>Given Name</th>
				<th>Course</th>
				<th>Birthday</th>
				<th>Age</th>
				<th>Show Details</th>
			</tr>
		</thead>
		<tbody>
			<?php
				include_once '../data/dbh.php';
			
				$sql = "SELECT b.fname as fname,b.gname as gname,c.descrp as descrp,
				b.brhday as brhday,b.age as age,a.id as id FROM studentinfo a 
				LEFT JOIN personaldt b on a.stdcode = b.id 
				LEFT JOIN courselist c on a.stdcourse = c.code";
				
				$result = mysqli_query($conn, $sql);
				
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$row['fname']."</td><td>".$row['gname']."</td><td>"
					.$row['descrp']."</td><td>".$row['brhday']."</td><td>"
					.$row['age']."</td><td><a 
					class='w3-blueh w3-hover-green w3-padding-large
					w3-border' href='studentdt.php?ptid=".$row['id']."'>Summary</a></td>
					</tr>";
				}
			?>
		</tbody>
	</table>
<?php
	include_once '../footer.php';
?>

