<?php

	include_once '../../data/dbh.php';
		/*
		if ($_POST['view'] != "") {
			$update = "UPDATE notification SET status = 1 WHERE status=0";
   			mysqli_query($con, $update);
		}
		*/	
	$query = "SELECT a.id,a.subject,a.type,a.typeapp,a.comment,a.stuid,c.fname,c.gname 
			FROM notification a LEFT JOIN studentinfo b on a.stuid = b.id
			INNER JOIN personaldt c on b.stdcode = c.id WHERE a.status=0 and 
			(a.updateduserid is not null)";
			
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
			
			//ID
			$notifyid = $row['id'];
			
			//Comment
			$linkcnt =  urlencode(base64_encode($row['comment']));
			
			//Encode Link
			if ($row['type'] == 0) {
				
				$nv = $navigate[$row['typeapp']];
				
				$types = $type[$row['type']]." - ".$typeapp[$row['typeapp']];
				$href = "studentinfo.php?ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=st&n=nt&nid="
				.$notifyid."&cnt=".$linkcnt."&nv=".$nv."#".$navigate[$row['typeapp']];
			}
			elseif ($row['type'] == 1) {
				$types = $type[$row['type']];
				$href = "evidence.php?ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=ev&n=nt&nid="
				.$notifyid."&cnt=".$linkcnt;
			}
			else {
				$types = $type[$row['type']];
				$href = "reference.php?ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=rf&n=nt&nid="
				.$notifyid."&cnt=".$linkcnt;
			}
			
			$output .= "<a href='".$href."' class='w3-bar-item w3-button w3-hover-green'>
			<strong>".$row['subject']."</strong><br />
			 <small><em>".$types."</em></small></a>";
		}
	}
	else {
		$output = "<a class='w3-bar-item w3-button w3-hover-green'>No Notification Found</a>";
	}
	
	
	$count = "SELECT count(id) as id FROM notification WHERE status=0
	and (updateduserid is not null)";
	$result_query = mysqli_query($conn, $count);

	if ($tcount = mysqli_fetch_assoc($result_query)) {
		$rcount  = $tcount['id'];
	}
	else 
		$rcount = 0;
	
	$data = array('notification' => $output,
		'count' => $rcount);
		
	echo json_encode($data);

?>
