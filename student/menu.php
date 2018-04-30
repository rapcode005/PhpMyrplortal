<div class="w3-sidebar w3-bar-block w3-greyc w3-collapse w3-card w3-large" 
	style="width:200px;font-family: Arial, Helvetica, sans-serif;
	margin-top:46px;" id="mySidebar">
	<button class="w3-bar-item w3-button w3-hover-green w3-hide-large" 
	onclick="w3_close()">Close &times;</button>
	<?php
		if(isset($_GET['h']) ) {

				$st = "<a class='w3-bar-item w3-button w3-hover-greyc w3-disabled'>Application Form</a>";
				$rf = "<a class='w3-bar-item w3-button w3-hover-greyc w3-disabled'>Reference</a>";
				$ev = "<a class='w3-bar-item  w3-button w3-hover-greyc w3-disabled'>Evidence</a>";
				
				//highlight
				$h = $_GET['h'];
				if ($h == "st") {
					$st = "<a class='w3-bar-item w3-button w3-green w3-hover-green w3-disabled'>Application Form</a>";
				}
				elseif($h == "ev") {
					$ev = "<a class='w3-bar-item w3-button w3-green w3-hover-green w3-disabled'>Evidence</a>";
				}
				elseif($h == "rf") {
					$rf = "<a class='w3-bar-item w3-button w3-green w3-hover-green w3-disabled'>Reference</a>";
				}
				
				echo $st.$ev.$rf;
		}
		else {
			echo "<a class='w3-bar-item w3-hover-greyc w3-disabled'>Application Form</a>
			<a class=w3-bar-item w3-hover-greyc w3-disabled'>Evidence</a>
			<a class='w3-bar-item w3-hover-greyc w3-disabled'>Reference</a>";
		}
	 ?>
</div>