<?php 
	include_once '../header.php';
	include_once '../data/dbh.php';
	include_once 'menu.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
?>

<div class="w3-main" style="width:25%">
	<button class="w3-button w3-blueh w3-hover-green w3-teal w3-xlarge w3-hide-large" 
	onclick="w3_open()">&#9776;</button>
</div>


<div style="margin-left:220px; margin-top:16px;" >
	<form action="data/uploadevidence.php" method="POST" enctype="multipart/form-data">
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
		style="width:26.5%; margin-top:20px;">
			<input type='file' id='file' name='file' class="w3-blueh w3-hover-green 
				w3-border" />
			<button type="submit" name="submitupload" 
				class="w3-blueh w3-hover-green 
				w3-border">Upload</button>
		</div>
	</form>	
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
		style="width:50%; margin-top:20px;">
			<table class="w3-table">
				<?php
					echo "<form action='data/removefile.php' method='POST'><tr>
							<th>File Name</th>
							<th>File Type</th>
							<th>Remove</th>
						</tr>";
						
					include_once '../data/dbh.php';
							
					$sql = "SELECT filename,filetype,id FROM evidence
					WHERE stuid='".$_SESSION['stdid']."'";
							
					$result = mysqli_query($conn, $sql);
					
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>".$row['filename']."
						<input type='hidden' name='filename' value='".$row['filename']."'/>
						</td><td>".$row['filetype']."</td><td>
						<button type='submit' name='submit' 
						class='w3-blueh w3-hover-green w3-padding-large
						w3-border w3-large' value=".$row['id'].">Remove
						</button></td>";
						echo "</tr></form>";
					}

					echo "</form>";
				?>
			</table>
		</div>
</div>

<?php
	include_once '../footer.php';
?>