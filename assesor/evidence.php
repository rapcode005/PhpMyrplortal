<?php 
	include_once 'headerwithsearchhome.php';
	include_once '../data/dbh.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
?>


<div style="width:25%;">
	<button class="w3-button w3-blueh w3-hover-green w3-teal w3-xlarge w3-hide-large" 
	onclick="w3_open()">&#9776;</button>
		<?php
	 include_once 'menuwithquerystr.php';
	?>
</div>


<div class="w3-main" style="margin-left:220px; margin-top:16px;" >	
	<div class="w3-container w3-white w3-card-4 w3-padding-large"
	style="width:40%; margin-top:20px;">
		<table class="w3-table">
			<?php
				echo "<tr>
						<th>File Name</th>
						<th>File Type</th>
						<th>Display</th>
					</tr>";
					
				if(isset($_GET['ptid']) && isset($_GET['h']) && 
					isset($_GET['fnm']) && isset($_GET['gnm'])) {
					include_once '../data/dbh.php';
					
					//decode
					$ptid = base64_decode(urldecode($_GET['ptid']));

					$h = $_GET['h'];
					
					$sql = "SELECT filename,filetype,id FROM evidence
					WHERE stuid='".$ptid."'";
					
					$result = mysqli_query($conn, $sql);
					
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						
						$fln = urlencode(base64_encode($row['filename']));
						$ft = urlencode(base64_encode($row['filetype']));
						
						
						echo "<td>".$row['filename']."
						<input type='hidden' name='filename' value='".$row['filename']."'/>
						</td><td>".$row['filetype']."</td><td>
						<a href='evidence.php?ptid=".$_GET['ptid']."&fnm=".$_GET['fnm']."&gnm=".$_GET['gnm']." 
						&v=".$fln."&ft=".$ft."&h=".$h."' class='w3-blueh w3-hover-green w3-padding-large
						w3-border w3-large'>Show
						</a>";
						
						//Student ID
						echo "<input type='hidden' value='".$_GET['ptid']."' name='ptid'/>"; 	
						
						//Family name
						echo "<input type='hidden' value='".$_GET['fnm']."' name='fnm'/>"; 	
						
						//Given name
						echo "<input type='hidden' value='".$_GET['gnm']."' name='gnm'/>"; 	
						
						echo "</td></tr>";
					}
				}
			?>
		</table>
	</div>
</div>

<div class="w3-container w3-white w3-card-4 w3-padding-large" style="margin-left:220px; margin-top:16px; width:40%;" >
	<?php
		if(isset($_GET['v']) && isset($_GET['fnm']) && 
			isset($_GET['gnm']) && isset($_GET['ptid']) && 
			isset($_GET['ft'])) {
			//decode
			$v = base64_decode(urldecode($_GET['v']));
			$id = base64_decode(urldecode($_GET['ptid']));
			$fn = base64_decode(urldecode($_GET['fnm']));
			$gn = base64_decode(urldecode($_GET['gnm']));
			$ft = base64_decode(urldecode($_GET['ft']));
			
			$folder =  $fn.$gn.$id;
			if ($ft == "audio") {
				echo "<audio controls> <source ";
				echo "src='../evidence/".$folder."/".$v."'";
				echo ">Your browser does not support the audio element.</audio>";
			}
			elseif ($ft == "image") {
				echo "<embed src='../evidence/".$folder."/".$v."'>";
			}
			elseif ($ft == "video") {
				echo "<video   controls> <source ";
				echo "src='../evidence/".$folder."/".$v."'";
				echo ">Your browser does not support the audio element.</video>";
			}
			
		}
	?>   
</div>

<?php
	include_once '../footer.php';
?>