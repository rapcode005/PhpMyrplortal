<?php
	include_once '../../data/dbh.php';
		/*
		if ($_POST['view'] != "") {
			$update = "UPDATE notification SET status = 1 WHERE status=0";
   			mysqli_query($con, $update);
		}
		*/	
	$query = "SELECT a.id,a.subject,a.type,a.typeapp,a.date,a.stuid,c.fname,c.gname 
			FROM notification a LEFT JOIN studentinfo b on a.stuid = b.id
			INNER JOIN personaldt c on b.stdcode = c.id WHERE a.status=0";
			
	$result = mysqli_query($conn, $query);
	$output = (string) NULL;
	$resultc = mysqli_num_rows($result);
	
	$type = array(0 => "Application Form", 1 => "Evidence", 2 => "Reference");
	
	$typeapp = array(0 => "Personal Details", 1 => "Residence", 2 => "Postal Address",
					3 => "Phone and Contact", 4 => "Emegency Contact", 5 => "Language and Cultural",
					6 => "Individual Learning", 7 => "Education", 8 => "Reason for study",
					9 => "Current Employment Status", 10 => "Employer Details", 11 => "Apprenticeships and Traineeships",
					12 => "Recognition of Prior Learning/Credit", 13 => "Jobseekers Seeking Concession",
					14 => "Centrelink Details");
	
	$navigate = array(0 => "perdt", 1 => "resd", 2 => "ptadd",3 => "phncntdt", 4 => "emgcnt", 
					5 => "lngnculdv", 6 => "indlnneeds", 7 => "edu", 8 => "refstudy",
					9 => "currempst", 10 => "empdt", 11 => "appntr", 12 => "recogpr", 13 => "jobseek",
					14 => "centdt");
	
	
	if($resultc > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			
			//Encrypt ID
			$linkid = urlencode(base64_encode($row['stuid']));
			$linkfn = urlencode(base64_encode($row['fname']));
			$linkgn = urlencode(base64_encode($row['gname']));
			
			$notifyid = $row['id'];
			
			//Encode Link
			if ($row['type'] == 0) {
				$types = $type[$row['type']]." - ".$typeapp[$row['typeapp']];
				$href = "studentdt.php?ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=st&n=nt&nid="
				.$notifyid."#".$navigate[$row['typeapp']];
			}
			elseif ($row['type'] == 1) {
				$types = $type[$row['type']];
				$href = "evidencedt.php?ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=ev&n=nt&nid="
				.$notifyid;
			}
			else {
				$types = $type[$row['type']];
				$href = "referencedt.php?ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=rf&n=nt&nid="
				.$notifyid;
			}
			
			$output .= "<a href='".$href."' class='w3-bar-item w3-button w3-hover-green'>
			<strong>".$row['subject']."</strong><br />
			 <small><em>".$types."</em></small></a>";
		}
	}
	else {
		$output = "<a href='#' class='w3-bar-item w3-button w3-hover-green'>No Notification Found</a>";
	}
	
	/*
	$status_query = "SELECT comment,type FROM notification WHERE status=0";
	$result_query = mysqli_query($conn, $status_query);
	$count = mysqli_num_rows($result_query);
	*/
	
	$data = array('notification' => $output);
	echo json_encode($data);

?>

	
	
	