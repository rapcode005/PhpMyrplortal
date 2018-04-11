<div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-greyb" 
	style="width:200px;" id="mySidebar">
	<button class="w3-bar-item w3-button w3-hide-large" onclick="w3_close()">Close &times;</button>
	<?php
		if(isset($_GET['ptid']) && isset($_GET['fnm'])
			&& isset($_GET['gnm']) && isset($_GET['h']) ) {
			
			//id
			$id = base64_decode(urldecode($_GET['ptid']));
			$iden = urlencode(base64_encode($id));
			
			//family name
			$fn = base64_decode(urldecode($_GET['fnm']));
			$fnen = urlencode(base64_encode($fn));
			
			//given name
			$gn = base64_decode(urldecode($_GET['gnm']));
			$gnen = urlencode(base64_encode($gn));
			
			//highlight
			$h = $_GET['h'];
			$hselect["rf"] = "";
			$hselect["st"] = "";
			$hselect["ev"] = "";
			$hselect["rq"] = "";
			
			if ($h == "st") {
				$hselect["st"] = "w3-green";
			}
			elseif($h == "ev") {
				$hselect["ev"] = "w3-green";
			}
			elseif($h == "rf") {
				$hselect["rf"] = "w3-green";
			}
			elseif($h == "rq") {
				$hselect["rq"] = "w3-green";
			}
			
			echo "<a href='studentinfo.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."&h=st' class='w3-bar-item ".$hselect["st"]." w3-button w3-hover-green'>Application Form</a>
			<a href='reference.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."&h=rf' class='w3-bar-item ".$hselect["rf"]." w3-button w3-hover-green'>Reference</a>
			<a href='evidence.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."&h=ev' class='w3-bar-item ".$hselect["ev"]." w3-button w3-hover-green'>Evidence</a>
			<a href='request.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."&h=rq' class='w3-bar-item ".$hselect["rq"]." w3-button w3-hover-green'>Request</a>";
		}
	?>
</div>