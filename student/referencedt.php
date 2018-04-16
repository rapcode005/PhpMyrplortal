<?php 
	include_once 'headerwithsearchhome.php';
	include_once '../data/dbh.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
?>

<div class="w3-main" style="width:25%">
	<button class="w3-button w3-blueh w3-hover-green w3-teal w3-xlarge w3-hide-large" 
	onclick="w3_open()">&#9776;</button>
	<?php 
		include_once 'menuwithquerystr.php';
	?>
</div>

<div style="margin-left:220px; margin-top:16px; font-family: Arial, Helvetica, sans-serif;" >
	<form action="data/uploadrefdt.php" method="POST" enctype="multipart/form-data">
		<div class="w3-container w3-white w3-card-4 w3-padding-large"
		style="width:26.5%; margin-top:20px;">
			<input type='file' id='file' name='file' class="w3-blueh w3-hover-green w3-border"
            style="height: 32px;" />
			<button type="submit" name="submitupload" 
			class="w3-blueh w3-hover-green 
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
				}?>/>
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
				}?>/>
		</div>
	</form>	
	
	<?php
		//Comment
		if (isset($_GET['cnt'])) {
			$cnt = base64_decode(urldecode($_GET['cnt']));
			echo "<div class='w3-container w3-card-4 w3-padding-large'
					style='width:50%; margin-top:20px;'><Label style='color:red'>".$cnt."</Label></div>";
		}
	?>
	
	<div class="w3-container w3-card-4 w3-padding-large"
	style="width:50%; margin-top:20px; font-family: Arial, Helvetica, sans-serif;">
		<?php
			if(isset($_GET['selecterror'])) {
				echo "<h3 style='color: red'>Select a file before upload.</h3>";
			}
			elseif (isset($_GET['s'])) {
				echo "<h3>The file has been successfully uploaded.</h3>";
			}
			elseif (isset($_GET['sr'])) {
				echo "<h3>The file has been successfully removed.</h3>";
			}
		?>
		<table class="w3-table-all" >
			<thead>
				<tr class="w3-blueh">
					<th>File Name</th>
					<th>Remove</th>
				</tr>
			</thead>
			<tbody class="w3-small"> 
				<form action='data/removerefdt.php' method='POST'>
				<?php
					include_once '../data/dbh.php';
					
					if (isset($_GET['ptid']) && isset($_GET['fnm']) &&
					isset($_GET['gnm']) && isset($_GET['h']))
					{	
						//decode
						$ptid = base64_decode(urldecode($_GET['ptid']));
				
						$sql = "SELECT filename,id FROM reference
						WHERE stuid='".$ptid."'";
							
						$result = mysqli_query($conn, $sql);

						while ($row = mysqli_fetch_assoc($result)) {
							echo "<tr>";
							
							echo "<td><label>".$row['filename']."</label>
							<input type='hidden' name='fileref' value='".$row['filename']."'/>
							</td><td><button type='submit' name='submit' 
							class='w3-blueh w3-hover-green w3-padding-large w3-border' 
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
	</div>
</div>

<?php
	include_once '../footer.php';
?>