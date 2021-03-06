<?php 
	include_once 'headerwithsearchhome.php';
	include_once '../data/dbh.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
	include_once 'menuwithquerystr.php';
?>

<br><br>

<div class="w3-main w3-container w3-small" 
style="margin-top:20px; margin-left:200px; 
font-family: Arial, Helvetica, sans-serif;">
	
	<div style="width:25%;margin-bottom:5px;">
		<button class="w3-button w3-blueh w3-hover-green w3-xlarge w3-hide-large" 
		onclick="w3_open()">&#9776;</button>
	</div>
	
	<div class="w3-card-4 w3-greyb">
		
		<header class="w3-container w3-blueh">
			<h4>New Request</h4>
		</header>
		
		<div class="w3-container">
		
			<p>
				<?php
					include_once '../link/message/prosucca.php';
				?>
			</p>
			
			<p>
				<form action="data/send.php" method="POST" onsubmit="return checkform();">
					<p onchange="leaveChange()">
						<select class="w3-select w3-select-input
						w3-animate-input"
						style="width:200px;" id="moduletype" name="moduletype">
							<option value="" disabled selected>Choose your module</option>
							<option value="0">Application Form</option>
							<option value="1">Evidence</option>
							<option value="2">Reference</option>
						</select>
						<label id="lmoduletype" 
						style="color: red; display:none;">Module is required.</label>
					</p>
					<div id="apptypep" style="display:none;">
						<p>
							<select class="w3-select w3-select-input w3-animate-input"
							style="width:200px;" id="apptype" name="apptype">
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
							<label id="lapptype" style="color: red; display:none;">
							Tab is required.</label>
						</p>
					</div>
					<p>
					<label>Subject</label><input type="text" 
					class="w3-input w3-border 
					w3-animate-input"
					style="width:200px"		
					name="subject" id="subject" />
					<label id="lsubject" style="color: red; display:none;">
					Subject is required.</label>
					</p>
					<p>
					<label>Comment</label><input type="text" 
					class="w3-input w3-border 
					w3-animate-input"
					style="width:200px"		
					name="comment" id="comment" />
					<label id="lcomment" style="color: red; display:none;">
					Comment is required.</label>
					</p>
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
					/><p>
					<button type="submit" name="send" 
					class="w3-blueh w3-hover-green w3-padding
					w3-border w3-right">Send</button>
					</p>
				</form>
			</p>
			<div class="w3-container w3-margin-bottom">
			</div>
		</div>
				
	</div>
	
	<div class="w3-card-4 w3-white" style="margin-top:20px;">	
		<table class="w3-table-all w3-small">
			<thead>
				<tr class="w3-blueh">
					<th>Module</th>
					<th>Subject</th>
					<th>Status</th>
					<th>Created By</th>
					<th>Updated By</th>
				</tr>
			</thead>
			<tbody>
				<?php
					
					include_once '../data/dbh.php';
					
					if(isset($_GET['ptid'])) {
						
						$ptid = base64_decode(urldecode($_GET['ptid']));
						
						$sql = "SELECT a.subject,a.date,a.type,a.status,
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
							
							echo "<td>".$type."</td><td>".$row['subject']."</td><td>"
							.$status."</td><td>".$row['cname']."</td><td>"
							.$row['uname']."</td>";
							
											
							echo "</tr>";
						
						}
						
					}
					
				?>
			</tbody>
		</table>
	</div>
	
</div>

	<script>
		function leaveChange() {
			var v = document.getElementById("moduletype").value;
			if (v == "0") 
				document.getElementById("apptypep").style.display = "block";
			else
				document.getElementById("apptypep").style.display = "none";
		}
		
		function checkform() {
			var r = 0;
			
			//Comment
			if (document.getElementById("comment").value == "") {
				document.getElementById("lcomment").style.display = "block";
				document.getElementById("comment").focus();
				r += 1;
			}
			else {
				document.getElementById("lcomment").style.display = "none";
			}
			
				
			//Subject
			if (document.getElementById("subject").value == "") {
				document.getElementById("lsubject").style.display = "block";
				document.getElementById("subject").focus();
				r += 1;
			}
			else {
				document.getElementById("lsubject").style.display = "none";
			}
			
			//Tab
			if (document.getElementById("moduletype").value == "0") {
				if (document.getElementById("apptype").value == "") {
					document.getElementById("lapptype").style.display = "block";
					document.getElementById("apptype").focus();
					r += 1;
				}
				else {
					document.getElementById("lapptype").style.display = "none";
				}
			}
			
			//Module
			if (document.getElementById("moduletype").value == "") {
				document.getElementById("lmoduletype").style.display = "block";
				document.getElementById("moduletype").focus();
				r += 1;
			}
			else {
				document.getElementById("lmoduletype").style.display = "none";
			}
			
			if(r > 0) {
				return false;
			}
			else {
				return true;
			}
				
		}
		function w3_open() {
			document.getElementById("mySidebar").style.display = "block";
		}
		function w3_close() {
			document.getElementById("mySidebar").style.display = "none";
		}
	</script>