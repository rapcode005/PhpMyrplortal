<div class="w3-sidebar w3-bar-block w3-collapse w3-card" 
	style="width:200px;" id="mySidebar">
	<button class="w3-bar-item w3-button w3-hide-large" onclick="w3_close()">Close &times;</button>
	<?php
		if(isset($_GET['h']) ) {
				
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
				
				echo "<a href='#' class='w3-bar-item ".$st." w3-button w3-hover-green'>Application Form</a>
				<a href='#' class='w3-bar-item ".$rf." w3-button w3-hover-green'>Reference</a>
				<a href='#' class='w3-bar-item ".$ev." w3-button w3-hover-green'>Evidence</a>";
		}
		else {
			echo "<a href='#' class='w3-bar-item w3-button w3-hover-green'>Application Form</a>
			<a href='#' class='w3-bar-item w3-button w3-hover-green'>Reference</a>
			<a href='#' class='w3-bar-item w3-button w3-hover-green'>Evidence</a>";
		}
	 ?>
</div>