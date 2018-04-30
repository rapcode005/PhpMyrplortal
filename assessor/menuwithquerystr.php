<div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-greyc w3-large" 
	style="width:200px; font-family: Arial, Helvetica, sans-serif;
	margin-top:46px;" id="mySidebar">
	<button class="w3-bar-item w3-button w3-hide-large w3-hover-green" onclick="w3_close()">Close &times;</button>
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
			$st = "<a href='studentinfo.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."&h=st' class='w3-bar-item w3-button w3-hover-green'>Application Form</a>";
			$rf = "<a href='reference.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."&h=rf' class='w3-bar-item w3-button w3-hover-green'>Reference</a>";
			$ev = "<a href='evidence.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."&h=ev' class='w3-bar-item w3-button w3-hover-green'>Evidence</a>";
			$rq = "<a href='request.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."&h=rq' class='w3-bar-item w3-button w3-hover-green'>Request</a>";
			
			if ($h == "st") {
				$st = "<a class='w3-bar-item w3-button w3-hover-green w3-green w3-disabled'>Application Form</a>";
			}
			elseif($h == "ev") {
				$ev = "<a class='w3-bar-item w3-button w3-hover-green w3-green w3-disabled'>Evidence</a>";
			}
			elseif($h == "rf") {
				$rf = "<a class='w3-bar-item w3-button w3-hover-green w3-green w3-disabled'>Reference</a>";
			}
			elseif($h == "rq") {
				$rq = "<a class='w3-bar-item w3-button w3-hover-green w3-green w3-disabled'>Request</a>";
			}
			
			echo $st.$ev.$rf.$rq;
		}
	?>
</div>