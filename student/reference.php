<?php 
	include_once 'headerwithoutsearch.php';
	include_once '../data/dbh.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
?>

<div class="w3-main" style="width:25%">
	<button class="w3-button w3-blueh w3-hover-green w3-teal w3-xlarge w3-hide-large" 
	onclick="w3_open()">&#9776;</button>
		<?php 
		include_once 'menu.php';
	?>
</div>

<div style="margin-left:220px; margin-top:16px;" >
	<form action="data/uploadref.php" method="POST" enctype="multipart/form-data">
		<div class="w3-container w3-white w3-card-4 w3-padding-large"
		style="width:26.5%; margin-top:20px;">
			<input type='file' id='file' name='file' class="w3-blueh w3-hover-green 
			w3-border" />
			<button type="submit" name="submitupload" 
			class="w3-blueh w3-hover-green 
			w3-border">Upload</button>
			<input type="hidden" name="h" 
			<?php 
				if(isset($_GET['h'])) {
					echo "Value='".$_GET['h']."'";	
				}
			?>
			/>
		</div>
	</form>	
	<div class="w3-container w3-white w3-card-4 w3-padding-large"
	style="width:50%; margin-top:20px;">
		<?php
			if(isset($_GET['selecterror'])) {
				echo "<span style='color: red'>Select a file before upload.</span>";
			}
		?>
		<table class="w3-table-all">
			<thead>
				<tr class="w3-blueh">
					<th>File Name</th>
					<th>Remove</th>
				</tr>
			</thead>
			<form action='data/removeref.php' method='POST'>
			<?php
				include_once '../data/dbh.php';
				
				if (isset($_SESSION['stdid']))
				{	
					$sql = "SELECT filename,id FROM reference
					WHERE stuid='".$_SESSION['stdid']."'";
						
					$result = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td><label>".$row['filename']."</label>
						<input type='hidden' name='fileref' value='".$row['filename']."'/>
						</td><td><button type='submit' name='submit' 
						class='w3-blueh w3-hover-green w3-padding-large
						w3-border w3-large' value=".$row['id'].">Remove
						</button>";
					
						//Higlight
						echo "<input type='hidden' value='".$_GET['h']."' name='h'/>"; 
						
						echo "</td></tr>";
					}
				}
			?>
			</form>
		</table>
		
	</div>
		<div class="w3-container w3-white w3-card-4 w3-padding-large"
		style="width:50%; margin-top:20px;">
			<a href="../student/" class="w3-bar-item w3-button w3-blueh w3-hover-green">Finish</a>
		</div>
</div>

<?php
	include_once '../footer.php';
?>