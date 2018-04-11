<?php
	include_once 'headerwithsearch.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../");
	}
?>
	<table style="margin-top:20px;" class="w3-table">
		<thead>
			<tr>
				<th>USI</th>
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
				
				if(isset($_GET['st']) && !empty($_GET['st'])) {
					
					$search = $_GET['st'];
					
					$sql = "SELECT b.code,b.fname,b.gname,c.descrp,
					b.brhday,b.age,a.id FROM studentinfo a 
					LEFT JOIN personaldt b on a.stdcode = b.id 
					LEFT JOIN courselist c on a.stdcourse = c.code
					WHERE MATCH(fname, gname,b.code) 
					AGAINST('".$search."' IN NATURAL LANGUAGE MODE)";
					
				}
				else {
					
					$sql = "SELECT b.code,b.fname,b.gname,c.descrp,
					b.brhday,b.age,a.id FROM studentinfo a 
					LEFT JOIN personaldt b on a.stdcode = b.id 
					LEFT JOIN courselist c on a.stdcourse = c.code";
					
				}
				
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);
				
				if ($resultCheck == 1) {
					
					$row = mysqli_fetch_assoc($result);
					
					//Encrypt ID
					$linkid = urlencode(base64_encode($row['id']));
					$linkfn = urlencode(base64_encode($row['fname']));
					$linkgn = urlencode(base64_encode($row['gname']));
					
					header("Location: studentinfo.php?ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=st&st=".$search);
					
				}
				else {
					
					while ($row = mysqli_fetch_assoc($result)) {
			
						//Encrypt ID
						$linkid = urlencode(base64_encode($row['id']));
						$linkfn = urlencode(base64_encode($row['fname']));
						$linkgn = urlencode(base64_encode($row['gname']));
						
						//Format Date
						$date=date_create($row['brhday']);
						
						echo "<tr>";
						echo "<td>".$row['code']."</td><td>".$row['fname']."</td><td>".$row['gname']."</td><td>"
						.$row['descrp']."</td><td>".date_format($date,"F d, Y")."</td><td>"
						.$row['age']."</td><td><a 
						class='w3-blueh w3-hover-green w3-padding-large
						w3-border' href='studentinfo.php?ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=st'>Summary</a></td>
						</tr>";
						
					}
					
				}
			?>
		</tbody>
	</table>
<?php
	include_once '../footer.php';
?>

