<?php 
	include_once 'headerwithoutsearch.php';
	include_once '../data/dbh.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
?>

<div class="w3-top">
	<header>
		<nav class="w3-bar w3-blueh w3-border w3-small">
		<a href='../assesor/' class="w3-bar-item w3-button w3-blueh w3-hover-green">
		<i class="fa fa-home"></i></a>
		<?php 
			if (isset($_SESSION['u_r'])) {
				echo "<form action='../data/logout.php' method='POST' >
				<button type='submit' name='submitlogout'
				class='w3-bar-item w3-button w3-button w3-blueh w3-hover-green'>
				Logout</button>
				</form>";
			}
		?>
		</nav>
	</header>
</div>

<div  style="width:25%;margin-top:40px;">
	<button class="w3-button w3-blueh w3-hover-green w3-teal w3-xlarge w3-hide-large" 
	onclick="w3_open()">&#9776;</button>
		<?php
	 include_once 'menuwithquerystr.php';
	?>
</div>

<div class="w3-main" style="margin-left:220px; margin-top:16px;" >	
	<div class="w3-container w3-white w3-card-4 w3-padding-large"
	style="width:50%; margin-top:20px;">
		<table class="w3-table">
			<?php
				echo "<tr>
					<th>File Name</th>
					<th>Display</th>
				</tr>";

				include_once '../data/dbh.php';
				
				if (isset($_GET['ptid']))
				{	
					//decode
					$ptid = base64_decode(urldecode($_GET['ptid']));
			
					$sql = "SELECT filename,id FROM reference
					WHERE stuid='".$ptid."'";
						
					$result = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_assoc($result)) {
						
						$fln = urlencode(base64_encode($row['filename']));
						
						echo "<tr>";
						
						echo "<td><label>".$row['filename']."</label>
						<input type='hidden' name='fileref' value='".$row['filename']."'/>
						</td><td><a href='reference.php?ptid=".$_GET['ptid']."&fnm=".$_GET['fnm']."&gnm=".$_GET['gnm']." 
						&v=".$fln."' class='w3-blueh w3-hover-green w3-padding-large
						w3-border w3-large'>Show
						</a>";
						
						
						echo "</td>";
						
						echo "</tr>";
					}
				}
			?>
		</table>
	</div>
</div>

<div class="w3-container w3-white w3-card-4 w3-padding-large" style="margin-left:220px; margin-top:16px;" >
	<embed width="100%" <?php
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


<?php
	include_once '../footer.php';
?>