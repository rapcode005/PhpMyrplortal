<?php 
	include_once 'headerwithoutsearch.php';
	include_once 'menuwithquerystr.php';
	include_once '../data/dbh.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
?>

<div class="w3-main" style="width:25%">
	<button class="w3-button w3-blueh w3-hover-green w3-teal w3-xlarge w3-hide-large" 
	onclick="w3_open()">&#9776;</button>
</div>


<div style="margin-left:220px; margin-top:16px;" >
	<form action="data/uploadevidencedt.php" method="POST" enctype="multipart/form-data">
		<div class="w3-container w3-white w3-card-4 w3-padding-large"
		style="width:26.5%; margin-top:20px;">
			<input type='file' id='file' name='file' class="w3-blueh w3-hover-green 
				w3-border" />
			<button type="submit" name="submitupload" 
				class="w3-blueh w3-hover-green 
				w3-border">Upload</button>
				<input type="hidden" name="fnm" 
			<?php 
				if(isset($_GET['fnm'])) {
					echo "Value='".$_GET['fnm']."'";	
				}
			?>
			/>
			<input type="hidden" name="gnm" 
			<?php 
				if(isset($_GET['gnm'])) {
					echo "Value='".$_GET['gnm']."'";	
				}
			?>
			/>
			<input type="hidden" name="ptid" 
			<?php 
				if(isset($_GET['ptid'])) {
					echo "Value='".$_GET['ptid']."'";	
				}
			?>
			/>
		</div>
	</form>	
		<div class="w3-container w3-white w3-card-4 w3-padding-large"
		style="width:50%; margin-top:20px;">
			<table class="w3-table">
				<?php
					echo "<tr>
							<th>File Name</th>
							<th>File Type</th>
							<th>Remove</th>
						</tr>";
						
					if(isset($_GET['ptid'])) {
						include_once '../data/dbh.php';
						
						//decode
						$ptid = base64_decode(urldecode($_GET['ptid']));
						
						$sql = "SELECT filename,filetype,id FROM evidence
						WHERE stuid='".$ptid."'";
								
						$result = mysqli_query($conn, $sql);
						
						while ($row = mysqli_fetch_assoc($result)) {
							echo "<form action='data/removefiledt.php' method='POST'><tr>";
							echo "<td>".$row['filename']."
							<input type='hidden' name='filename' value='".$row['filename']."'/>
							</td><td>".$row['filetype']."</td><td>
							<button type='submit' name='submit' 
							class='w3-blueh w3-hover-green w3-padding-large
							w3-border w3-large' value=".$row['id'].">Remove
							</button>";
							
							//Student ID
							echo "<input type='hidden' value='".$_GET['ptid']."' name='ptid'/>"; 	
							
							//Family name
							if(isset($_GET['fnm'])) {
								echo "<input type='hidden' value='".$_GET['fnm']."' name='fnm'/>"; 	
							}
							
							//Given name
							if(isset($_GET['gnm'])) {
								echo "<input type='hidden' value='".$_GET['gnm']."' name='gnm'/>"; 	
							}
							
							echo "</td>";
							echo "</tr></form>";
						}
					}
				?>
			</table>
		</div>
</div>

<?php
	include_once '../footer.php';
?>