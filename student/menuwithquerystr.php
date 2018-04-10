<div class="w3-sidebar w3-bar-block w3-collapse w3-card" 
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
			if ($h == "st") {
				$st = "w3-green";
				$ev = "";
				$rf = "";
			}
			elseif($h == "ev") {
				$ev = "w3-green";
				$st = "";
				$rf = "";
			}
			elseif($h == "rf") {
				$rf = "w3-green";
				$st = "";
				$ev = "";
			}
			
			echo "<a href='studentdt.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."&h=st' class='w3-bar-item ".$st." w3-button w3-hover-green'>Application Form</a>
				<a href='referencedt.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."&h=ev' class='w3-bar-item ".$ev." w3-button w3-hover-green'>Reference</a>
				<a href='evidencedt.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."&h=rf' class='w3-bar-item ".$rf." w3-button w3-hover-green'>Evidence</a>";
		}
	?>
</div>