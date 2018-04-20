<div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-large" 
	style="width:200px;font-family: Arial, Helvetica, sans-serif;" 
	id="mySidebar">
	<button class="w3-bar-item w3-button w3-hover-green w3-hide-large" 
	onclick="w3_close()">Close &times;</button>
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
			
			$st = "<a href='studentdt.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."&h=st' class='w3-bar-item w3-button w3-hover-green'>Application Form</a>";
			$rf = "<a href='referencedt.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."&h=rf' class='w3-bar-item w3-button w3-hover-green'>Reference</a>";
			$ev = "<a href='evidencedt.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."&h=ev' class='w3-bar-item  w3-button w3-hover-green'>Evidence</a>";
			
			//highlight
			$h = $_GET['h'];
			if ($h == "st") {
				$st = "<a class='w3-bar-item w3-green w3-button w3-hover-green w3-disabled'>Application Form</a>";
			}
			elseif($h == "ev") {
				$ev = "<a class='w3-bar-item w3-green w3-button w3-hover-green w3-disabled'>Evidence</a>";
			}
			elseif($h == "rf") {
				$rf = "<a class='w3-bar-item w3-button w3-green w3-hover-green w3-disabled'>Reference</a>";
			}
			
			echo $st.$ev.$rf;
		}
	?>
</div>