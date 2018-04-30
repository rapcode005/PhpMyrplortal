<?php 
	include_once 'headerwithsearchhome.php';
	include_once '../data/dbh.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
	include_once 'menuwithquerystr.php';
?>

<br><br>
<div class="w3-main w3-container" style="margin-left:220px; margin-top:16px; margin-top:16px; font-family: Arial, Helvetica, sans-serif;" >	
	
	<div style="width:25%;margin-bottom:5px">
		<button class="w3-button w3-blueh w3-hover-green w3-xlarge w3-hide-large" 
		onclick="w3_open()">&#9776;</button>
	</div>
	
	<div class="w3-white w3-card-4">
		<div class="w3-container">
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
							<th>Display</th>
						</tr>
					</thead>
					<tbody>
					<?php					
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
								
								//href
								if (isset($_GET['n']) && isset($_GET['nid'])) {
									$n = $_GET['n'];
									$nid = $_GET['nid'];
									$link =  "evidence.php?ptid=".$_GET['ptid']."&fnm=".$_GET['fnm']."&gnm=".$_GET['gnm']." 
									&v=".$fln."&h=".$h."&nid=".$nid."&n=".$n."&ft=".$ft;
								}
								else {
									$link = "evidence.php?ptid=".$_GET['ptid']."&fnm=".$_GET['fnm']."&gnm=".$_GET['gnm']." 
									&v=".$fln."&h=".$h."&ft=".$ft;
								}
								
								//Comment
								if (isset($_GET['cnt']) && !empty($_GET['cnt'])){
									$cnt = $_GET['cnt'];
									$link .= "&cnt=".$cnt;
								}
								
								echo "<td>".$row['filename']."
								<input type='hidden' name='filename' value='".$row['filename']."'/>
								</td><td>
								<a href='".$link."' class='w3-blueh w3-hover-green w3-padding w3-border'>Show
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
					</tbody>
				</table>
			</p>
			<p>
				<?php
					include_once '../link/message/commentrfa.php';
				?>
			</p>
		</div>
		<div class="w3-container">
		</div>
	</div>
		
	<div style="margin-top:20px;">
		<div class="w3-container" >
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
					
					$folder = $fn.$gn.$id;
					if ($ft == "audio") {
						echo "<audio controls> <source ";
						echo "src='../evidence/".$folder."/".$v."'";
						echo ">Your browser does not support the audio element.</audio>";
					}
					elseif ($ft == "image") {
						echo "<embed  style='width:30%;height:30%;' src='../evidence/".$folder."/".$v."'>";
					}
					elseif ($ft == "video") {
						echo "<video  style='width:50%;height:50%;' controls> <source ";
						echo "src='../evidence/".$folder."/".$v."'";
						echo ">Your browser does not support the audio element.</video>";
					}
				}
			?>   
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