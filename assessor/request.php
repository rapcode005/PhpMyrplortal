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

<div class="w3-main" style="margin-left:220px; margin-top:16px; margin-top:16px;">
	<form action="data/send.php" method="POST">
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large w3-small"
			style="width:98%; font-family: Arial, Helvetica, sans-serif;">
			<header class="w3-container w3-blueh w3-tea">
				<h3>New Request</h3>
			</header>
			<?php
				if (isset($_GET['success'])) {
					echo "<h3>The request has been successfully processed.</h3>";
				}
			?>
			<p style="margin-top:20px;"  onchange="leaveChange()">
				<select class="w3-select w3-select-input"
				style="width:500px;" id="moduletype" name="moduletype">
					<option value="" disabled selected>Choose your module</option>
					<option value="0">Application Form</option>
					<option value="1">Evidence</option>
					<option value="2">Reference</option>
				</select>
			</p>
			<div id="apptypep" style="margin-top:20px; display:none;">
				<p>
					<select class="w3-select w3-select-input"
					style="width:500px;" name="apptype">
						<option value="" disabled selected>Choose your tab</option>
						<option value="0">Personal Details</option>
						<option value="1">Residence</option>
						<option value="2">Postal Address</option>
						<option value="3">Phone and Contact details</option>
						<option value="4">Emegency Contact</option>
						<option value="5">Language and Cultural Diversity</option>
						<option value="6">Individual Learning Needs</option>
						<option value="7">Education</option>
						<option value="8">Reason for study</option>
						<option value="9">Current Employment Status</option>
						<option value="10">Employer Details</option>
						<option value="11">Apprenticeships and Traineeships</option>
						<option value="12">Recognition of Prior Learning/Credit</option>
						<option value="13">Jobseekers Seeking Concession</option>
						<option value="14">Centrelink Details</option>
					</select>
				</p>
			</div>
			<p style="margin-top:20px;">
			<label>Subject</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:500px"		
			name="subject" /></p>
			<p style="margin-top:20px;">
			<label>Comment</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:500px"		
			name="comment" /></p>
			<input type="hidden" name="fnm" 
			<?php 
				if(isset($_GET['fnm'])) {
					echo "Value='".$_GET['fnm']."'";	
				}
			?>
			/>
			<input type="hidden" name="gnm" 
			<?php 
				if(isset($_GET['gnm'])) {
					echo "Value='".$_GET['gnm']."'";	
				}
			?>
			/>
			<input type="hidden" name="ptid" 
			<?php 
				if(isset($_GET['ptid'])) {
					echo "Value='".$_GET['ptid']."'";	
				}
			?>
			/>
			<input type="hidden" name="h" 
			<?php 
				if(isset($_GET['h'])) {
					echo "Value='".$_GET['h']."'";	
				}
			?>
			/>
			<button type="submit" name="send" 
			class="w3-blueh w3-hover-green w3-padding-large
			w3-border w3-large"
			style="float:right;">Send</button>
		</div>
	</form>
	
	<div class="w3-container w3-white w3-card-4 w3-padding-large"
			style="width:98%; margin-top:20px; font-family: Arial, Helvetica, sans-serif">
			
		<table class="w3-table-all">
			<thead>
				<tr class="w3-blueh">
					<th>Module</th>
					<th>Comment</th>
					<th>Date</th>
					<th>Status</th>
					<th>Created By</th>
					<th>Updated By</th>
				</tr>
			</thead>
			<tbody class="w3-small">
			<?php
				
				include_once '../data/dbh.php';
				
				if(isset($_GET['ptid'])) {
					
					$ptid = base64_decode(urldecode($_GET['ptid']));
					
					$sql = "SELECT a.comment,a.date,a.type,a.status,
					 CONCAT(b.userfname,' ',b.userlname) as cname,
					CONCAT(c.userfname,' ',c.userlname) as uname FROM notification a 
					INNER JOIN user_profile b on a.createduserid=b.userid
					LEFT JOIN user_profile c on a.updateduserid=c.userid WHERE stuid =".$ptid;
					
					$result = mysqli_query($conn, $sql);
										
					while ($row = mysqli_fetch_assoc($result)) {
						
						//Format Date
						$date=date_create($row['date']);
						
						//Status
						if ($row['status'] == 0)
							$status = "Ongoing";
						else
							$status = "Done";
						
						//Module Type
						if ($row['type'] == 0)
							$type = "Application Form";
						elseif  ($row['type'] == 1)
							$type = "Evidence";
						elseif ($row['type'] == 2)
							$type = "Reference";
						else
							$type = "";
						
						echo "<tr>";
						
						echo "<td>".$type."</td><td>".$row['comment']."</td><td>".date_format($date,"F d, Y")."</td><td>"
						.$status."</td><td>".$row['cname']."</td><td>"
						.$row['uname']."</td><td>";
						
						echo "</tr>";
					
					}
					
				}
				
			?>
			</tbody>
		</table>
			
	</div>
	<script>
		function leaveChange() {
			var v = document.getElementById("moduletype").value;
			if (v == "0") 
				document.getElementById("apptypep").style.display = "block";
			else
				document.getElementById("apptypep").style.display = "none";
		}
	</script>
</div>