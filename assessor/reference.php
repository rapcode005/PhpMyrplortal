<?php 
	include_once 'headerwithsearchhome.php';
	include_once '../data/dbh.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
?>

<div  style="width:25%;">
	<button class="w3-button w3-blueh w3-hover-green w3-teal w3-xlarge w3-hide-large" 
	onclick="w3_open()">&#9776;</button>
		<?php
	 include_once 'menuwithquerystr.php';
	?>
</div>

<div class="w3-main" style="margin-left:220px; margin-top:16px;" >	
	<div class="w3-container w3-white w3-card-4 w3-padding-large"
	style="width:50%; margin-top:20px;">
		<table class="w3-table-all">
			<thead>
				<tr class="w3-blueh">
					<th>File Name</th>
					<th>Display</th>
				</tr>
			</thead>
			<?php
				include_once '../data/dbh.php';
				
				if (isset($_GET['ptid']) && isset($_GET['h']) &&
				isset($_GET['fnm']) && isset($_GET['gnm']))
				{	
					//decode
					$ptid = base64_decode(urldecode($_GET['ptid']));
					
					$h = $_GET['h'];
					
					$sql = "SELECT filename,id FROM reference
					WHERE stuid='".$ptid."'";
						
					$result = mysqli_query($conn, $sql);
					
					while ($row = mysqli_fetch_assoc($result)) {
						
						$fln = urlencode(base64_encode($row['filename']));
						
						//href
						if (isset($_GET['n']) && isset($_GET['nid'])) {
							$n = $_GET['n'];
							$nid = $_GET['nid'];
							$link =  "reference.php?ptid=".$_GET['ptid']."&fnm=".$_GET['fnm']."&gnm=".$_GET['gnm']." 
							&v=".$fln."&h=".$h."&nid=".$nid."&n=".$n;
						}
						else {
							$link = "reference.php?ptid=".$_GET['ptid']."&fnm=".$_GET['fnm']."&gnm=".$_GET['gnm']." 
							&v=".$fln."&h=".$h;
						}
						
						echo "<tr>";
						
						echo "<td><label>".$row['filename']."</label>
						<input type='hidden' name='fileref' value='".$row['filename']."'/>
						</td><td><a href='".$link."' class='w3-blueh w3-hover-green w3-padding-large
						w3-border w3-large'>Show
						</a>";
						
						
						echo "</td></tr>";
					
					}
				}
			?>
		</table>
	</div>
	<?php
		//Comment
		if (isset($_GET['cnt']) && isset($_GET['fnm']) &&
		isset($_GET['gnm']) && isset($_GET['nid'])) {
			$cnt = base64_decode(urldecode($_GET['cnt']));
			
			$linkid = $_GET['ptid'];
			$linkfn = $_GET['fnm'];
			$linkgn = $_GET['gnm'];
			
			$notifyid = $_GET['nid'];
			
			echo "<div class='w3-container w3-card-4 w3-padding-large'
					style='width:50%; margin-top:20px;'><p><Label style='color:red'>".$cnt."</Label><p>";
			//button update
			echo "<a 
			class='w3-blueh w3-hover-green w3-padding-large
			w3-border' href='data/approve.php?ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=rf
			&nid=".$notifyid."'>
			Done</a></div>";
		}
			
	?>
	
	<div class="w3-container w3-white w3-card-4 w3-padding-large" 
	style="margin-top:16px; width:98%; height:100%;" >
	<embed width="100%"   <?php
							if(isset($_GET['v']) && isset($_GET['fnm']) && 
								isset($_GET['gnm']) && isset($_GET['ptid'])) {
								//decode
								$v = base64_decode(urldecode($_GET['v']));
								$id = base64_decode(urldecode($_GET['ptid']));
								$fn = base64_decode(urldecode($_GET['fnm']));
								$gn = base64_decode(urldecode($_GET['gnm']));
								
								$folder =  $fn.$gn.$id;
								
								echo "src='../reference/".$folder."/".$v."'";
							}
							?>	height="2100px" name="viewfile" />
	</div>
	
</div>




<?php
	include_once '../footer.php';
?>