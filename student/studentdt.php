<?php 
	include_once 'headerwithsearchhome.php';
	include_once '../data/dbh.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
	include_once 'menuwithquerystr.php';
?>
<div style="width:25%">
	<button class="w3-button w3-blueh w3-xlarge
		w3-hover-green w3-hide-large" 
		onclick="w3_open()">&#9776;</button>
</div>

<div class="w3-main w3-small" style="margin-top:16px; 
	margin-left:220px; font-family: Arial, Helvetica, sans-serif;">
	<form action="data/update.php" method="GET">
		
		<?php
		
			if (isset($_GET['s'])) {
				echo "<h3>The proccess is successfully.</h3>";
			}
		
		?>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:99%;">
			<header class="w3-container w3-blueh w3-tea">
				<span id="perdt"><h3>Personal Details</h3></span>
			</header>
			
			<?php 
				if (isset($_GET['ptid'])) {
					
					$ptid = base64_decode(urldecode($_GET['ptid']));
					
					$sqldata = "SELECT
									b.id as perid,
									b.code as code,
									b.fname as fname,
									b.gname as gname,
									b.pname as pname,
									b.brhday as brhday,
									b.age as age,
									a.stdcourse as stdcourse
								FROM studentinfo a 
					INNER JOIN personaldt b on a.stdcode = b.id 
					WHERE a.id = ".$ptid;
					
					
					//Session value for personaldt
					$_SESSION['stdid'] = $ptid;
					
					//Comment
					if (isset($_GET['nv']) && isset($_GET['cnt']) &&
						$_GET['nv'] == "perdt") {
						$cnt = base64_decode(urldecode($_GET['cnt']));
						echo "<h3><b>Comment:</b>".$cnt."</h3>";
					}
					
					$result = mysqli_query($conn, $sqldata);
					
					while ($row = mysqli_fetch_assoc($result)) {
						
						echo "<p style='margin-top:20px;'>
						<select class='w3-select w3-select-input w3-animate-input'
						style='width:200px;' name='optcourse'>";
						
						//Load List of Course
						$sqlcourse = "SELECT code,descrp FROM courselist";
						$resultco = mysqli_query($conn,$sqlcourse);
						while($rowcr = mysqli_fetch_assoc($resultco)) {
							if ($row['stdcourse'] == $rowcr['code']) {
								echo "<option value='".$rowcr['code']."'
								selected>".$rowcr['descrp']."</option>";
							}
							else {
								echo "<option value='".$rowcr['code']."'
								>".$rowcr['descrp']."</option>";
							}
						}
					
						echo "</select></p>";
						
						echo "<p style='margin-top:20px;'>
						<label>USI</label><input type='text'
						class='w3-input w3-border w3-animate-input'
						style='width:200px'name='stdcode' 
						value='".$row['code']."'></input></p>
						<p style='margin-top:20px;'>
						<label>Family Name</label><input type='text' 
						class='w3-input w3-border w3-animate-input' \
						style='width:200px'	name='stdfname'
						value='".$row['fname']."'/></p>
						<p style='margin-top:20px;'>
						<label>Given Name</label><input type='text' 
						class='w3-input w3-border w3-animate-input'
						style='width:200px'	name='stdgname' 
						value='".$row['gname']."'/></p>
						<p style='margin-top:20px;'>
						<label>Preffered Name</label><input type='text'
						class='w3-input w3-border w3-animate-input'
						style='width:200px'	name='stdpname' 
						value='".$row['pname']."'/></p>
						<p style='margin-top:20px;'>
						<label>Birthday</label><input type='date'
						class='w3-input w3-border w3-animate-input'
						style='width:200px'	name='stdbth'		
						value=".$row['brhday']." /></p>
						<p style='margin-top:20px;'>
						<label>Age</label><input type='number'
						class='w3-input w3-border'
						style='width:70px'	name='stdage' 
						value='".$row['age']."'  /></p>";
						
						//Session value for personaldt
						$_SESSION['stdcode'] = $row['code'];
						$_SESSION['stdfname'] = $row['fname'];
						$_SESSION['stdgname'] = $row['gname'];
						$_SESSION['perid'] = $row['perid'];
						
						//Saving
						if (isset($_GET['nv']) && isset($_GET['cnt']) &&
							$_GET['nv'] == "perdt") {
							echo "<button type='submit' name='submitupdate' 
								class='w3-blueh w3-hover-green w3-padding-large
								w3-border w3-large'
								>Save</button>";
						}
						
					}
				}
			?>
			
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:99%; margin-top:20px;" >
			<header class="w3-container w3-blueh w3-tea">
				<span id="resd"><h3>Residence</h3></span>
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
				
				//Comment
				if (isset($_GET['nv']) && isset($_GET['cnt']) &&
					$_GET['nv'] == "resd") {
					$cnt = base64_decode(urldecode($_GET['cnt']));
					echo "<h3><b>Comment:</b>".$cnt."</h3>";
				}
			?>
			
			<p style="margin-top:20px;">
			<label>Building/Property Name</label><input type="text" 
			class="w3-input w3-border w3-animate-input"
			style="width:200px"	name="stdbuildr" 
			<?php
				if (!empty($rowresd)) {
					echo "value='".$rowresd['building']."'";
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>Flat/Unit details</label><input type="text" 
			class="w3-input w3-border w3-animate-input"
			style="width:200px"	name="stdflastr" 
			<?php
				if (!empty($rowresd)) {
					echo "value='".$rowresd['flat']."'";
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>Street/Lot number</label><input type="text" 
			class="w3-input w3-border w3-animate-input"
			style="width:200px"	name="stdstrnumr"
			<?php
				if (!empty($rowresd)) {
					echo "value='".$rowresd['Street']."'";
				}
			?>			/></p>
			<p style="margin-top:20px;">
			<label>Suburb/Locality/Town</label><input type="text" 
			class="w3-input w3-border w3-animate-input"
			style="width:200px"	name="stdsltr" 
			<?php
				if (!empty($rowresd)) {
					echo "value='".$rowresd['Suburb']."'";
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>State</label><input type="text" 
			class="w3-input w3-border w3-animate-input"
			style="width:200px"	name="stdstater" 
			<?php
				if (!empty($rowresd)) {
					echo "value='".$rowresd['State']."'";
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>Postal Code</label><input type="text" 
			class="w3-input w3-border w3-animate-input"
			style="width:200px"	name="stdptlr" 
			<?php
				if (!empty($rowresd)) {
					echo "value='".$rowresd['postalcode']."'";
				}
			?>/></p>
			
			<?php
				if (isset($_GET['nv']) && isset($_GET['cnt']) &&
					$_GET['nv'] == "resd") {
					echo "<button type='submit' name='submitupdate' 
						class='w3-blueh w3-hover-green w3-padding-large
						w3-border w3-large'
						>Save</button>";
				}
			?>
			
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:99%; margin-top:20px;" >
			<header class="w3-container w3-blueh w3-tea">
				<span id="ptadd"><h3>Postal Address</h3></span>
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
						
						if (isset($_GET['nv']) && isset($_GET['cnt']) &&
							$_GET['nv'] == "ptadd") {
							$cnt = base64_decode(urldecode($_GET['cnt']));
							echo "<h3><b>Comment:</b>".$cnt."</h3>";
						}
						
						if($resultCheck > 0) {
							$row = mysqli_fetch_assoc($result);
							echo "<p style='margin-top:20px;'>
							<label>Building/Property Name</label><input type='text' 
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdbuildp' 
							value='".$row['building']."' /></p>
							<p style='margin-top:20px;'>
							<label>Flat/Unit details</label><input type='text' 
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdflastp' 
							value='".$row['flat']."'/></p>
							<p style='margin-top:20px;'>
							<label>Street/Lot number</label><input type='text' 
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdstrnump' 
							value='".$row['Street']."' /></p>
							<p style='margin-top:20px;'>
							<label>Suburb/Locality/Town</label><input type='text' 
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdsltp'
							value='".$row['Suburb']."' /></p>
							<p style='margin-top:20px;'>
							<label>State</label><input type='text' 
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='statept' 
							value='".$row['State']."' /></p>
							<p style='margin-top:20px;'>
							<label>Postal Code</label><input type='text' 
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdptlp' 
							value='".$row['postalcode']."' /></p>";
							
							//For Saving Residence
							$_SESSION['postid'] = $row['postid'];
							
						}
						else {
							echo "<p style='margin-top:20px;'>
							<label>Building/Property Name</label><input type='text' 
							class='w3-input w3-border w3-animate-input'
							style='width:200px'		
							name='stdbuildp'/></p>
							<p style='margin-top:20px;'>
							<label>Flat/Unit details</label><input type='text' 
							class='w3-input w3-border 
							w3-animate-input'
							style='width:200px'		
							name='stdflastp' /></p>
							<p style='margin-top:20px;'>
							<label>Street/Lot number</label><input type='text' 
							class='w3-input w3-border 
							w3-animate-input'
							style='width:200px'		
							name='stdstrnump' /></p>
							<p style='margin-top:20px;'>
							<label>Suburb/Locality/Town</label><input type='text' 
							class='w3-input w3-border 
							w3-animate-input'
							style='width:200px'		
							name='stdsltp' /></p>
							<p style='margin-top:20px;'>
							<label>State</label><input type='text' 
							class='w3-input w3-border 
							w3-animate-input'
							style='width:200px'		
							name='statept' /></p>
							<p style='margin-top:20px;'>
							<label>Postal Code</label><input type='text' 
							class='w3-input w3-border 
							w3-animate-input'
							style='width:200px'		
							name='stdptlp' /></p>";
						}
						
					}
					else {
						
						echo "<p style='margin-top:20px;'>
						<label>Building/Property Name</label><input type='text' 
						class='w3-input w3-border w3-animate-input'
						style='width:200px'		
						name='stdbuildp'/></p>
						<p style='margin-top:20px;'>
						<label>Flat/Unit details</label><input type='text' 
						class='w3-input w3-border 
						w3-animate-input'
						style='width:200px'		
						name='stdflastp' /></p>
						<p style='margin-top:20px;'>
						<label>Street/Lot number</label><input type='text' 
						class='w3-input w3-border 
						w3-animate-input'
						style='width:200px'		
						name='stdstrnump' /></p>
						<p style='margin-top:20px;'>
						<label>Suburb/Locality/Town</label><input type='text' 
						class='w3-input w3-border 
						w3-animate-input'
						style='width:200px'		
						name='stdsltp' /></p>
						<p style='margin-top:20px;'>
						<label>State</label><input type='text' 
						class='w3-input w3-border 
						w3-animate-input'
						style='width:200px'		
						name='statept' /></p>
						<p style='margin-top:20px;'>
						<label>Postal Code</label><input type='text' 
						class='w3-input w3-border 
						w3-animate-input'
						style='width:200px'		
						name='stdptlp' /></p>";
					}
					
					//Saving update
					if (isset($_GET['nv']) && isset($_GET['cnt']) &&
						$_GET['nv'] == "ptadd") {
						echo "<button type='submit' name='submitupdate' 
							class='w3-blueh w3-hover-green w3-padding-large
							w3-border w3-large'
							>Save</button>";
					}
				?>
			
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:99%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<span id="phncntdt"><h3>Phone and Contact details</h3></span>
			</header>
			
				<?php 
					if (isset($_GET['ptid'])) {
						
						$ptid = base64_decode(urldecode($_GET['ptid']));
						
						$sqldata = "SELECT 
										b.id as pntid,
										b.homeph as homeph,
										b.workph as workph,
										b.mobile as mobile,
										b.email as email
									FROM studentinfo a 
						INNER JOIN phonecontact b on a.phocnt = b.id 
						WHERE a.id = ".$ptid;
						
						$result = mysqli_query($conn, $sqldata);
						$resultCheck = mysqli_num_rows($result);
						
						//Comment
						if (isset($_GET['nv']) && isset($_GET['cnt']) &&
							$_GET['nv'] == "phncntdt") {
							$cnt = base64_decode(urldecode($_GET['cnt']));
							echo "<h3><b>Comment:</b>".$cnt."</h3>";
						}
						
						if($resultCheck > 0) {
							
							$row = mysqli_fetch_assoc($result);
							
							echo "<p style='margin-top:20px;'>
							<label>Home</label><input type='number'
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdhome' 
							value='".$row['homeph']."' /></p>
							<p style='margin-top:20px;'>
							<label>Work</label><input type='number'
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdwork'
							value='".$row['workph']."' /></p>
							<p style='margin-top:20px;'>
							<label>Mobile</label><input type='number'
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdmobile' 
							value='".$row['mobile']."' /></p>
							<p style='margin-top:20px;'>
							<label>Email</label><input type='email'
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdemail' 
							value='".$row['email']."' /></p>";
							
							//For Saving Residence
							$_SESSION['pntid'] = $row['pntid'];
							
						}
						else {
							
							echo "<p style='margin-top:20px;'>
							<label>Home</label><input type='number'
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdhome' /></p>
							<p style='margin-top:20px;'>
							<label>Work</label><input type='number'
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdwork' /></p>
							<p style='margin-top:20px;'>
							<label>Mobile</label><input type='number'
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdmobile' /></p>
							<p style='margin-top:20px;'>
							<label>Email</label><input type='email'
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdemail' /></p>";
							
						}
					}
					else {
						
						echo "<p style='margin-top:20px;'>
						<label>Home</label><input type='number'
						class='w3-input w3-border w3-animate-input'
						style='width:200px'	name='stdhome' /></p>
						<p style='margin-top:20px;'>
						<label>Work</label><input type='number'
						class='w3-input w3-border w3-animate-input'
						style='width:200px'	name='stdwork' /></p>
						<p style='margin-top:20px;'>
						<label>Mobile</label><input type='number'
						class='w3-input w3-border w3-animate-input'
						style='width:200px'	name='stdmobile' /></p>
						<p style='margin-top:20px;'>
						<label>Email</label><input type='email'
						class='w3-input w3-border w3-animate-input'
						style='width:200px'	name='stdemail' /></p>";
						
					}
					
					//Saving update
					if (isset($_GET['nv']) && isset($_GET['cnt']) &&
						$_GET['nv'] == "phncntdt") {
						echo "<button type='submit' name='submitupdate' 
							class='w3-blueh w3-hover-green w3-padding-large
							w3-border w3-large'
							>Save</button>";
					}
				?>
			
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:99%; margin-top:20px;" >
			<header class="w3-container w3-blueh w3-tea">
				<span id="emgcnt"><h3>Emegency Contact</h3></span>
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
						
						//Comment
						if (isset($_GET['nv']) && isset($_GET['cnt']) &&
							$_GET['nv'] == "emgcnt") {
							$cnt = base64_decode(urldecode($_GET['cnt']));
							echo "<h3><b>Comment:</b>".$cnt."</h3>";
						}
						
						if ($resultCheck > 0) {
							
							$row = mysqli_fetch_assoc($result);
							
							echo "<p style='margin-top:20px;'>
							<label>Home</label><input type='number'
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdhomee'
							value='".$row['homeph']."' /></p>
							<p style='margin-top:20px;'>
							<label>Work</label><input type='number'
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdworke'
							value='".$row['workph']."' /></p>
							<p style='margin-top:20px;'>
							<label>Mobile</label><input type='number'
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdmobilee' 
							value='".$row['mobile']."' /></p>
							<p style='margin-top:20px;'>
							<label>Email</label><input type='email'
							class='w3-input w3-border w3-animate-input'
							style='width:200px' name='stdemaile' 
							value='".$row['email']."' /></p>";
							
							//For Saving Residence
							$_SESSION['emegid'] = $row['emegid'];
							
						}
						else {
							
							echo "<p style='margin-top:20px;'>
							<label>Home</label><input type='number'
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdhomee' /></p>
							<p style='margin-top:20px;'>
							<label>Work</label><input type='number'
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdworke' /></p>
							<p style='margin-top:20px;'>
							<label>Mobile</label><input type='number'
							class='w3-input w3-border w3-animate-input'
							style='width:200px'	name='stdmobilee' /></p>
							<p style='margin-top:20px;'>
							<label>Email</label><input type='email'
							class='w3-input w3-border w3-animate-input'
							style='width:200px' name='stdemaile' /></p>";
							
						}
					}
					else {
						
						echo "<p style='margin-top:20px;'>
						<label>Home</label><input type='number'
						class='w3-input w3-border w3-animate-input'
						style='width:200px'	name='stdhomee' /></p>
						<p style='margin-top:20px;'>
						<label>Work</label><input type='number'
						class='w3-input w3-border w3-animate-input'
						style='width:200px'	name='stdworke' /></p>
						<p style='margin-top:20px;'>
						<label>Mobile</label><input type='number'
						class='w3-input w3-border w3-animate-input'
						style='width:200px'	name='stdmobilee' /></p>
						<p style='margin-top:20px;'>
						<label>Email</label><input type='email'
						class='w3-input w3-border w3-animate-input'
						style='width:200px' name='stdemaile' /></p>";
						
					}
					
					//Saving update
					if (isset($_GET['nv']) && isset($_GET['cnt']) &&
						$_GET['nv'] == "emgcnt") {
						echo "<button type='submit' name='submitupdate' 
							class='w3-blueh w3-hover-green w3-padding-large
							w3-border w3-large'
							>Save</button>";
					}
					
				?>
				
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:99%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<span id="lngnculdv"><h3>Language and Cultural Diversity</h3></span>
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
						
						//Comment
						if (isset($_GET['nv']) && isset($_GET['cnt']) &&
							$_GET['nv'] == "lngnculdv") {
							$cnt = base64_decode(urldecode($_GET['cnt']));
							echo "<h3><b>Comment:</b>".$cnt."</h3>";
						}
						
						if ($resultCheck > 0) {
							
							$rowlang = mysqli_fetch_assoc($result);
							//For Saving Residence
							$_SESSION['langid'] = $rowlang['langid'];
						}
					}
				?>
			
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
			style="margin-top:20px;">
				<label>In which country were you born?<label>
				<p><input class="w3-radio" type="radio" name="stdlang" value="Australia"  
				onclick="w3_hideother()" 
				<?php 
					if ($rowlang['cntbrn']=="Australia") {
							echo "Checked";
					}
				?> />
				<label>Australia</label></p>
				<p><input class="w3-radio" type="radio" name="stdlang" value="Other"
				onclick="w3_showother()"
				<?php 
					if ($rowlang['cntbrn']=="Other") {
							echo "Checked";
					}
				?> />
				<label>Other</label></p>
				<p><input type="text" class="w3-input w3-border 
				w3-animate-input w3-light-grey"	
				name="stdstatep"
				id="stdstatep"
				<?php
					if (!empty($rowlang['cntbrnother'])) {
							echo "Value='".$rowlang['cntbrnother']."'
							style='width:200px;'";
					}
					else {
						echo "style='width:200px; display: none;'";	
					}
				?> /></p>
			</div>
			
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
			style="margin-top:20px;">
				<label>Resident Type</label>
				<p><input class="w3-radio" type="radio" name="stdrsttype" value="Australian Citizen"  
				onclick="w3_hideothervisa()" <?php 
					if ($rowlang['rsdnttype']=="Australian Citizen") {
							echo "Checked";
					}
				?>/>
				<label>Australian Citizen</label></p>
				<p><input class="w3-radio" type="radio" name="stdrsttype" value="Permament Australia Resident" 
				onclick="w3_hideothervisa()" <?php 
					if ($rowlang['rsdnttype']=="Permament Australia Resideny") {
							echo "Checked";
					}
				?>/>
				<label>Permament Australia Resident</label></p>
				<p><input class="w3-radio" type="radio" name="stdrsttype" value="New Zealand Citizen Living in Austrialia" 
				onclick="w3_hideothervisa()" <?php 
					if ($rowlang['rsdnttype']=="New Zealand Citizen Living in Austrialia") {
							echo "Checked";
					}
				?>/>
				<label>New Zealand Citizen Living in Austrialia</label></p>
				<p><input class="w3-radio" type="radio" name="stdrsttype" value="Visa Type" 
				onclick="w3_showothervisa()" <?php 
					if ($rowlang['rsdnttype']=="Visa Type") {
							echo "Checked";
					}
				?>/>
				<label>Visa Type</label></p>
				<p><input type="text" class="w3-input w3-border 
				w3-animate-input w3-light-grey"	
				name="stdvisatype"
				id="stdvisatype"
				<?php
					if (!empty($rowlang['rsdnttypeother'])) {
							echo "Value='".$rowlang['rsdnttypeother']."'
							style='width:200px;'";
					}
					else {
						echo "style='width:200px; display: none;'";	
					}
				?>/></p>
			</div>
			
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
			style="margin-top:20px;">
				<label>Languages</label>
				<p><input class="w3-radio" type="radio" name="stdenghome" value="No, English Only"  
				onclick="w3_hideotherlang()" <?php 
					if ($rowlang['languages']=="No, English Only") {
							echo "Checked";
					}
				?> />
				<label>No, English only</label></p>
				<p><input class="w3-radio" type="radio" name="stdenghome" value="Yes, Specify" 
				onclick="w3_showotherlang()" <?php 
					if ($rowlang['languages']=="Yes, Specify") {
							echo "Checked";
					}
				?>  />
				<label>Yes, Specify</label></p>
				<input type="text" class="w3-input w3-border 
				w3-animate-input w3-light-grey"
				name="stdspecify"
				id="stdspecify" 
				<?php
					if (!empty($rowlang['languagesother'])) {
							echo "Value='".$rowlang['languagesother']."'
							style='width:200px;'";
					}
					else {
						echo "style='width:200px; display: none;'";	
					}
				?>></input>
			</div>
			
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
			style="margin-top:20px;">
				<label>How well do you speak in English?<label>
				<p><input class="w3-radio" type="radio" name="stdwelleng" 
				value="Very Well" <?php 
					if ($rowlang['engwell']=="Very Well") {
							echo "Checked";
					}
				?> />
				<label>Very Well</label></p>
				<p><input class="w3-radio" type="radio" name="stdwelleng" value="Well" 
				<?php 
					if ($rowlang['engwell']=="Well") {
							echo "Checked";
					}
				?>	/>
				<label>Well</label></p>
				<p><input class="w3-radio" type="radio" name="stdwelleng" value="Not Well"
				<?php 
					if ($rowlang['engwell']=="Not Well") {
							echo "Checked";
					}
				?>/>
				<label>Not Well</label></p>
				<p><input class="w3-radio" type="radio" name="stdwelleng" value="Not at all" 
				<?php 
					if ($rowlang['engwell']=="Not at all") {
							echo "Checked";
					}
				?>/>
				<label>Not at all</label></p>
			</div>
			
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Are you of Aboriginal or Torres Strait Islander origin?<label>
				<p><input class="w3-radio" type="radio" name="stdabotors" value="No" 
				<?php 
					if ($rowlang['abtor']=="No") {
							echo "Checked";
					}
				?> />
				<label>No</label></p>
				<p><input class="w3-radio" type="radio" name="stdabotors" value="Yes - Aboriginal" 
				<?php 
					if ($rowlang['abtor']=="Yes - Aboriginal") {
							echo "Checked";
					}
				?> />
				 <label>Yes - Aboriginal</label></p>
				<p><input class="w3-radio" type="radio" name="stdabotors" value="Yes - Torres Strait Islander"
				<?php 
					if ($rowlang['abtor']=="Yes - Torres Strait Islander") {
							echo "Checked";
					}
				?>/>
				<label>Yes - Torres Strait Islander</label></p>
			</div>
			
			<?php
				//Saving update
				if (isset($_GET['nv']) && isset($_GET['cnt']) &&
					$_GET['nv'] == "lngnculdv") {
					echo "<button type='submit' name='submitupdate' 
						class='w3-blueh w3-hover-green w3-padding-large
						w3-border w3-large'
						>Save</button>";
				}
			?>
			
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:99%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<span id="indlnneeds"><h3>Individual Learning Needs</h3></span>
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
						//For Saving Residence
						$_SESSION['indleid'] = $rowindln['indleid'];
					}
					
					//Comment
					if (isset($_GET['nv']) && isset($_GET['cnt']) &&
						$_GET['nv'] == "indlnneeds") {
						$cnt = base64_decode(urldecode($_GET['cnt']));
						echo "<h3><b>Comment:</b>".$cnt."</h3>";
					}
				}
			?>
			
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Do you consider yourself to have a disability, Impairment or long-term condition?<label>
				<p><input class="w3-radio" type="radio" name="stddisabi" value="Yes" onclick="w3_showdisability()" 
				<?php 
					if (isset($rowindln['disabimpr']) && 
					$rowindln['disabimpr'] == 1) {
							echo "Checked";
					}
				?>  />
				<label>Yes</label></p>
				<p><input class="w3-radio" type="radio" name="stddisabi" value="No"  onclick="w3_hidedisability()" 
				<?php 
					if (isset($rowindln['disabimpr']) && 
					$rowindln['disabimpr'] == 0) {
							echo "Checked";
					}
				?> />
				<label>No</label></p>
			</div>
			
			<div id="disabilityYes" 
					<?php 
						if (!empty($rowindln) && $rowindln['disabimpr']== 1) {
							echo "style='margin-top:20px;'";
						}
						else {
							echo "style='display:none; margin-top:20px;'";
						}
					?>>
				<div class="w3-container w3-white w3-card-4 w3-padding-large">
					<label>If yes, please indicate(You may indicate more than one)?<label>
					<p><input class="w3-radio" type="radio" name="stdindicate" value="Vision" onclick="w3_hideotherdisability()"
					<?php 
						if (!empty($rowindln) && $rowindln['disyes']== "Vision") {
							echo "Checked";
						}
					?> />
					<label>Vision</label></p>
					<p><input class="w3-radio" type="radio" name="stdindicate" value="Physical" onclick="w3_hideotherdisability()" 
					<?php 
						if (!empty($rowindln) && $rowindln['disyes']== "Physical") {
							echo "Checked";
						}
					?>/>
					<label>Physical</label></p>
					<p><input class="w3-radio" type="radio" name="stdindicate" value="Learning" onclick="w3_hideotherdisability()" 
					<?php 
						if (!empty($rowindln) && $rowindln['disyes']== "Learning") {
							echo "Checked";
						}
					?>/>
					<label>Learning</label></p>
					<p><input class="w3-radio" type="radio" name="stdindicate" value="Intellectual" onclick="w3_hideotherdisability()" 
					<?php 
						if (!empty($rowindln) && $rowindln['disyes']== "Intellectual") {
							echo "Checked";
						}
					?>/>
					<label>Intellectual</label></p>
					<p><input class="w3-radio" type="radio" name="stdindicate" value="Hearing/Def" onclick="w3_hideotherdisability()" 
					<?php 
						if (!empty($rowindln) && $rowindln['disyes']== "Hearing/Def") {
							echo "Checked";
						}
					?>/>
					<label>Hearing/Def</label></p>
					<p><input class="w3-radio" type="radio" name="stdindicate" value="Mental illness" onclick="w3_hideotherdisability()" 
					<?php 
						if (!empty($rowindln) && $rowindln['disyes']== "Mental illness") {
							echo "Checked";
						}
					?>/>
					<label>Mental illness</label></p>
					<p><input class="w3-radio" type="radio" name="stdindicate" value="Medical condition" onclick="w3_hideotherdisability()"
					<?php 
						if (!empty($rowindln) && $rowindln['disyes']== "Medical condition") {
							echo "Checked";
						}
					?>/>
					<label>Medical condition</label></p>
					<p><input class="w3-radio" type="radio" name="stdindicate" value="Acquired brain impairment" onclick="w3_hideotherdisability()" 
					<?php 
						if (!empty($rowindln) && $rowindln['disyes']== "Acquired brain impairment") {
							echo "Checked";
						}
					?>/>
					<label>Acquired brain impairment</label></p>
					<p><input class="w3-radio" type="radio" name="stdindicate" value="Other" onclick="w3_showotherdisability()" 
					<?php 
						if (!empty($rowindln) && $rowindln['disyes']== "Other") {
							echo "Checked";
						}
					?>/>
					<label>Other</label></p>
					<p><input type="text" class="w3-input w3-border w3-animate-input"
						 name="stdotherdis" 
						id="stdotherdis" 
						<?php
						if (!empty($rowindln['disother'])) {
								echo "Value='".$rowindln['disother']."'
								style='width:200px;'";
						}
						else {
							echo "style='width:200px; display: none;'";	
						}
						?>	/></p>
				</div>
				<p style="margin-top:20px;">
				<label>Adjustment<label>
				<input type="text" class="w3-input w3-border w3-animate-input "
				style="width:200px;"name="stdadjustment" id="stdadjustment"
				<?php 
					if (!empty($rowindln['disadjust'])) {
						echo "Value='".$rowindln['disadjust']."'";
					}
				?> /></p>
				
				<?php
					//Saving update
					if (isset($_GET['nv']) && isset($_GET['cnt']) &&
						$_GET['nv'] == "indlnneeds") {
						echo "<button type='submit' name='submitupdate' 
							class='w3-blueh w3-hover-green w3-padding-large
							w3-border w3-large'
							>Save</button>";
					}
				?>
			</div>
			
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:99%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<span id="edu"><h3>Education</h3></span>
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
						//For Saving Residence
						$_SESSION['eduid'] = $rowedu['eduid'];
					}
					
					//Comment
					if (isset($_GET['nv']) && isset($_GET['cnt']) &&
						$_GET['nv'] == "edu") {
						$cnt = base64_decode(urldecode($_GET['cnt']));
						echo "<h3><b>Comment:</b>".$cnt."</h3>";
					}
					
				}
			?>
			
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Highest Completed School Level<label>
				<p><input class="w3-radio" type="radio" name="stdhgcomschlvl" value="Year 12 or Equivalent" 
				<?php 
					if (!empty($rowedu) && $rowedu['highschool']== "Year 12 or Equivalent") {
						echo "Checked";
					}
				?>/>
				<label>Year 12 or Equivalent</label></p>
				<p><input class="w3-radio" type="radio" name="stdhgcomschlvl" value="Year 11 or Equivalent"  
				<?php 
					if (!empty($rowedu) && $rowedu['highschool']== "Year 11 or Equivalent") {
						echo "Checked";
					}
				?>/>
				<label>Year 11 or Equivalent</label></p>
				<p><input class="w3-radio" type="radio" name="stdhgcomschlvl" value="Year 10 or Equivalent"  
				<?php 
					if (!empty($rowedu) && $rowedu['highschool']== "Year 10 or Equivalent") {
						echo "Checked";
					}
				?>/>
				<label>Year 10 or Equivalent</label></p>
				<p><input class="w3-radio" type="radio" name="stdhgcomschlvl" value="Year 9 or Equivalent"  
				<?php 
					if (!empty($rowedu) && $rowedu['highschool']== "Year 9 or Equivalent") {
						echo "Checked";
					}
				?>/>
				<label>Year 9 or Equivalent</label></p>
				<p><input class="w3-radio" type="radio" name="stdhgcomschlvl" value="Year 8 or Below"  
				<?php 
					if (!empty($rowedu) && $rowedu['highschool']== "Year 8 or Below") {
						echo "Checked";
					}
				?>/>
				<label>Year 8 or Below</label></p>
				<p><input class="w3-radio" type="radio" name="stdhgcomschlvl" value="Never Attended School"  
				<?php 
					if (!empty($rowedu) && $rowedu['highschool']== "Never Attended School") {
						echo "Checked";
					}
				?>/>
				<label>Never Attended School</label></p>
			</div>
			<p style="margin-top:20px;"><label>In which Year did you complete that level</label>
			<input type="number"class="w3-input w3-border w3-animate-input" 
			style="width:200px"	name="stdyearcomp" 
			<?php 
				if (!empty($rowedu['year'])) {
						echo "Value='".$rowedu['year']."'";
				}
			?>/> </p>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Are you still attending secondary level?</label>
				<p><input class="w3-radio" type="radio" name="stdseclvl" value="Yes" 
				<?php 
					if (!empty($rowedu) && $rowedu['snd'] == 1) {
						echo "Checked";
					}
				?> />
				<label>Yes</label></p>
				<p><input class="w3-radio" type="radio" name="stdseclvl" value="No"  
				<?php 
					if (!empty($rowedu) && $rowedu['snd'] == 0) {
						echo "Checked";
					}
				?> />
				<label>No</label></p>
			</div>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Have you successfully completed any of the following qualification?<label>
				<p><input class="w3-radio" type="radio" name="stdsuccessqual" value="Yes" onclick="w3_showqualcomp()"
				<?php 
					if (!empty($rowedu) && $rowedu['success'] == 1) {
						echo "Checked";
					}
				?>/>
				<label>Yes</label></p>
				<p><input class="w3-radio" type="radio" name="stdsuccessqual" value="No"  onclick="w3_hidequalcomp()" 
				<?php 
					if (!empty($rowedu) && $rowedu['success'] == 0) {
						echo "Checked";
					}
				?>/>
				<label>No</label></p>
			</div>
			
			<div id="qualsuccomp" class="w3-container w3-white w3-card-4 w3-padding-large"
				<?php 
					if (!empty($rowedu) && $rowedu['success'] == 1) {
						echo "style='margin-top:20px;'";
					}
					else {
						echo "style='display:none; margin-top:20px;'";
					}
				?> >
				<p><input class="w3-radio" type="radio" id="scsscomp1"  name="scsscomp" value="Bachelor Degree or Higher Degree Level" 
				<?php 
					if (!empty($rowedu) && $rowedu['successyes']== "Bachelor Degree or Higher Degree Level") {
						echo "Checked";
					}
				?>/>
				<label>Bachelor Degree or Higher Degree Level</label></p>
				<p><input class="w3-radio" type="radio" id="scsscomp2"  name="scsscomp" value="Advanced Diploma or Assiociate Degree Level"  
				<?php 
					if (!empty($rowedu) && $rowedu['successyes']== "Advanced Diploma or Assiociate Degree Level") {
						echo "Checked";
					}
				?>/>
				<label>Advanced Diploma or Assiociate Degree Level</label></p>
				<p><input class="w3-radio" type="radio" id="scsscomp3"  name="scsscomp" value="Diploma (or associate diploma)"  
				<?php 
					if (!empty($rowedu) && $rowedu['successyes']== "Diploma (or associate diploma)") {
						echo "Checked";
					}
				?>/>
				<label>Diploma (or associate diploma)</label></p>
				<p><input class="w3-radio" type="radio" id="scsscomp4"  name="scsscomp" value="Certificate IV"  
				<?php 
					if (!empty($rowedu) && $rowedu['successyes']== "Certificate IV") {
						echo "Checked";
					}
				?>/>
				<label>Certificate IV</label></p>
				<p><input class="w3-radio" type="radio" id="scsscomp5"  name="scsscomp" value="Certificate III"  
				<?php 
					if (!empty($rowedu) && $rowedu['successyes']== "Certificate III") {
						echo "Checked";
					}
				?>/>
				<label>Certificate III</label></p>
				<p><input class="w3-radio" type="radio" id="scsscomp6"  name="scsscomp" value="Certificate II"  
				<?php 
					if (!empty($rowedu) && $rowedu['successyes']== "Certificate II") {
						echo "Checked";
					}
				?>/>
				<label>Certificate II</label></p>
				<p><input class="w3-radio" type="radio" id="scsscomp7"  name="scsscomp" value="Certificate I"  
				<?php 
					if (!empty($rowedu) && $rowedu['successyes']== "Certificate I") {
						echo "Checked";
					}
				?>/>
				<label>Certificate I</label></p>
				<p><input class="w3-radio" type="radio" id="scsscomp8"  name="scsscomp" value="Certificates other than the above"  
				<?php 
					if (!empty($rowedu) && $rowedu['successyes']== "Certificates other than the above") {
						echo "Checked";
					}
				?>/>
				<label>Certificates other than the above</label></p>
			</div>
			
			<?php
				//Saving update
				if (isset($_GET['nv']) && isset($_GET['cnt']) &&
					$_GET['nv'] == "edu") {
					echo "<button type='submit' name='submitupdate' 
						class='w3-blueh w3-hover-green w3-padding-large
						w3-border w3-large'
						>Save</button>";
				}
			?>
			
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:99%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<span id="refstudy"><h3>Reason for study</h3></span>
			</header>
			
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
					
					//Comment
					if (isset($_GET['nv']) && isset($_GET['cnt']) &&
						$_GET['nv'] == "refstudy") {
						$cnt = base64_decode(urldecode($_GET['cnt']));
						echo "<h3><b>Comment:</b>".$cnt."</h3>";
					}
				}
			?>
			
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<p><label>Which best describes your reasons for enrolling in the qualification?<label></p>
				<p><input class="w3-check" type="checkbox"  name="reasonqual[]" value="To get a Job"
				<?php 
					if (!empty($rowrealist) && in_array("To get a Job",$rowrealist)) {
						echo "checked";
					}
				?>/>
				<label>To get a Job</label></p>
				<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="To develop my existing business"
				<?php 
					if (!empty($rowrealist) && in_array("To develop my existing business",$rowrealist)) {
						echo "checked";
					}
				?>/>
				<label>To develop my existing business</label></p>
				<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="To start my own business"
				<?php 
					if (!empty($rowrealist) && in_array("To start my own business",$rowrealist)) {
						echo "checked";
					}
				?>/>
				<label>To start my own business</label></p>
				<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="To try a different career"
				<?php 
					if (!empty($rowrealist) && in_array("To try a different career",$rowrealist)) {
						echo "checked";
					}
				?>/>
				<label>To try a different career</label></p>
				<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="To get a better job or promotion"
				<?php 
					if (!empty($rowrealist) && in_array("To get a better job or promotion",$rowrealist)) {
						echo "checked";
					}
				?>/>
				<label>To get a better job or promotion</label></p>
				<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="It is requirement of my job"
				<?php 
					if (!empty($rowrealist) && in_array("It is requirement of my job",$rowrealist)) {
						echo "checked";
					}
				?>/>
				<label>It is requirement of my job</label></p>
				<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="I want extra skills for my job"
				<?php 
					if (!empty($rowrealist) && in_array("I want extra skills for my job",$rowrealist)) {
						echo "checked";
					}
				?>/>
				<label>I want extra skills for my job</label></p>
				<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="To get into another course of study"
				<?php 
					if (!empty($rowrealist) && in_array("To get into another course of study",$rowrealist)) {
						echo "checked";
					}
				?>/>
				<label>To get into another course of study</label></p>
				<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="For personal interest or self-development"
				<?php 
					if (!empty($rowrealist) && in_array("For personal interest or self-development",$rowrealist)) {
						echo "checked";
					}
				?>/>
				<label>For personal interest or self-development</label></p>
				<p><input class="w3-check" type="checkbox" name="reasonqual[]" id="otherreason" value="Other reason"
				onclick="w3_showotherreason()"
				<?php 
					if (!empty($rowrealist) && in_array("Other reason",$rowrealist)) {
						echo "checked";
					}
				?>/>
				<label>Other reason</label></p>
				<p><input type="text"
				class="w3-input w3-border w3-animate-input w3-light-grey" 		
				name="otherreasonstate"
				id="otherreasonstate" 
				<?php 
					if (!empty($rowrealist) && in_array("Other reason",$rowrealist)) {
						echo "style='width:200px;' value='".$rowreastud['other']."'";
					}
					else {
						echo "style='width:200px; Display:none;'";
					}
				?>></input></p>
			
			</div>
			
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>How did you hear about this course?</label>
				<p><input class="w3-radio" type="radio" name="hearaboutcou" value="Advertisement - where" 
				onclick="w3_showadvertisemen()" 
				<?php 
					if (!empty($rowreastud) && $rowreastud['hearabout']== "Advertisement - where") {
						echo "Checked";
					}
				?>	/>
				<label>Advertisement - where</label></p>
				<input type="text"
				class="w3-input w3-border w3-animate-input w3-light-grey" 		
				name="advertisementwhe"
				id="advertisementwhe" 
				<?php 
					if (!empty($rowreastud) && $rowreastud['hearabout']== "Advertisement - where") {
						echo "style='width:200px;' value='".$rowreastud['hearaboutv']."'";
					}
					else {
						echo "style='width:200px; Display:none;'";
					}
				?>/>
				<p><input class="w3-radio" type="radio" name="hearaboutcou" value="Word of mouth - who" 
				onclick="w3_showwordof()" 
				<?php 
					if (!empty($rowreastud) && $rowreastud['hearabout']== "Word of mouth - who") {
						echo "Checked";
					}
				?>/>
				<label>Word of mouth - who</label></p>
				<input type="text"
				class="w3-input w3-border w3-animate-input w3-light-grey" 		
				name="wordofmout"
				id="wordofmout" 
				<?php 
					if (!empty($rowreastud) && $rowreastud['hearabout']== "Word of mouth - who") {
						echo "style='width:200px;' value='".$rowreastud['hearaboutv']."'";
					}
					else {
						echo "style='width:200px; Display:none;'";
					}
				?>/>
				<p><input class="w3-radio" type="radio" name="hearaboutcou" value="Website" onclick="w3_showwebsite()"  
				<?php 
					if(!empty($rowreastud) && $rowreastud['hearabout']== "Website") {
						echo "Checked";
					}
				?> />
				<label>Website</label></p>
				<p><input class="w3-radio" type="radio" name="hearaboutcou" value="Other"  
				onclick="w3_showotherhear()"
				<?php 
					if(!empty($rowreastud) && $rowreastud['hearabout']== "Other") {
						echo "Checked";
					}
				?>/>
				<label>Other</label></p>
				<input type="text"
				class="w3-input w3-border w3-animate-input w3-light-grey" 		
				name="otherhear" id="otherhear" 
				<?php 
					if (!empty($rowreastud) && $rowreastud['hearabout']== "Other") {
						echo "style='width:200px;' value='".$rowreastud['hearaboutv']."'";
					}
					else {
						echo "style='width:200px; Display:none;'";
					}
				?>/>
			</div>
			
			<?php
				//Saving update
				if (isset($_GET['nv']) && isset($_GET['cnt']) &&
					$_GET['nv'] == "refstudy") {
					echo "<button type='submit' name='submitupdate' 
						class='w3-blueh w3-hover-green w3-padding-large
						w3-border w3-large'
						>Save</button>";
				}
			?>
			
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:99%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<span id="currempst"><h3>Current Employment Status</h3></span>
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
					
					//Comment
					if (isset($_GET['nv']) && isset($_GET['cnt']) &&
						$_GET['nv'] == "currempst") {
						$cnt = base64_decode(urldecode($_GET['cnt']));
						echo "<h3><b>Comment:</b>".$cnt."</h3>";
					}
					
				}
			?>
			
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Employment Status</label>
				<p><input class="w3-radio" type="radio" name="stdcurempsts" value="Full Time" 
				<?php 
					if(!empty($rowrstatus) && $rowrstatus['empstatus']== "Full Time") {
						echo "Checked";
					}
				?>  />
				<label>Full Time</label></p>
				<p><input class="w3-radio" type="radio" name="stdcurempsts" value="Part Time" 
				<?php 
					if(!empty($rowrstatus) && $rowrstatus['empstatus']== "Part Time") {
						echo "Checked";
					}
				?> 	/>
				<label>Part Time</label></p>
				<p><input class="w3-radio" type="radio" name="stdcurempsts" value="Self-employed - not employing others" 
				<?php 
					if(!empty($rowrstatus) && $rowrstatus['empstatus']== "Self-employed - not employing others") {
						echo "Checked";
					}
				?> />
				<label>Self-employed - not employing others</label></p>
				<p><input class="w3-radio" type="radio" name="stdcurempsts" value="Employer" 
				<?php 
					if(!empty($rowrstatus) && $rowrstatus['empstatus']== "Employer") {
						echo "Checked";
					}
				?> />
				<label>Employer</label></p>
				<p><input class="w3-radio" type="radio" name="stdcurempsts" value="Employer - unpaid worker in family business"  
				<?php 
					if(!empty($rowrstatus) && $rowrstatus['empstatus']== "Employer - unpaid worker in family business") {
						echo "Checked";
					}
				?> />
				<label>Employer - unpaid worker in family business</label></p>
				<p><input class="w3-radio" type="radio" name="stdcurempsts" value="Unemployed seeking full time work"  
				<?php 
					if(!empty($rowrstatus) && $rowrstatus['empstatus']== "Unemployed seeking full time work") {
						echo "Checked";
					}
				?> />
				<label>Unemployed seeking full time work</label></p>
				<p><input class="w3-radio" type="radio" name="stdcurempsts" value="Unemployed seeking part time work"  
				<?php 
					if(!empty($rowrstatus) && $rowrstatus['empstatus']== "Unemployed seeking part time work") {
						echo "Checked";
					}
				?> />
				<label>Unemployed seeking part time work</label></p>
				<p><input class="w3-radio" type="radio" name="stdcurempsts" value="Not employed, not seeking employment"  
				<?php 
					if(!empty($rowrstatus) && $rowrstatus['empstatus']== "Not employed, not seeking employment") {
						echo "Checked";
					}
				?> />
				<label>Not employed. not seeking employment</label></p>
			</div>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Registered for unemployment benefits with centrelink</label>
				<p><input class="w3-radio" type="radio" name="stdbencen" value="Yes"
				<?php 
					if(!empty($rowrstatus) && $rowrstatus['regs']== 1) {
						echo "Checked";
					}
				?>				/>
				<label>Yes</label></p>
				<p><input class="w3-radio" type="radio" name="stdbencen" value="No"  
				<?php 
					if(!empty($rowrstatus) && $rowrstatus['regs']== 0) {
						echo "Checked";
					}
				?>/>
				<label>No</label></p>
			</div>
			
			<?php
				//Saving update
				if (isset($_GET['nv']) && isset($_GET['cnt']) &&
					$_GET['nv'] == "currempst") {
					echo "<button type='submit' name='submitupdate' 
						class='w3-blueh w3-hover-green w3-padding-large
						w3-border w3-large'
						>Save</button>";
				}
			?>
			
		</div>
		
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:99%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<span id="empdt"><h3>Employer Details</h3></span>
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
					
					//Comment
					if (isset($_GET['nv']) && isset($_GET['cnt']) &&
						$_GET['nv'] == "empdt") {
						$cnt = base64_decode(urldecode($_GET['cnt']));
						echo "<h3><b>Comment:</b>".$cnt."</h3>";
					}
					
				}
			?>
			
			<p style="margin-top:20px;">
			<label>Company Name</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empcomname" 
			<?php 
				if(!empty($rowempdt)) {
					echo "Value='".$rowempdt['empcomname']."'";
				}
			?> /></p>
			<p style="margin-top:20px;">
			<label>Contact Name</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empcntname" 
			<?php 
				if(!empty($rowempdt)) {
					echo "Value='".$rowempdt['empcntname']."'";
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>Address</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empaddr" 
			<?php 
				if(!empty($rowempdt)) {
					echo "Value='".$rowempdt['empaddress']."'";
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>Suburb</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empsuburb" 
			<?php 
				if(!empty($rowempdt)) {
					echo "Value='".$rowempdt['empsub']."'";
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>Phone</label><input type="number" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empphone" 
			<?php 
				if(!empty($rowempdt)) {
					echo "Value='".$rowempdt['emphone']."'";
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>Email</label><input type="email" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empemail" 
			<?php 
				if(!empty($rowempdt)) {
					echo "Value='".$rowempdt['empemail']."'";
				}
			?>/></p>
			
			<?php
				//Saving update
				if (isset($_GET['nv']) && isset($_GET['cnt']) &&
					$_GET['nv'] == "empdt") {
					echo "<button type='submit' name='submitupdate' 
						class='w3-blueh w3-hover-green w3-padding-large
						w3-border w3-large'
						>Save</button>";
				}
			?>
			
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:99%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<span id="appntr"><h3>Apprenticeships and Traineeships</h3></span>
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
					
					//Comment
					if (isset($_GET['nv']) && isset($_GET['cnt']) &&
						$_GET['nv'] == "appntr") {
						$cnt = base64_decode(urldecode($_GET['cnt']));
						echo "<h3><b>Comment:</b>".$cnt."</h3>";
					}
				}
			?>
			
			
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Part of apprenticeships and traineeships</label>
				<p><input class="w3-radio" type="radio" name="apprentrain" value="Yes"  
				<?php 
					if(!empty($rowappren) && $rowappren['appres']== 1) {
						echo "Checked";
					}
				?>/>
				<label>Yes</label></p>
				<p><input class="w3-radio" type="radio" name="apprentrain" value="No"  
				<?php 
					if(!empty($rowappren) && $rowappren['appres']== 0) {
						echo "Checked";
					}
				?>/>
				<label>No</label></p>
			</div>
			<p style="margin-top:20px;">
			<label>Start Date</label><input type="date" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"	name="strdateemp" 
			<?php 
				if(!empty($rowappren)) {
					echo "Value=".$rowappren['appresdate'];
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>Job Title</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"	name="empjobtitle" 
			<?php 
				if(!empty($rowappren)) {
					echo "Value='".$rowappren['appretitle']."'";
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>Hours per week</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"	name="emphrperweek" 
			<?php 
				if(!empty($rowappren)) {
					echo "Value='".$rowappren['hrsperweek']."'";
				}
			?>/></p>
			
			<?php
				//Saving update
				if (isset($_GET['nv']) && isset($_GET['cnt']) &&
					$_GET['nv'] == "appntr") {
					echo "<button type='submit' name='submitupdate' 
						class='w3-blueh w3-hover-green w3-padding-large
						w3-border w3-large'
						>Save</button>";
				}
			?>
			
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:99%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<span id="recogpr"><h3>Recognition of Prior Learning/Credit</h3></span>
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
					
					//Comment
					if (isset($_GET['nv']) && isset($_GET['cnt']) &&
						$_GET['nv'] == "recogpr") {
						$cnt = base64_decode(urldecode($_GET['cnt']));
						echo "<h3><b>Comment:</b>".$cnt."</h3>";
					}
				}
			?>
			
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>RPL or credit transfer</label>
				<p><input class="w3-radio" type="radio" name="recgprlrcr" value="Yes"  
				<?php 
					if(!empty($rowrecogpr) && $rowrecogpr['recog']== 1) {
						echo "Checked";
					}
				?>/>
				<label>Yes</label></p>
				<p><input class="w3-radio" type="radio" name="recgprlrcr" value="No"  
				<?php 
					if(!empty($rowrecogpr) && $rowrecogpr['recog']== 0) {
						echo "Checked";
					}
				?>/>
				<label>No</label></p>
			</div>
			
			<?php
				//Saving update
				if (isset($_GET['nv']) && isset($_GET['cnt']) &&
					$_GET['nv'] == "recogpr") {
					echo "<button type='submit' name='submitupdate' 
						class='w3-blueh w3-hover-green w3-padding-large
						w3-border w3-large'
						>Save</button>";
				}
			?>
			
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:99%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<span id="jobseek"><h3>Jobseekers Seeking Concession</h3></span>
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
					
					//Comment
					if (isset($_GET['nv']) && isset($_GET['cnt']) &&
						$_GET['nv'] == "jobseek") {
						$cnt = base64_decode(urldecode($_GET['cnt']));
						echo "<h3><b>Comment:</b>".$cnt."</h3>";
					}
					
				}
			?>
			
			<p style="margin-top:20px;">
			<label>Job Search Agency</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"	name="jobsrchagen" 
			<?php 
				if(!empty($rowjobseekers)) {
					echo "Value='".$rowjobseekers['jbseekagen']."'";
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>Employment Co-ordinator's Name</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"	name="emocorname" 
			<?php 
				if(!empty($rowjobseekers)) {
					echo "Value='".$rowjobseekers['empcoorname']."'";
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>Suburb</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"	name="jobskrsuburb" 
			<?php 
				if(!empty($rowjobseekers)) {
					echo "Value='".$rowjobseekers['jobseeksur']."'";
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>Landline</label><input type="number" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"	name="jobskrlandline" 
			<?php 
				if(!empty($rowjobseekers)) {
					echo "Value='".$rowjobseekers['landline']."'";
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>Mobile</label><input type="number" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"	name="jobskrmobile" 
			<?php 
				if(!empty($rowjobseekers)) {
					echo "Value='".$rowjobseekers['jobseeknobile']."'";
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>Start Date</label><input type="date" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"	name="jobskremail" 
			<?php 
				if(!empty($rowjobseekers)) {
					echo "Value=".$rowjobseekers['jobseekstrdte'];
				}
			?>/></p>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>JSA Client Group</label>
				<p><input class="w3-radio" type="radio" name="jbaclient" value="Youth at risk"  
				<?php 
					if(!empty($rowjobseekers) && $rowjobseekers['jsaclient']== "Youth at risk") {
						echo "Checked";
					}
				?>/>
				<label>Youth at risk</label></p>
				<p><input class="w3-radio" type="radio" name="jbaclient" value="CALD"  
				<?php 
					if(!empty($rowjobseekers) && $rowjobseekers['jsaclient']== "CALD") {
						echo "Checked";
					}
				?>/>
				<label>CALD</label></p>
				<p><input class="w3-radio" type="radio" name="jbaclient" value="Carer/Parent"  
				<?php 
					if(!empty($rowjobseekers) && $rowjobseekers['jsaclient']== "Carer/Parent") {
						echo "Checked";
					}
				?>/>
				<label>Carer/Parent</label></p>
			</div>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Job Search Agency Fees</label>
				<p><input class="w3-radio" type="radio" name="jbsrcagencypart" value="Yes"onclick="w3_showcoursefee()"
				<?php 
					if(!empty($rowjobseekers) && $rowjobseekers['jobsearchfee']== 1) {
						echo "Checked";
					}
				?>/>
				<label>Yes</label></p>
				<p><input class="w3-radio" type="radio" name="jbsrcagencypart" value="No" onclick="w3_hidecoursefee()" 
				<?php 
					if(!empty($rowjobseekers) && $rowjobseekers['jobsearchfee']== 0) {
						echo "Checked";
					}
				?>/>
				<label>No</label></p>
			</div>
			
			<?php
				//Saving update
				if (isset($_GET['nv']) && isset($_GET['cnt']) &&
					$_GET['nv'] == "jobseek") {
					echo "<button type='submit' name='submitupdate' 
						class='w3-blueh w3-hover-green w3-padding-large
						w3-border w3-large'
						>Save</button>";
				}
			?>
			
		</div>
		
		<div id="coursefee" class="w3-container w3-greyb w3-card-4 w3-padding-large"
			<?php 
				if(!empty($rowjobseekers) && $rowjobseekers['jobsearchfee']== 1) {
					echo "style='width:99%; margin-top:20px;'";
				}
				else {
					echo "style='width:99%; margin-top:20px; display:none;'";
				}
			?>>
			<header class="w3-container w3-blueh w3-tea">
				<h3>Course Fee</h3>
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
			
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Payment Type</label>
				<p><input class="w3-radio" type="radio" name="paymenttype" value="Student - Full Payment"
				<?php 
					if(!empty($rowcoursefee) && $rowcoursefee['paytype']=="Student - Full Payment") {
						echo "Checked";
					}
				?>/>
				<label>Student - Full Payment</label></p>
				<p><input class="w3-radio" type="radio" name="paymenttype" value="Third Party - Full Payment"  
				<?php 
					if(!empty($rowcoursefee) && $rowcoursefee['paytype']=="Third Party - Full Payment") {
						echo "Checked";
					}
				?>/>
				<label>Third Party - Full Payment</label></p>
			</div>
			<p style="margin-top:20px;">
			<label>Student Name</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"	name="stdnamefee" 
			<?php 
				if(!empty($rowcoursefee)) {
					echo "Value='".$rowcoursefee['stdname']."'";
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>Third Party Representative Name</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"	name="thrdpartrep" 
			<?php 
				if(!empty($rowcoursefee)) {
					echo "Value='".$rowcoursefee['thrdrepname']."'";
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>Third, the invoice is to be made out to</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"	name="thrdparinv" 
			<?php 
				if(!empty($rowcoursefee)) {
					echo "Value='".$rowcoursefee['thrdinvoice']."'";
				}
			?>/></p>
		</div>
		
		<div id="creditcard" class="w3-container w3-greyb w3-card-4 w3-padding-large"
			<?php 
				if(!empty($rowjobseekers) && $rowjobseekers['jobsearchfee']== 1) {
					echo "style='width:99%; margin-top:20px;'";
				}
				else {
					echo "style='width:99%; margin-top:20px; display:none;'";
				}
			?>>
			<header class="w3-container w3-blueh w3-tea">
				<h3>Credit Card</h3>
			</header>
			<p style="margin-top:20px;">
			<label>Card Type</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"	name="crdtype" 
			<?php 
				if(!empty($rowcoursefee)) {
					echo "Value='".$rowcoursefee['crdtype']."'";
				}
			?>/></p>
			<p style="margin-top:20px;">
			<label>Card Number</label><input type="number" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"	name="crdnum" 
			<?php 
				if(!empty($rowcoursefee)) {
					echo "Value='".$rowcoursefee['crdnum']."'";
				}
			?>/></p>
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:99%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<span id="centdt"><h3>Centrelink Details</h3></span>
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
					
					//Comment
					if (isset($_GET['nv']) && isset($_GET['cnt']) &&
						$_GET['nv'] == "centdt") {
						$cnt = base64_decode(urldecode($_GET['cnt']));
						echo "<h3><b>Comment:</b>".$cnt."</h3>";
					}
					
				}
			?>
			
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
			style="margin-top:20px;">
				<label>Registred Centrelink Allowances</label>
				<p><input class="w3-radio" type="radio" name="regcenallow" value="Yes" onclick="w3_showreg()"
				<?php 
					if(!empty($rowcentrelink) && $rowcentrelink['cntrallow']== 1) {
						echo "Checked";
					}
				?>	/>
				<label>Yes</label></p>
				<p><input class="w3-radio" type="radio" name="regcenallow" value="No" onclick="w3_hidereg()"
				<?php 
					if(!empty($rowcentrelink) && $rowcentrelink['cntrallow']== 0) {
						echo "Checked";
					}
				?>/>
				<label>No</label></p>
			</div>
			<div id="regiscentre" 
				<?php 
					if(!empty($rowcentrelink) && $rowcentrelink['cntrallow']== 1) {
						echo "style='margin-top:20px;'";
					}
					else {
						echo "style='margin-top:20px; display:none;'";
					}
				?> >
				<div class="w3-container w3-white w3-card-4 w3-padding-large">
					<label>Allowances</label>
					<p><input class="w3-radio" type="radio" name="allowyes" value="Newstart Allowance"   
					<?php 
						if(!empty($rowcentrelink) && $rowcentrelink['allowances']== "Newstart Allowance") {
							echo "Checked";
						}
					?>/>
					<label>Newstart Allowance</label></p>
					<p><input class="w3-radio" type="radio" name="allowyes" value="Youth Allowance"  
					<?php 
						if(!empty($rowcentrelink) && $rowcentrelink['allowances']== "Youth Allowance") {
							echo "Checked";
						}
					?>/>
					<label>Youth Allowance</label></p>
					<p><input class="w3-radio" type="radio" name="allowyes" value="Age Pension"  
					<?php 
						if(!empty($rowcentrelink) && $rowcentrelink['allowances']== "Age Pensioe") {
							echo "Checked";
						}
					?>/>
					<label>Age Pension</label></p>
					<p><input class="w3-radio" type="radio" name="allowyes" value="Disability Support Pension"   
					<?php 
						if(!empty($rowcentrelink) && $rowcentrelink['allowances']== "Disability Support Pension") {
							echo "Checked";
						}
					?>/>
					<label>Disability Support Pension</label></p>
					<p><input class="w3-radio" type="radio" name="allowyes" value="Parenting Payment(single)"  
					<?php 
						if(!empty($rowcentrelink) && $rowcentrelink['allowances']== "Parenting Payment(single") {
							echo "Checked";
						}
					?>/>
					<label>Parenting Payment(single)</label></p>
					<p><input class="w3-radio" type="radio" name="allowyes" value="Parent Payment (partnered)"  
					<?php 
						if(!empty($rowcentrelink) && $rowcentrelink['allowances']== "Parent Payment (partnered)") {
							echo "Checked";
						}
					?>/>
					<label>Parent Payment (partnered)</label></p>
				</div>
				<p style="margin-top:20px;">
				<label>Reference Number</label><input type="number" 
				class="w3-input w3-border w3-animate-input "
				style="width:200px"	name="refnum" 
				<?php 
					if(!empty($rowcentrelink)) {
						echo "Value='".$rowcentrelink['refnum']."'";
					}
				?>/></p>
				<p style="margin-top:20px;">
				<label>VET Number</label><input type="number" 
				class="w3-input w3-border w3-animate-input "
				style="width:200px"	name="vetnum" 
				<?php 
					if(!empty($rowcentrelink)) {
						echo "Value='".$rowcentrelink['vetnum']."'";
					}
				?>/></p>
			</div>
		</div>
		
		<div class="w3-container w3-white w3-padding-large"
			style="width:99%; margin-top:20px; font-family: Arial, Helvetica, sans-serif;">
			<button type="submit" name="submitupdate" 
			class="w3-blueh w3-hover-green w3-padding-large
			w3-border w3-large"
			style="float:right;">Save</button>
		</div>
		
		<?php
			//Notification
			if (isset($_GET['n']) && isset($_GET['nid'])) {
				echo "<input type='hidden' value='".$_GET['n']."' name='n' />";
				echo "<input type='hidden' value='".$_GET['nid']."' name='nid' />";
			}
		?>
		
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