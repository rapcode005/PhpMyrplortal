<?php
	include_once 'headerwithsearch.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
?>

	<table class="w3-table-all" style="margin-top:20px;">
		<thead>
			<tr class="w3-blueh">
				<th>USI</th>
				<th>Family Name</th>
				<th>Given Name</th>
				<th>Course</th>
				<th>Birthday</th>
				<th>Age</th>
				<th>Show Details</th>
			</tr>
		</thead>
		<?php
					
			include_once '../data/dbh.php';
			
			if(isset($_GET['st']) && !empty($_GET['st'])) {
				
				$search = $_GET['st'];
				
				$sql = "SELECT b.code,b.fname,b.gname,c.descrp,
				b.brhday,b.age,a.id FROM studentinfo a 
				LEFT JOIN personaldt b on a.stdcode = b.id 
				LEFT JOIN courselist c on a.stdcourse = c.code
				WHERE MATCH(fname, gname,b.code) 
				AGAINST('".$search."' IN NATURAL LANGUAGE MODE) Order by a.id";
				
			}
			else {
				
				$sql = "SELECT b.code,b.fname as fname,b.gname as gname,c.descrp as descrp,
				b.brhday as brhday,b.age as age,a.id FROM studentinfo a 
				LEFT JOIN personaldt b on a.stdcode = b.id 
				LEFT JOIN courselist c on a.stdcourse = c.code Order by a.id";
				
			}
			
			//Paging
			if (isset($_GET['p'])) {
				$p = $_GET['p'];
				if (empty($_GET['p']))
					$pagenum = 0;
				else {
					$pagenum = ($_GET['p'] * 20) - 20;
				}
			}
			else {
				$p = 0;
				$pagenum = 0;
			}
			
			$limit = " LIMIT ".$pagenum.",20";
			
			$sql .= $limit;
			
			$result = mysqli_query($conn, $sql);

			$resultCheck = mysqli_num_rows($result);
			
			if ($resultCheck == 1) {
				
				$row = mysqli_fetch_assoc($result);
				
				//Encrypt ID
				$linkid = urlencode(base64_encode($row['id']));
				$linkfn = urlencode(base64_encode($row['fname']));
				$linkgn = urlencode(base64_encode($row['gname']));
				
				header("Location: studentdt.php?ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=st&st=".$search);
				
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
					w3-border' href='studentdt.php?ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=st'>Summary</a></td>
					</tr>";
				}
			
			}
		?>
	</table>
	<?php
		if (isset($_GET['st']) && !empty($_GET['st'])) {
			
			$sqlcount = "SELECT COUNT(a.id) as count FROM studentinfo a
				LEFT JOIN personaldt b on a.stdcode = b.id WHERE MATCH(fname,gname,b.code) 
				AGAINST('".$search."' IN NATURAL LANGUAGE MODE)";
		}
		else {
			$sqlcount = "SELECT COUNT(id) as count FROM studentinfo";
		}
		$result = mysqli_query($conn, $sqlcount);
		$row = mysqli_fetch_assoc($result);
		$totalrecords = $row['count']; 
		if ($row['count'] >= 6) {
			$totalpages = ceil($totalrecords / 20); 
			$pagelink = "<div class='w3-bar'>";
			for ($i=1; $i<=$totalpages; $i++) {
				if($p == $i) 
					$pagelink .= "<a href='../student/?p=".$i."' class='w3-button w3-hover-green w3-green'>".$i."</a>";  
				else
					$pagelink .= "<a href='../student/?p=".$i."' class='w3-button w3-hover-green'>".$i."</a>";
			}
			echo $pagelink."</div>";
		}
	?>
<?php
	include_once '../footer.php';
?>

