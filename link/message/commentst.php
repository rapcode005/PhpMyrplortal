<?php
if (isset($_GET['cnt'])) {
	echo "<div class='w3-top'>";
	
	echo "<div class='w3-container w3-white w3-card-4 w3-padding-large'
			style='margin-top:20px; width: 85%;'>";
	
	$cnt = base64_decode(urldecode($_GET['cnt']));
	echo "<h6><b>Comment: </b>".$cnt."</h6>";
	
	echo "<button type='submit' name='submitupdate' 
			class='w3-blueh w3-hover-green w3-padding-large
			w3-border w3-medium'
			>Save</button>";
			
	echo "</div></div>";
}
