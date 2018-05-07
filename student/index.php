<?php
	include_once '../data/dbh.php';
	include_once 'headerwithsearch.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
?>
<br><br>
<div class="w3-main w3-container">
	<p>
		<?php
			include_once '../link/message/prosucca.php';
		?>
	</p>
	<p>
		<table class="w3-table-all w3-small" style="margin-top:20px;
		font-family: Arial, Helvetica, sans-serif;">
			<thead>
				<tr class="w3-blueh">
					<th>USI</th>
					<th>Family Name</th>
					<th>Given Name</th>
					<th>Course</th>
					<th>Birthday</th>
					<th>Show Details</th>
				</tr>
			</thead>
			<tbody>
			<?php
						
				if(isset($_GET['st']) && !empty($_GET['st'])) {
					
					$search = $_GET['st'];
					
					$sql = "SELECT b.code,b.fname,b.gname,c.descrp,
						b.brhday,b.age,a.id FROM studentinfo a 
						LEFT JOIN personaldt b on a.stdcode = b.id 
						LEFT JOIN courselist c on a.stdcourse = c.code
						WHERE MATCH(fname,gname,b.code) 
						AGAINST('".$search."' in boolean mode) > 0
						and userid=".$_SESSION['u_id']." Order by a.id";
					
				}
				else {
					
					$sql = "SELECT b.code,b.fname as fname,b.gname as gname,c.descrp as descrp,
					b.brhday as brhday,b.age as age,a.id FROM studentinfo a 
					LEFT JOIN personaldt b on a.stdcode = b.id 
					LEFT JOIN courselist c on a.stdcourse = c.code 
					where userid=".$_SESSION['u_id']." Order by a.id";
					
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
					ob_end_flush();
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
						.$row['descrp']."</td><td>".date_format($date,"F d, Y")."</td><td><a 
						class='w3-blueh w3-hover-green w3-padding w3-border'  title='View the details'
						href='studentdt.php?ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=st'>Summary</a></td>
						</tr>";
					}
				
				}
			?>
			</tbody>
		</table>
	</p>
	<p>
		<?php
			if (isset($_GET['st']) && !empty($_GET['st'])) {
				
				$search = $_GET['st'];
				
				$sqlcount = "SELECT COUNT(a.id) as count FROM studentinfo a
					LEFT JOIN personaldt b on a.stdcode = b.id WHERE MATCH(fname,gname,b.code) 
					AGAINST('".$search."' IN NATURAL LANGUAGE MODE) and
					userid=".$_SESSION['u_id'];
				
				$st = "&st=".$search;
			}
			else {
				$sqlcount = "SELECT COUNT(id) as count FROM studentinfo
				where userid=".$_SESSION['u_id'];
				$st = "";
			}
			$result = mysqli_query($conn, $sqlcount);
			$row = mysqli_fetch_assoc($result);
			$totalrecords = $row['count']; 
			if ($row['count'] >= 2) {
				
				$totalpages = ceil($totalrecords / 20); 
				
				if ($totalpages > 10) {
					
					$next = "<a href='../student/?p=".($p+1).$st."' class='w3-button w3-hover-green w3-small w3-border'>&raquo;</a>";
					$previous = "<a href='../student/?p=".($p-1).$st."' class='w3-button w3-hover-green w3-small w3-border'>&laquo;</a>";
					$page = $p;
									
					if ($p == 0 || $p == 1) {
						$previous = "<a class='w3-button w3-hover-green w3-disabled w3-small w3-border'>&laquo;</a>";
						$page = 1;
					}
					if ($p >= $totalpages) {
						$next = "<a class='w3-button w3-hover-green w3-disabled w3-small w3-border'>&raquo;</a>";
					}
					
					if (($p + 10) <= $totalpages)
						$totalpagesnum = ($page-1) + 10;
					else
						$totalpagesnum = $totalpages;
				}
				else {
					
					$previous = "<a href='../student/?p=".($p-1).$st."' class='w3-button w3-hover-green w3-small w3-border'>&laquo;</a>";
					$next = "<a href='../student/?p=".($p+1).$st."' class='w3-button w3-hover-green w3-small w3-border'>&raquo;</a>";
					
					if ($p == 0 || $p == 1) {
						$previous = "<a class='w3-button w3-hover-green w3-disabled w3-small w3-border'>&laquo;</a>";
						$page = 1;
					}
					if ($p >= $totalpages) {
						$next = "<a class='w3-button w3-hover-green w3-disabled w3-small w3-border'>&raquo;</a>";
					}
					
					$page = 1;
					$totalpagesnum = $totalpages;
				}
				
				$pagelink = "<div class='w3-small'>".$previous;
				
				if($page >= 4) {
					$pagelink .= "<a href='../student/?p=1".$st."' class='w3-button w3-hover-green w3-small w3-border'>1</a>";
					$pagelink .= "<a class='w3-button w3-hover-green w3-disabled w3-small w3-border'>...</a>";
				}
				
				for ($i=$page; $i<=$totalpagesnum; $i++) {
					if($p == $i) 
						$pagelink .= "<a class='w3-button w3-hover-green w3-green w3-disabled w3-small w3-border'>".$i."</a>";  
					else
						$pagelink .= "<a href='../student/?p=".$i.$st."' class='w3-button w3-hover-green w3-small w3-border'>".$i."</a>";
				}
				echo $pagelink.$next."</div>";
			}
		?>
	</p>
</div>
<?php		
	include_once '../footer.php';
?>

