<?php
	session_start();
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Browse List of Users</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../link/css/style.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../link/css/w3.css">
		<link rel="stylesheet" type="text/css" href="../link/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		</script>
	</head>
<body>

<div class="w3-top">
		<div class="w3-bar w3-blueh w3-border w3-large w3-mobile" 
		style="font-family: Arial, Helvetica, sans-serif;">
			
			<a class="w3-bar-item w3-button 
			w3-blueh w3-hover-green"
			href='../user/'>
			MYRPLPORTAL</a>
			
			<!-- Switch student page -->
			<?php
				if (isset($_SESSION['u_r']) && $_SESSION['u_r'] =="admin") {
					echo "<a href='../assessor/' title='Switch to Student Page'
					class='w3-bar-item w3-button w3-hover-green w3-blueh'>
					Student Page</a>";
				}
			?>
			

			<button class="w3-button w3-blueh 
				w3-hover-green w3-hide-large w3-right" 
				onclick="return baropen();">&#9776;</button>
			
			<div id="barmenuu"
			class="w3-collapse w3-large w3-sidebar ">
				
				<button class="w3-button w3-blueh 
				w3-hover-green w3-hide-large w3-right" 
				onclick="return barclose();">&#9776;</button>
				
				<!-- Logout -->
				<form action='../data/logout.php' method='POST' >
						<button type='submit' name='submitlogout'
						class='w3-bar-item w3-button w3-button 
						w3-blueh w3-hover-green w3-right' title='Logout'>
						<i class='fa fa-sign-out'></i></button>
				</form>
					
				<!-- New User -->
				<button onclick="myFunction('signup')" type='submit'
						class='w3-bar-item w3-button w3-blueh w3-hover-green w3-right'
						title="Add User">
				<i class="fa fa-user-plus"></i></button>
				
				<!-- Search -->	
				<form action="../user/" method="GET" >
					
					<input type="text" name="st"
					class="w3-bar-item w3-input" 
					<?php 
						if (isset($_GET['st']) && !empty($_GET['st'])) {
						
							$search = $_GET['st'];
							
							echo "Value='".$search,"' ";
						
						}
					?> placeholder="Search User..">
				</form>
			</div>
		</div>
	</div>
<br><br>
<div class="w3-container" 
style="font-family: Arial, Helvetica, sans-serif;">
<p>
<?php
	//Message
	if (isset($_GET['s']) && $_GET['s'] == 'success') {
		echo "<h6>The user has been successfully saved.</h6>";
	}
	elseif (isset($_GET['s']) && $_GET['s'] == 'usernametaken') {
		echo "<h6 style='color: red'>The username has been taken.</h6>";
	}
	elseif (isset($_GET['s']) && $_GET['s'] == 'empty') {
		echo "<h6 style='color: red'>Fill up all the fields.</h6>";
	}
	
?>
</p>
<p>
<div id="signup" <?php 
			if (isset($_GET['sg'])) {
				echo "class='w3-greyb w3-container w3-card-4 w3-show w3-small'";
			}
			else {
				echo "class='w3-greyb w3-container w3-card-4 w3-hide w3-small'";
			}
			?> 
			style="width:40%; font-family: Arial, Helvetica, sans-serif">
	<form action="data/signup-codes.php" method="POST" >
		<p>
		<input type="text" name="uid"  placeholder="Username" 
		class='w3-input w3-border w3-animate-input'
		style='width:200px' 
		<?php 
			if (!empty($_GET['u']))
				echo "Value='".$_GET['u']."'";
		?> />
		</p>
		<p>
		<input type="password" name="pwd" placeholder="Password" 
		class='w3-input w3-border w3-animate-input'
		style='width:200px' value="" />
		</p>
		<p>
		<input type="text" name="fname" placeholder="Given name" 
		class='w3-input w3-border w3-animate-input'
		style='width:200px' 
		<?php 
			if (!empty($_GET['f']))
				echo "Value='".$_GET['f']."'";
		?>/>
		</p>
		<p>
		<input type="text" name="lname" placeholder="Family name" 
		class='w3-input w3-border w3-animate-input'
		style='width:200px' 
		<?php 
			if (!empty($_GET['l']))
				echo "Value='".$_GET['l']."'";
		?>/>
		</p>
		<p>
		<select name="ur" class='w3-select w3-select-input' style='width:200px'>
			<?php 
				echo "<option value='userrole'>Select a User Role</option>";
				$ad = "<option value='admin'>Admin</option>";
				$ag = "<option value='agent'>Agent</option>";
				$ac = "<option value='aser'>Assessor</option>";
				if (!empty($_GET['ur'])) {
					switch ($_GET['ur']) {
						case "admin":
							$ad = "<option value='admin' selected>Admin</option>";
							break;
						case "agent":
							$ag = "<option value='agent' selected>Agent</option>";
							break;
						case "aser":
							$ac = "<option value='aser' selected>Assessor</option>";
							break;
					}
				}
				echo $ad.$ag.$ac;
			?>
			
		</select>
		</p>
		<p>
		<button type="submit" name="submitsignup"
		class="w3-blueh w3-hover-green w3-padding
								w3-border w3-right" >Save</button></p>
								
	</form>
		<div class="w3-container w3-margin-bottom">
		</div>
