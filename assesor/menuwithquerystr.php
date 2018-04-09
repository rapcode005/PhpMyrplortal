<div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-greyb" 
	style="width:200px;" id="mySidebar">
	<button class="w3-bar-item w3-button w3-hide-large" onclick="w3_close()">Close &times;</button>
	<?php
		if(isset($_GET['ptid']) && isset($_GET['fnm'])
			&& isset($_GET['gnm'])) {
				
			$id = base64_decode(urldecode($_GET['ptid']));
			$iden = urlencode(base64_encode($id));
			
			$fn = base64_decode(urldecode($_GET['fnm']));
			$fnen = urlencode(base64_encode($fn));

			$gn = base64_decode(urldecode($_GET['gnm']));
			$gnen = urlencode(base64_encode($gn));
			
			echo "<a href='studentinfo.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."' class='w3-bar-item w3-button'>Application Form</a>
			<a href='reference.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."' class='w3-bar-item w3-button'>Reference</a>
			<a href='evidence.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."' class='w3-bar-item w3-button'>Evidence</a>
			<a href='assesor.php?ptid=".$iden."&fnm=".$fnen."&gnm=".$gnen."' class='w3-bar-item w3-button'>Assesor</a>";
		}
	?>
</div>