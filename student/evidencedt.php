<?php 
	include_once 'headerwithsearchhome.php';
	include_once '../data/dbh.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
	include_once 'menuwithquerystr.php';
?>


<br><br>
<div class="w3-main w3-container" 
style="margin-left:200px; margin-top:16px; 
font-family: Arial, Helvetica, sans-serif;" >
	
	<div style="width:25%;margin-bottom:5px;">
		<button class="w3-button w3-blueh w3-hover-green w3-xlarge w3-hide-large" 
		onclick="w3_open()">&#9776;</button>
	</div>

	<div class="w3-white w3-card-4">
		<div class="w3-container">
			<form action="data/uploadevidencedt.php" method="POST" enctype="multipart/form-data">
				<p>
					<input type='file' id='file' name='file' 
					class="w3-blueh w3-hover-green w3-border w3-small" />
					<button type="submit" name="submitupload" 
					class="w3-blueh w3-hover-green w3-small
					w3-border w3-padding-small">Upload</button>
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
					<input type="hidden" name="h" 
					<?php 
						if(isset($_GET['h'])) {
							echo "Value='".$_GET['h']."'";	
						}
					?>
					/>
					<input type="hidden" name="n" 
					<?php 
						if(isset($_GET['n'])) {
							echo "Value='".$_GET['n']."'";	
						}
					?>
					/>
					<input type="hidden" name="nid" 
					<?php 
						if(isset($_GET['nid'])) {
							echo "Value='".$_GET['nid']."'";	
						}
					?>
					/>
				</p>
			</form>
			<p>
				<?php
					include_once '../link/message/prosucca.php';
				?>
			</p>
			<p>
				<table class="w3-table-all w3-small">
					<thead>
						<tr class="w3-blueh">
						<th>File Name</th>
						<th>File Type</th>
						<th>Remove</th>
						</tr>
					</thead>
					<tbody> 
						<form action='data/removefiledt.php' method='POST'>
							<?php				
								if(isset($_GET['ptid']) && isset($_GET['fnm']) &&
								isset($_GET['gnm']) && isset($_GET['h']) ) {
									include_once '../data/dbh.php';

									//decode
									$ptid = base64_decode(urldecode($_GET['ptid']));

									$sql = "SELECT filename,filetype,id FROM evidence
									WHERE stuid='".$ptid."'";
											
									$result = mysqli_query($conn, $sql);

									while ($row = mysqli_fetch_assoc($result)) {
										echo "<tr>";
										echo "<td>".$row['filename']."
										<input type='hidden' name='filename' value='".$row['filename']."'/>
										</td><td>".$row['filetype']."</td><td>
										<button type='submit' name='submit' 
										class='w3-button w3-blueh w3-hover-green w3-padding w3-border' 
										value=".$row['id'].">Remove
										</button>";
										
										//Student ID
										echo "<input type='hidden' value='".$_GET['ptid']."' name='ptid'/>"; 	
										
										//Family name
										echo "<input type='hidden' value='".$_GET['fnm']."' name='fnm'/>"; 	
										
										//Given name
										echo "<input type='hidden' value='".$_GET['gnm']."' name='gnm'/>"; 	
										
										//Higlight
										echo "<input type='hidden' value='".$_GET['h']."' name='h'/>"; 
										
										echo "</td>";
										echo "</tr>";
									}
								}
							?>
						</form>
					</tbody>
				</table>
			</p>
			<p>	
				<?php
					//Comment
					include_once '../link/message/commentrfev.php';
				?>
			</p>
		</div>
	</div>		
</div>
<script>
	function w3_open() {
			document.getElementById("mySidebar").style.display = "block";
	}
	function w3_close() {
		document.getElementById("mySidebar").style.display = "none";
	}
</script>
<?php
	include_once '../footer.php';
?>