</div>

<script>
	function myFunction(id) {
		var x = document.getElementById(id);
		if (x.className.indexOf("w3-show") == -1) {
			x.className += " w3-show";
		} else { 
			x.className = x.className.replace(" w3-show", "");
		}
	}
	function baropen() {
		document.getElementById("barmenuu").style.display = "block";
		return false;
	}
	function barclose() {
		document.getElementById("barmenuu").style.display = "none";
		return false;
	}
</script>
</p>
<p>
	<table class="w3-table-all w3-small" 
	style="font-family: Arial, Helvetica, sans-serif;">
		<thead>
			<tr class="w3-blueh">
				<th>User Name</th>
				<th>Given Name</th>
				<th>Family Name</th>
				<th>User Role</th>
			</tr>
		</thead>
		<tbody >
			<?php 
				include_once '../data/dbh.php';
				
				if(isset($_GET['st']) && !empty($_GET['st'])) {
					
					$search = $_GET['st'];
					
					$sql = "SELECT username,userfname,userlname,userrole FROM user_profile 
					Where MATCH(username,userlname,userfname) AGAINST('".$search."' IN NATURAL LANGUAGE MODE) 
					Order by userid";
					
				}
				else {
					
					$sql = "SELECT username,userfname,userlname,userrole FROM user_profile";
					
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
				
				if ($resultCheck > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						
						if ($row['userrole'] == "aser")
							$ur = "assessor";
						else
							$ur = $row['userrole'];
						
						echo "<td>".$row['username']."</td>
						<td>".$row['userfname']."</td>
						<td>".$row['userlname']."</td>
						<td>".$ur."</td>";
						
						echo "</tr>";
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
				
				$sqlcount = "SELECT count(userid) as count FROM user_profile 
				Where MATCH(username,userlname,userfname) AGAINST('".$search."' IN NATURAL LANGUAGE MODE) 
				Order by userid";
				
				$st = "&st=".$search;
			}
			else {
				$sqlcount = "SELECT count(userid) as count FROM user_profile";
				
				$st = "";
			}
			$result = mysqli_query($conn, $sqlcount);
			$row = mysqli_fetch_assoc($result);
			$totalrecords = $row['count']; 
			if ($row['count'] >= 2) {
				
				$totalpages = ceil($totalrecords / 20); 
				
				if ($totalpages > 10) {
					
					$next = "<a href='../user/?p=".($p+1).$st."' class='w3-button w3-hover-green'>&raquo;</a>";
					$previous = "<a href='../user/?p=".($p-1).$st."' class='w3-button w3-hover-green'>&laquo;</a>";
					$page = $p;
									
					if ($p == 0 || $p == 1) {
						$previous = "<a class='w3-button w3-hover-green w3-disabled'>&laquo;</a>";
						$page = 1;
					}
					if ($p >= $totalpages) {
						$next = "<a class='w3-button w3-hover-green w3-disabled'>&raquo;</a>";
					}
					
					if (($p + 10) <= $totalpages)
						$totalpagesnum = ($page-1) + 10;
					else
						$totalpagesnum = $totalpages;
				}
				else {
					
					$previous = "<a href='../user/?p=".($p-1).$st."' class='w3-button w3-hover-green w3-border'>&laquo;</a>";
					$next = "<a href='../user/?p=".($p-1).$st."' class='w3-button w3-hover-green w3-border'>&raquo;</a>";
					
					if ($p == 0 || $p == 1) {
						$previous = "<a class='w3-button w3-hover-green w3-disabled w3-border'>&laquo;</a>";
						$page = 1;
					}
					if ($p >= $totalpages) {
						$next = "<a class='w3-button w3-hover-green w3-disabled w3-border'>&raquo;</a>";
					}
					
					$page = 1;
					$totalpagesnum = $totalpages;
				}
					
				$pagelink = "<div class='w3-small'>".$previous;
				
				if($page >= 4) {
					$pagelink .= "<a href='../user/?p=1".$st."' class='w3-button w3-hover-green'>1</a>";
					$pagelink .= "<a class='w3-button w3-hover-green w3-disabled'>...</a>";
				}
				
				for ($i=$page; $i<=$totalpagesnum; $i++) {
					if($p == $i) 
						$pagelink .= "<a class='w3-button w3-hover-green w3-green w3-disabled w3-border'>".$i."</a>";  
					else
						$pagelink .= "<a href='../user/?p=".$i.$st."' class='w3-button w3-hover-green w3-border'>".$i."</a>";
				}
				echo $pagelink.$next."</div>";
			}
	?>
	</p>
</div>
