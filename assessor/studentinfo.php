<?php 
	include_once 'headerwithsearchhome.php';
	include_once '../data/dbh.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
	include_once 'menuwithquerystr.php';
?>

<!-- Download Button -->
<div class="w3-bottom">
	<div class="w3-display-bottomright w3-margin"
		style="font-family: Arial, Helvetica, sans-serif;">
		<?php
			if (isset($_SESSION['u_r']) &&
				$_SESSION['u_r'] =="admin") {
					
				//Decode
				$id = base64_decode(urldecode($_GET['ptid']));
				$fn = base64_decode(urldecode($_GET['fnm']));
				$gn = base64_decode(urldecode($_GET['gnm']));	
					
				$url = "../appformstudent/".$fn.$gn.$id."/appform.pdf";
				
				echo "<a href='".$url."'
				class='w3-blueh w3-hover-green w3-padding-large
				w3-border w3-large' download
				>Download</a>";
				
			}				
		?>
	</div>
</div>

<br><br>
	
<div class="w3-main w3-container w3-small" style="margin-top:16px; 
	margin-left:200px; font-family: Arial, Helvetica, sans-serif;">
	
		<div style="width:25%;margin-bottom:5px;">
			<button class="w3-button w3-blueh w3-xlarge
				w3-hover-green w3-hide-large" 
				onclick="w3_open()">&#9776;</button>
		</div>
		
		<?php
			include_once '../link/message/prosucca.php';
		?>
		
		<form action="data/update.php" method="GET">
		<div class="w3-white w3-card-4">
			<header class="w3-container w3-blueh">
				<span id="perdt"><h4>Personal Details</h4></span>
			</header>
			
			<?php 
				if (isset($_GET['ptid'])) {
					
					$ptid = base64_decode(urldecode($_GET['ptid']));
					
					$sqldata = "SELECT
									b.id as perid,
									b.code,
									b.fname,
									b.gname,
									b.pname,
									b.brhday,
									b.age,
									c.descrp
								FROM studentinfo a 
					INNER JOIN personaldt b on a.stdcode = b.id 
					left JOIN courselist c on a.stdcourse = c.code
					WHERE a.id = ".$ptid;
					
					
					//Session value for personaldt
					$_SESSION['stdid'] = $ptid;
					
					
					$result = mysqli_query($conn, $sqldata);
					$resultCheck = mysqli_num_rows($result);
						
					if ($resultCheck > 0) {
						
						$rowrpd = mysqli_fetch_assoc($result);
						
						//Session value for personaldt
						$_SESSION['stdcode'] = $rowrpd['code'];
						$_SESSION['stdfname'] = $rowrpd['fname'];
						$_SESSION['stdgname'] = $rowrpd['gname'];
						$_SESSION['perid'] = $rowrpd['perid'];
						
					}		
			
				}
			?>
			
			<div class="w3-container w3-margin-bottom w3-margin-top">
				<table class="w3-table-all w3-card-4">
					<thead>
						<tr class="w3-blueh">
							<th>Data</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "USI"; ?></td>
							<td><?php if (isset($rowrpd['code'])) { echo $rowrpd['code']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Family Name"; ?></td>
							<td><?php if (isset($rowrpd['fname'])) { echo $rowrpd['fname']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Given Name"; ?></td>
							<td><?php if (isset($rowrpd['gname'])) { echo $rowrpd['gname']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Preffered Name"; ?></td>
							<td><?php if (isset($rowrpd['pname'])) { echo $rowrpd['pname']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Course"; ?></td>
							<td><?php if (isset($rowrpd['descrp'])) { echo $rowrpd['descrp']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Birthday"; ?></td>
							<td><?php if (isset($rowrpd['brhday'])) { $date=date_create($rowrpd['brhday']); echo date_format($date,"F d, Y"); } ?></td>
						</tr>
						<tr>
							<td><?php echo "Age"; ?></td>
							<td><?php if (isset($rowrpd['age'])) { echo $rowrpd['age']; } ?></td>
						</tr>
					</tbody>
				</table>
				
				<?php
				
					//Comment
					if (isset($_GET['nv']) && $_GET['nv'] == "perdt") {
						include_once '../link/message/commentsta.php';
					}
					
				?>
				
			</div>
			
			<div class="w3-container">
			</div>
		</div>
		
		<div class="w3-white w3-card-4" style="margin-top:20px;" >
			<header class="w3-container w3-blueh">
				<span id="resd"><h4>Residence</h4></span>
			</header>
			
			<?php 
				if (isset($_GET['ptid'])) {
					
					$ptid = base64_decode(urldecode($_GET['ptid']));
					
					$sqldata = "SELECT 
									b.id as resdid, 
									b.building,
									b.flat,
									b.Street,
									b.Suburb,
									b.State,
									b.postalcode
								FROM studentinfo a 
					INNER JOIN residence b on a.rid = b.id 
					WHERE a.id = ".$ptid;
					
					$result = mysqli_query($conn, $sqldata);
					$resultCheck = mysqli_num_rows($result);
						
					if ($resultCheck > 0) {
							
						$rowresd = mysqli_fetch_assoc($result);
						//For Saving Residence
						$_SESSION['resdid'] = $rowresd['resdid'];	
					}
				}	
			?>
			
			<div class="w3-container w3-margin-bottom w3-margin-top">
				<table class="w3-table-all w3-card-4">
					<thead>
						<tr class="w3-blueh">
							<th>Data</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "Building"; ?></td>
							<td><?php if (isset($rowresd['building'])) { echo $rowresd['building']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Flat/Unit details"; ?></td>
							<td><?php if (isset($rowresd['flat'])) { echo $rowresd['flat']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Street/Lot number"; ?></td>
							<td><?php if (isset($rowresd['Street'])) { echo $rowresd['Street']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Suburb/Locality/Town"; ?></td>
							<td><?php if (isset($rowresd['Suburb'])) { echo $rowresd['Suburb']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "State"; ?></td>
							<td><?php if (isset($rowresd['State'])) { echo $rowresd['State']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Postal Code"; ?></td>
							<td><?php if (isset($rowresd['postalcode'])) { echo $rowresd['postalcode']; } ?></td>
						</tr>
					</tbody>
				</table>
				
				<?php
					//Comment
					if (isset($_GET['nv']) && $_GET['nv'] == "resd") {
						include_once '../link/message/commentsta.php';
					}
				?>
			</div>
			
			<div class="w3-container">
			</div>
		</div>
		
		<div class="w3-white w3-card-4" style="margin-top:20px;" >
			<header class="w3-container w3-blueh">
				<span id="ptadd"><h4>Postal Address</h4></span>
			</header>
			
				<?php 
					if (isset($_GET['ptid'])) {
						
						$ptid = base64_decode(urldecode($_GET['ptid']));
						
						$sqldata = "SELECT 
										b.id as postid,
										b.building as building,
										b.flat as flat,
										b.Street as Street,
										b.Suburb as Suburb,
										b.State as State,
										b.postalcode as postalcode
									FROM studentinfo a 
						INNER JOIN postaladdress b on a.paddid = b.id 
						WHERE a.id = ".$ptid;
						
						$result = mysqli_query($conn, $sqldata);
						$resultCheck = mysqli_num_rows($result);
						
						if($resultCheck > 0) {
							$rowposadd = mysqli_fetch_assoc($result);
							//For Saving Residence
							$_SESSION['postid'] = $rowposadd['postid'];
						}
					}
				?>
			<div class="w3-container  w3-margin-bottom w3-margin-top">
				<table  class="w3-table-all w3-card-4">
					<thead>
						<tr class="w3-blueh">
							<th>Data</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "Building"; ?></td>
							<td><?php if (isset($rowposadd['building'])) { echo $rowposadd['building']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Flat/Unit details"; ?></td>
							<td><?php if (isset($rowposadd['flat'])) { echo $rowposadd['flat']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Street/Lot number"; ?></td>
							<td><?php if (isset($rowposadd['Street'])) { echo $rowposadd['Street']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Suburb/Locality/Town"; ?></td>
							<td><?php if (isset($rowposadd['Suburb'])) { echo $rowposadd['Suburb']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "State"; ?></td>
							<td><?php if (isset($rowposadd['State'])) { echo $rowposadd['State']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Postal Code"; ?></td>
							<td><?php if (isset($rowposadd['postalcode'])) { echo $rowposadd['postalcode']; } ?></td>
						</tr>
					</tbody>
				</table>
				
				<?php				
					//Comment
					if (isset($_GET['nv']) && $_GET['nv'] == "ptadd") {
						include_once '../link/message/commentsta.php';
					}
				?>
			</div>
			<div class="w3-container">
			</div>
		</div>
		
		<div class="w3-white w3-card-4" style="margin-top:20px;">
			<header class="w3-container w3-blueh">
				<span id="phncntdt"><h4>Phone and Contact details</h4></span>
			</header>
			
				<?php 
					if (isset($_GET['ptid'])) {
						
						$ptid = base64_decode(urldecode($_GET['ptid']));
						
						$sqldata = "SELECT 
										b.id as pntid,
										b.homeph,
										b.workph,
										b.mobile,
										b.email
									FROM studentinfo a 
						INNER JOIN phonecontact b on a.phocnt = b.id 
						WHERE a.id = ".$ptid;
						
						$result = mysqli_query($conn, $sqldata);
						$resultCheck = mysqli_num_rows($result);
						
						if($resultCheck > 0) {
							
							$rowphcnt = mysqli_fetch_assoc($result);			
							//For Saving Phone
							$_SESSION['pntid'] = $rowphcnt['pntid'];
							
						}
					
					}
				?>
			
			<div class="w3-container  w3-margin-bottom w3-margin-top">	
				<table class="w3-table-all w3-card-4">
					<thead>
						<tr class="w3-blueh">
							<th>Data</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "Home"; ?></td>
							<td><?php if (isset($rowphcnt['homeph'])) { echo $rowphcnt['homeph']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Work"; ?></td>
							<td><?php if (isset($rowphcnt['workph'])) { echo $rowphcnt['workph']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Mobile"; ?></td>
							<td><?php if (isset($rowphcnt['mobile'])) { echo $rowphcnt['mobile']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Email"; ?></td>
							<td><?php if (isset($rowphcnt['email'])) { echo $rowphcnt['email']; } ?></td>
						</tr>
					</tbody>
				</table>
			
				<?php
					//Comment
					if (isset($_GET['nv']) && $_GET['nv'] == "phncntdt") {
						include_once '../link/message/commentsta.php';
					}
				?>
			</div>
			<div class="w3-container">
			</div>
		</div>
		
		<div class="w3-white w3-card-4" style="margin-top:20px;" >
			<header class="w3-container w3-blueh">
				<span id="emgcnt"><h4>Emergency Contact</h4></span>
			</header>
				<?php 
					if (isset($_GET['ptid'])) {
						
						$ptid = base64_decode(urldecode($_GET['ptid']));
						
						$sqldata = "SELECT
										b.id as emegid,
										b.homeph as homeph,
										b.workph as workph,
										b.mobile as mobile,
										b.email as email
									FROM studentinfo a 
						INNER JOIN emergency b on a.emerid = b.id 
						WHERE a.id = ".$ptid;
						
						$result = mysqli_query($conn, $sqldata);
						$resultCheck = mysqli_num_rows($result);
						
						if ($resultCheck > 0) {
							
							$rowemeg = mysqli_fetch_assoc($result);
											
							//For Saving Emergency
							$_SESSION['emegid'] = $rowemeg['emegid'];
							
						}
					}
				?>
			
			<div class="w3-container  w3-margin-bottom w3-margin-top">	
				<table class="w3-table-all w3-card-4">
					<thead>
						<tr class="w3-blueh">
							<th>Data</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "Home"; ?></td>
							<td><?php if (isset($rowemeg['homeph'])) { echo $rowemeg['homeph']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Work"; ?></td>
							<td><?php if (isset($rowemeg['workph'])) { echo $rowemeg['workph']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Mobile"; ?></td>
							<td><?php if (isset($rowemeg['mobile'])) { echo $rowemeg['mobile']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Email"; ?></td>
							<td><?php if (isset($rowemeg['email'])) { echo $rowemeg['email']; } ?></td>
						</tr>
					</tbody>
				</table>
				
				<?php
					//Comment
					if (isset($_GET['nv']) && $_GET['nv'] == "emgcnt") {
						include_once '../link/message/commentsta.php';
					}
				?>
			</div>
			<div class="w3-container">
			</div>
		</div>
		
		<div class="w3-white w3-card-4" style="margin-top:20px;">
			<header class="w3-container w3-blueh">
				<span id="lngnculdv"><h4>Language and Cultural Diversity</h4></span>
			</header>
			
				<?php 
					if (isset($_GET['ptid'])) {
						
						$ptid = base64_decode(urldecode($_GET['ptid']));
						
						$sqldata = "SELECT
										b.id as langid,
										b.cntbrn,
										b.cntbrnother,
										b.rsdnttype,
										b.rsdnttypeother,
										b.languages,
										b.languagesother,
										b.engwell,
										b.abtor
									FROM studentinfo a 
						INNER JOIN languages b on a.langid = b.id 
						WHERE a.id = ".$ptid;
						
						$result = mysqli_query($conn, $sqldata);
						$resultCheck = mysqli_num_rows($result);
						
						
						if ($resultCheck > 0) {
							
							$rowlang = mysqli_fetch_assoc($result);
							//For Saving Residence
							$_SESSION['langid'] = $rowlang['langid'];
						}
					}
				?>
			
			<div class="w3-container  w3-margin-bottom w3-margin-top">	
				<table class="w3-table-all w3-card-4">
					<thead>
						<tr class="w3-blueh">
							<th>Data</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "In which country were you born?"; ?></td>
							<td><?php if (isset($rowlang['cntbrn'])) { 
								if($rowlang['cntbrn'] != "Other")
									echo $rowlang['cntbrn'];
								else
									echo $rowlang['cntbrnother'];
							} ?></td>
						</tr>
						<tr>
							<td><?php echo "Resident Type"; ?></td>
							<td><?php if (isset($rowlang['rsdnttype'])) { 
								if($rowlang['rsdnttype'] != "Other")
									echo $rowlang['rsdnttype'];
								else
									echo $rowlang['rsdnttypeother'];
							} ?></td>
						</tr>
						<tr>
							<td><?php echo "Languages"; ?></td>
							<td><?php if (isset($rowlang['languages'])) { 
								if($rowlang['languages'] != "Yes, Specify")
									echo $rowlang['languages'];
								else
									echo $rowlang['languagesother'];
							} ?></td>
						</tr>
						<tr>
							<td><?php echo "How well do you speak in English?"; ?></td>
							<td><?php if (isset($rowlang['engwell'])) { echo $rowlang['engwell']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Are you of Aboriginal or Torres Strait Islander origin?"; ?></td>
							<td><?php if (isset($rowlang['abtor'])) { echo $rowlang['abtor']; } ?></td>
						</tr>
					</tbody>
				</table>
				<?php			
					//Comment
					if (isset($_GET['nv']) && $_GET['nv'] == "lngnculdv") {
						include_once '../link/message/commentsta.php';
					}
				?>
			</div>
			<div class="w3-container">
			</div>
		</div>
		
		<div class="w3-white w3-card-4" style="margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<span id="indlnneeds"><h4>Individual Learning Needs</h4></span>
			</header>
			
			<?php 
				if (isset($_GET['ptid'])) {
					
					$ptid = base64_decode(urldecode($_GET['ptid']));
					
					$sqldata = "SELECT
									b.id as indleid,
									b.disabimpr,
									b.disyes,
									b.disother,
									b.disadjust
								FROM studentinfo a 
					INNER JOIN indlearnneeds b on a.indlearid = b.id 
					WHERE a.id = ".$ptid;
					
					$result = mysqli_query($conn, $sqldata);
					$resultCheck = mysqli_num_rows($result);
					
					
					if ($resultCheck > 0) {
						
						$rowindln = mysqli_fetch_assoc($result);
						//For Saving Individual Learning
						$_SESSION['indleid'] = $rowindln['indleid'];
					}
				}
			?>
			<div class="w3-container  w3-margin-bottom w3-margin-top">	
				<table class="w3-table-all w3-card-4">
					<thead>
						<tr class="w3-blueh">
							<th>Data</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "Do you consider yourself to have a disability, Impairment or long-term condition?"; ?></td>
							<td><?php if (isset($rowindln['disabimpr'])) { 
								if($rowindln['disabimpr'] == 1)
									echo "Yes";
								else
									echo "No";
							} ?></td>
						</tr>
						<tr>
							<td><?php echo "If yes, please indicate(You may indicate more than one)?"; ?></td>
								<td><?php if (isset($rowindln['disyes'])) { 
								if($rowindln['disyes'] != "Other" && $rowindln['disabimpr'] == 1)
									echo $rowindln['disyes'];
							} ?></td>
						</tr>
						<tr>
							<td><?php echo "Adjustment"; ?></td>
							<td><?php if (isset($rowindln['disadjust'])) { echo $rowindln['disadjust']; } ?></td>
						</tr>
					</tbody>
				</table>
				
				<?php
					//Comment
					if (isset($_GET['nv']) && $_GET['nv'] == "indlnneeds") {
						include_once '../link/message/commentsta.php';
					}
				?>
			</div>
			<div class="w3-container">
			</div>
		</div>
		
		<div class="w3-white w3-card-4" style="margin-top:20px;">
			<header class="w3-container w3-blueh">
				<span id="edu"><h4>Education</h4></span>
			</header>
			<?php 
				if (isset($_GET['ptid'])) {
					
					$ptid = base64_decode(urldecode($_GET['ptid']));
					
					$sqldata = "SELECT
									b.id as eduid,
									b.highschool,
									b.year,
									b.snd,
									b.success,
									b.successyes
								FROM studentinfo a 
					INNER JOIN education b on a.educaid = b.id 
					WHERE a.id = ".$ptid;
					
					$result = mysqli_query($conn, $sqldata);
					$resultCheck = mysqli_num_rows($result);
					
					
					if ($resultCheck > 0) {
						
						$rowedu = mysqli_fetch_assoc($result);
						//For Saving Education
						$_SESSION['eduid'] = $rowedu['eduid'];
					}
				}
			?>
			<div class="w3-container  w3-margin-bottom w3-margin-top">	
				<table class="w3-table-all w3-card-4">
					<thead>
						<tr class="w3-blueh">
							<th>Data</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "Highest Completed School Level"; ?></td>
							<td><?php if (isset($rowedu['highschool'])) { echo $rowedu['highschool']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "In which Year did you complete that level"; ?></td>
							<td><?php if (isset($rowedu['year'])) { echo $rowedu['year']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Are you still attending secondary level?"; ?></td>
							<td><?php if (isset($rowedu['snd'])) { 
								if($rowedu['snd'] == 1)
									echo "Yes";
								else
									echo "No";
							} ?></td>
						</tr>
						<tr>
							<td><?php echo "Have you successfully completed any of the following qualification?"; ?></td>
							<td><?php if (isset($rowedu['success'])) { 
								if($rowedu['success'] == 1)
									echo "Yes";
								else
									echo "No";
							} ?></td>
						</tr>
						<tr>
							<td><?php echo "Qualification"; ?></td>
							<td><?php if (isset($rowedu['successyes'])) { echo $rowedu['successyes']; } ?></td>
						</tr>
					</tbody>
				</table>
				<?php
					//Comment
					if (isset($_GET['nv']) && $_GET['nv'] == "edu") {
						include_once '../link/message/commentsta.php';
					}
				?>
			</div>
			<div class="w3-container">
			</div>
		</div>
		
		<div class="w3-white w3-card-4" style="margin-top:20px;">
			<header class="w3-container w3-blueh">
				<span id="refstudy"><h4>Reason for study</h4></span>
			</header>
			
			<div class="w3-container w3-margin-bottom w3-margin-top">
				<?php 
					if (isset($_GET['ptid'])) {
						
						$ptid = base64_decode(urldecode($_GET['ptid']));
						
						$sqldata = "SELECT 
										b.id,
										b.hearabout,
										b.other,
										b.hearaboutv
									FROM studentinfo a 
						INNER JOIN reastud b on a.reastudid = b.id 
						WHERE a.id = ".$ptid;
						
						$result = mysqli_query($conn, $sqldata);
						$resultCheck = mysqli_num_rows($result);
						
						
						if ($resultCheck > 0) {
							
							$rowreastud = mysqli_fetch_assoc($result);
							//For Saving
							$_SESSION["reasid"] = $rowreastud['id'];
							
							$sqllist = "SELECT 
											a.descrp
										FROM reastudlist a 
							INNER JOIN reastud b on a.reasid  = b.id  
							WHERE a.reasid = ".$rowreastud['id'];
							
							$resultlist = mysqli_query($conn, $sqllist);
							$rowrealist = array();
							while ($rowreastudlist = mysqli_fetch_assoc($resultlist)) {
								array_push($rowrealist,$rowreastudlist['descrp']);
							}
							
						}
					}
				?>
				<table class="w3-table-all w3-card-4">
					<thead>
						<tr class="w3-blueh">
							<th>Data</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "Which best describes your reasons for enrolling in the qualification?"; ?></td>
							<td>
								<table class="w3-table w3-border">
									<?php
										
										foreach($rowrealist as $var) {
											
											if ($var != "Other reason")
												echo "<tr class='w3-white'><td>".$var."</td></tr>";
											else
												echo "<tr class='w3-white'><td>".$rowreastud['other']."</td></tr>";
										}
										
									?>
								</table>
							</td>
						</tr>
						<tr>
							<td><?php echo "Hear about"; ?></td>
								<td><?php if (isset($rowreastud['hearabout'])) { 
								if($rowreastud['hearabout'] == "Advertisement - where" ||
								$rowreastud['hearabout'] == "Word of mouth - who" ||
								$rowreastud['hearabout'] == "Other") {
									echo $rowreastud['hearabout'].": ".$rowreastud['hearaboutv'];
								}
								else {
									echo $rowreastud['hearabout'];
								}
							} ?></td>
						</tr>
					</tbody>
				</table>
				
				<?php
					//Comment
					if (isset($_GET['nv']) && $_GET['nv'] == "refstudy") {
						include_once '../link/message/commentsta.php';
					}
				?>
			</div>
			<div class="w3-container">
			</div>
		</div>
		
		<div class="w3-white w3-card-4" style="margin-top:20px;">
			<header class="w3-container w3-blueh">
				<span id="currempst"><h4>Current Employment Status</h4></span>
			</header>
			
			<?php 
				if (isset($_GET['ptid'])) {
					
					$ptid = base64_decode(urldecode($_GET['ptid']));
					
					$sqldata = "SELECT 
									b.id as curempidc, 
									b.empstatus,
									b.regs
								FROM studentinfo a 
					INNER JOIN curempstatus b on a.curempid = b.id 
					WHERE a.id = ".$ptid;
					
					$result = mysqli_query($conn, $sqldata);
					$resultCheck = mysqli_num_rows($result);
					
					if ($resultCheck > 0) {
						
						$rowrstatus = mysqli_fetch_assoc($result);
						//For Saving
						$_SESSION['curempidc'] = $rowrstatus['curempidc'];
						
					}
				}
			?>
			<div class="w3-container w3-margin-bottom w3-margin-top">
				<table class="w3-table-all w3-card-4">
					<thead>
						<tr class="w3-blueh">
							<th>Data</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "Employment Status"; ?></td>
							<td><?php if (isset($rowrstatus['empstatus'])) { echo $rowrstatus['empstatus']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Registered for unemployment benefits with centrelink"; ?></td>
							<td><?php if (isset($rowrstatus['regs'])) { 
								if($rowrstatus['regs'] == 1)
									echo "Yes";
								else
									echo "No";
							} ?></td>
					</tr>
					</tbody>
				</table>
				
				<?php
					//Comment
					if (isset($_GET['nv']) && $_GET['nv'] == "currempst") {
						include_once '../link/message/commentsta.php';
					}
				?>
			</div>
			<div class="w3-container">
			</div>
		</div>
		
		
		<div class="w3-white w3-card-4" style="margin-top:20px;">
			<header class="w3-container w3-blueh">
				<span id="empdt"><h4>Employer Details</h4></span>
			</header>
			
			<?php 
				if (isset($_GET['ptid'])) {
					
					$ptid = base64_decode(urldecode($_GET['ptid']));
					
					$sqldata = "SELECT
									b.id as empdtid,
									b.empcomname,
									b.empcntname,
									b.empaddress,
									b.empsub,
									b.emphone,
									b.empemail
								FROM studentinfo a 
					INNER JOIN employerdt b on a.empid = b.id 
					WHERE a.id = ".$ptid;
					
					$result = mysqli_query($conn, $sqldata);
					$resultCheck = mysqli_num_rows($result);
					
					
					if ($resultCheck > 0) {
						
						$rowempdt = mysqli_fetch_assoc($result);
						//For Saving
						$_SESSION['empdtid'] = $rowempdt['empdtid'];
					}
				}
			?>
			<div class="w3-container w3-margin-bottom w3-margin-top">
				<table  class="w3-table-all w3-card-4">
					<thead>
						<tr class="w3-blueh">
							<th>Data</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
					<tr>
							<td><?php echo "Company Name"; ?></td>
							<td><?php if (isset($rowempdt['empcomname'])) { echo $rowempdt['empcomname']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Contact Name"; ?></td>
							<td><?php if (isset($rowempdt['empcntname'])) { echo $rowempdt['empcntname']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Address"; ?></td>
							<td><?php if (isset($rowempdt['empaddress'])) { echo $rowempdt['empaddress']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Suburb"; ?></td>
							<td><?php if (isset($rowempdt['empsub'])) { echo $rowempdt['empsub']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Phone"; ?></td>
							<td><?php if (isset($rowempdt['emphone'])) { echo $rowempdt['emphone']; } ?></td>
						</tr>
						<tr >
							<td><?php echo "Email"; ?></td>
							<td><?php if (isset($rowempdt['empemail'])) { echo $rowempdt['empemail']; } ?></td>
						</tr>
					</tbody>
				</table>
				
				<?php
					//Comment
					if (isset($_GET['nv']) && $_GET['nv'] == "empdt") {
						include_once '../link/message/commentsta.php';
					}
			?>
			</div>
			<div class="w3-container">
			</div>
		</div>
		
		<div class="w3-white w3-card-4" style="margin-top:20px;">
			<header class="w3-container w3-blueh">
				<span id="appntr"><h4>Apprenticeships and Traineeships</h4></span>
			</header>
			
			<?php 
				if (isset($_GET['ptid'])) {
					
					$ptid = base64_decode(urldecode($_GET['ptid']));
					
					$sqldata = "SELECT 
									b.id as apptid,
									b.appres,
									b.appresdate,
									b.appretitle,
									b.hrsperweek
								FROM studentinfo a 
					INNER JOIN apprentrn b on a.appid = b.id 
					WHERE a.id = ".$ptid;
					
					$result = mysqli_query($conn, $sqldata);
					$resultCheck = mysqli_num_rows($result);
					
					
					if ($resultCheck > 0) {
						
						$rowappren = mysqli_fetch_assoc($result);
						//For Saving
						$_SESSION['apptid'] = $rowappren['apptid'];
					}
				}
			?>
			
			<div class="w3-container w3-margin-bottom w3-margin-top">
				<table class="w3-table-all w3-card-4">
					<thead>
						<tr class="w3-blueh">
							<th>Data</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "Part of apprenticeships and traineeships"; ?></td>
							<td><?php if (isset($rowappren['appres'])) { 
								if($rowappren['appres'] == 1)
									echo "Yes";
								else
									echo "No";
							} ?></td>
						</tr>
						<tr>
							<td><?php echo "Start Date"; ?></td>
							<td><?php if (isset($rowappren['appresdate'])) { $date=date_create($rowappren['appresdate']); echo date_format($date,"F d, Y"); } ?></td>
						</tr>
						<tr>
							<td><?php echo "Job Title"; ?></td>
							<td><?php if (isset($rowappren['appretitle'])) { echo $rowappren['appretitle']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Hours per week"; ?></td>
							<td><?php if (isset($rowappren['hrsperweek'])) { echo $rowappren['hrsperweek']; } ?></td>
						</tr>
					</tbody>
				</table>
				
				<?php		
					//Comment
					if (isset($_GET['nv']) && $_GET['nv'] == "appntr") {
						include_once '../link/message/commentsta.php';
					}
				?>
			</div>
			<div class="w3-container">
			</div>
		</div>
		
		<div class="w3-white w3-card-4" style="margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<span id="recogpr"><h4>Recognition of Prior Learning/Credit</h4></span>
			</header>
			
			<?php 
				if (isset($_GET['ptid'])) {
					
					$ptid = base64_decode(urldecode($_GET['ptid']));
					
					$sqldata = "SELECT 
									b.id as recogid,
									b.recog
								FROM studentinfo a 
					INNER JOIN recogprior b on a.recogid = b.id 
					WHERE a.id = ".$ptid;
					
					$result = mysqli_query($conn, $sqldata);
					$resultCheck = mysqli_num_rows($result);
					
					
					if ($resultCheck > 0) {
						
						$rowrecogpr = mysqli_fetch_assoc($result);
						//For Saving
						$_SESSION['recogid'] = $rowrecogpr['recogid'];
					}
				}
			?>
			<div class="w3-container w3-margin-bottom w3-margin-top">
				<table class="w3-table-all w3-card-4">
					<thead>
						<tr class="w3-blueh">
							<th>Data</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "RPL or credit transfer"; ?></td>
							<td><?php if (isset($rowrecogpr['recog'])) { 
								if($rowrecogpr['recog'] == 1)
									echo "Yes";
								else
									echo "No";
							} ?></td>
						</tr>
					</tbody>
				</table>
				<?php				
					//Comment
					if (isset($_GET['nv']) && $_GET['nv'] == "recogpr") {
						include_once '../link/message/commentsta.php';
					}
				?>
			</div>
			<div class="w3-container">
			</div>
		</div>
		
		<div class="w3-white w3-card-4" style="margin-top:20px;">
			<header class="w3-container w3-blueh">
				<span id="jobseek"><h4>Jobseekers Seeking Concession</h4></span>
			</header>
			
			<?php 
				if (isset($_GET['ptid'])) {
					
					$ptid = base64_decode(urldecode($_GET['ptid']));
					
					$sqldata = "SELECT 
									b.id as jobid,
									b.jbseekagen,
									b.empcoorname,
									b.jobseeksur,
									b.landline,
									b.jobseeknobile,
									b.jobseekstrdte,
									b.jsaclient,
									b.jobsearchfee
								FROM studentinfo a 
					INNER JOIN jobseekers b on a.jobid = b.id 
					WHERE a.id = ".$ptid;
					
					$result = mysqli_query($conn, $sqldata);
					$resultCheck = mysqli_num_rows($result);
					
					
					if ($resultCheck > 0) {
						
						$rowjobseekers = mysqli_fetch_assoc($result);
						//For Saving
						$_SESSION['jobid'] = $rowjobseekers['jobid'];
					}
				}
			?>
			<div class="w3-container w3-margin-bottom w3-margin-top">
				<table  class="w3-table-all w3-card-4">
					<thead>
						<tr class="w3-blueh">
							<th>Data</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "Job Search Agency"; ?></td>
							<td><?php if (isset($rowjobseekers['jbseekagen'])) { echo $rowjobseekers['jbseekagen']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Employment Co-ordinator's Name"; ?></td>
							<td><?php if (isset($rowjobseekers['empcoorname'])) { echo $rowjobseekers['empcoorname']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Suburb"; ?></td>
							<td><?php if (isset($rowjobseekers['jobseeksur'])) { echo $rowjobseekers['jobseeksur']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Landline"; ?></td>
							<td><?php if (isset($rowjobseekers['landline'])) { echo $rowjobseekers['landline']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Mobile"; ?></td>
							<td><?php if (isset($rowjobseekers['jobseeknobile'])) { echo $rowjobseekers['jobseeknobile']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Start Date"; ?></td>
							<td><?php if (isset($rowjobseekers['jobseekstrdte'])) { $date=date_create($rowjobseekers['jobseekstrdte']); echo date_format($date,"F d, Y"); } ?></td>
						</tr>
						<tr>
							<td><?php echo "JSA Client Group"; ?></td>
							<td><?php if (isset($rowjobseekers['jsaclient'])) { echo $rowjobseekers['jsaclient']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Job Search Agency Fees"; ?></td>
							<td><?php if (isset($rowjobseekers['jobsearchfee'])) { 
								if($rowjobseekers['jobsearchfee'] == 1)
									echo "Yes";
								else
									echo "No";
							} ?></td>
						</tr>
					</tbody>
				</table>
				
				<?php		
					//Comment
					if (isset($_GET['nv']) && $_GET['nv'] == "jobseek") {
						include_once '../link/message/commentsta.php';
					}
				?>
			</div>
			<div class="w3-container">
			</div>
		</div>
		
		<div id="coursefee" class="w3-white w3-card-4"
			<?php 
				if(!empty($rowjobseekers) && $rowjobseekers['jobsearchfee']== 1) {
					echo "style='margin-top:20px;'";
				}
				else {
					echo "style='margin-top:20px; display:none;'";
				}
			?>>
			<header class="w3-container w3-blueh w3-tea">
				<h4>Course Fee</h4>
			</header>
			
			<?php 
				if (isset($_GET['ptid'])) {
					
					$ptid = base64_decode(urldecode($_GET['ptid']));
					
					$sqldata = "SELECT
									b.id as coursefid,
									b.paytype,
									b.stdname,
									b.thrdrepname,
									b.thrdinvoice,
									b.crdtype,
									b.crdnum
								FROM studentinfo a 
					INNER JOIN coursefee b on a.courseid = b.id 
					WHERE a.id = ".$ptid;
					
					$result = mysqli_query($conn, $sqldata);
					$resultCheck = mysqli_num_rows($result);
					
					
					if ($resultCheck > 0) {
						
						$rowcoursefee = mysqli_fetch_assoc($result);
						//For Saving
						$_SESSION['coursefid'] = $rowcoursefee['coursefid'];
					}
				}
			?>
			<div class="w3-container w3-margin-bottom w3-margin-top">
				<table class="w3-table-all w3-card-4">
					<thead>
						<tr class="w3-blueh">
							<th>Data</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "Payment Type"; ?></td>
							<td><?php if (isset($rowcoursefee['paytype'])) { echo $rowcoursefee['paytype']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Student Name"; ?></td>
							<td><?php if (isset($rowcoursefee['stdname'])) { echo $rowcoursefee['stdname']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Third Party Representative Name"; ?></td>
							<td><?php if (isset($rowcoursefee['thrdrepname'])) { echo $rowcoursefee['thrdrepname']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Third, the invoice is to be made out to"; ?></td>
							<td><?php if (isset($rowcoursefee['thrdinvoice'])) { echo $rowcoursefee['thrdinvoice']; } ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="w3-container">
			</div>
		</div>
		
		<div id="creditcard"  class="w3-white w3-card-4"
			<?php 
				if(!empty($rowjobseekers) && $rowjobseekers['jobsearchfee']== 1) {
					echo "style='margin-top:20px;'";
				}
				else {
					echo "style='margin-top:20px; display:none;'";
				}
			?>>
			<header class="w3-container w3-blueh">
				<h4>Credit Card</h4>
			</header>
			<div class="w3-container w3-margin-bottom w3-margin-top">
				<table class="w3-table-all w3-card-4">
					<thead>
						<tr class="w3-blueh">
							<th>Data</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "Card Type"; ?></td>
							<td><?php if (isset($rowcoursefee['crdtype'])) { echo $rowcoursefee['crdtype']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Card Number"; ?></td>
							<td><?php if (isset($rowcoursefee['crdnum'])) { echo $rowcoursefee['crdnum']; } ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="w3-container">
			</div>
		</div>
		
		<div class="w3-white w3-card-4" style="margin-top:20px;">
			<header class="w3-container w3-blueh">
				<span id="centdt"><h4>Centrelink Details</h4></span>
			</header>
			
			<?php 
				if (isset($_GET['ptid'])) {
					
					$ptid = base64_decode(urldecode($_GET['ptid']));
					
					$sqldata = "SELECT 
									b.id as centid,
									b.cntrallow,
									b.allowances,
									b.refnum,
									b.vetnum
								FROM studentinfo a 
					INNER JOIN centrelink b on a.centid = b.id 
					WHERE a.id = ".$ptid;
					
					$result = mysqli_query($conn, $sqldata);
					$resultCheck = mysqli_num_rows($result);
					
					
					if ($resultCheck > 0) {
						
						$rowcentrelink = mysqli_fetch_assoc($result);
						//For Saving
						$_SESSION['centid'] = $rowcentrelink['centid'];
					}
				}
			?>
			<div class="w3-container w3-margin-bottom w3-margin-top">
				<table class="w3-table-all w3-card-4">
					<thead>
						<tr class="w3-blueh">
							<th>Data</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo "Job Search Agency Fees"; ?></td>
							<td><?php if (isset($rowcentrelink['cntrallow'])) { 
								if($rowcentrelink['cntrallow'] == 1)
									echo "Yes";
								else
									echo "No";
							} ?></td>
						</tr>
						<tr>
							<td><?php echo "Allowances"; ?></td>
							<td><?php if (isset($rowcentrelink['allowances']) && $rowcentrelink['cntrallow'] == 1) { echo $rowcentrelink['allowances']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "Reference Number"; ?></td>
							<td><?php if (isset($rowcentrelink['refnum']) && $rowcentrelink['cntrallow'] == 1) { echo $rowcentrelink['refnum']; } ?></td>
						</tr>
						<tr>
							<td><?php echo "VET Number"; ?></td>
							<td><?php if (isset($rowcentrelink['vetnum']) && $rowcentrelink['cntrallow'] == 1) { echo $rowcentrelink['vetnum']; } ?></td>
						</tr>
					</tbody>
				</table>	
				<?php	
					//Comment
					if (isset($_GET['nv']) && $_GET['nv'] == "centdt") {
						include_once '../link/message/commentsta.php';
					}
				?>
			</div>
			<div class="w3-container">
			</div>
		</div>
		
		<div style="margin-top:20px;">
		</div>
		
	</form>
		
</div>

<script>
	function w3_open() {
		document.getElementById("mySidebar").style.display = "block";
	}
	function w3_close() {
		document.getElementById("mySidebar").style.display = "none";
	}
	function w3_showother() {
		document.getElementById("stdstatep").style.display = "block";
	}
	function w3_hideother() {
		document.getElementById("stdstatep").style.display = "none";
	}
	function w3_hideothervisa() {
		document.getElementById("stdvisatype").style.display = "none";
	}
	function w3_showothervisa() {
		document.getElementById("stdvisatype").style.display = "block";
	}
	function w3_showotherlang() {
		document.getElementById("stdspecify").style.display = "block";
	}
	function w3_hideotherlang() {
		document.getElementById("stdspecify").style.display = "none";
	}
	function w3_showdisability() {
		document.getElementById("disabilityYes").style.display = "block";
	}
	function w3_hidedisability() {
		document.getElementById("disabilityYes").style.display = "none";
	}
	function w3_showotherdisability() {
		document.getElementById("stdotherdis").style.display = "block";
	}
	function w3_hideotherdisability() {
		document.getElementById("stdotherdis").style.display = "none";
	}
	function w3_hidequalcomp() {
		document.getElementById("qualsuccomp").style.display = "none";
	}
	function w3_showqualcomp() {
		document.getElementById("qualsuccomp").style.display = "block";
	}
	function w3_showotherreason() {
		if (document.getElementById("otherreasonstate").style.display == "none")
			document.getElementById("otherreasonstate").style.display = "block";
		else
			document.getElementById("otherreasonstate").style.display = "none";
	}
	function w3_showadvertisemen() {
		document.getElementById("advertisementwhe").style.display = "block";
		document.getElementById("otherhear").style.display = "none";
		document.getElementById("wordofmout").style.display = "none";
	}
	function w3_showwordof() {
		document.getElementById("wordofmout").style.display = "block";
		document.getElementById("otherhear").style.display = "none";;
		document.getElementById("advertisementwhe").style.display = "none";
	}
	function w3_showotherhear() {
		document.getElementById("otherhear").style.display = "block";
		document.getElementById("advertisementwhe").style.display = "none";
		document.getElementById("wordofmout").style.display = "none";;
	}
	function w3_showwebsite() {
		document.getElementById("otherhear").style.display = "none";
		document.getElementById("advertisementwhe").style.display = "none";
		document.getElementById("wordofmout").style.display = "none";;
	}
	function w3_hideemployer() {
		document.getElementById("employerdetails").style.display = "none";
	}
	function w3_showemployer() {
		document.getElementById("employerdetails").style.display = "block";
	}
	function w3_showcoursefee() {
		document.getElementById("coursefee").style.display = "block";
		document.getElementById("creditcard").style.display = "block";
	}
	function w3_hidecoursefee() {
		document.getElementById("coursefee").style.display = "none";
		document.getElementById("creditcard").style.display = "none";
	}
	function w3_showreg() {
		document.getElementById("regiscentre").style.display = "block";
	}
	function w3_hidereg() {
		document.getElementById("regiscentre").style.display = "none";
	}
</script>