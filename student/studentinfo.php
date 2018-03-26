<?php 
	include_once '../header.php';
	include_once 'menu.php';
?>

<div class="w3-main" style="margin-left:200px">
	<button class="w3-button w3-teal w3-xlarge w3-hide-large" 
	onclick="w3_open()">&#9776;</button>
</div>



<div class="w3-main" style="margin-left:200px">
	<div style="background-color: #09519c; color:#fff;">
		<h3 style="padding-left:16px;">Personal Details</h3>
	</div>
	<form class="w3-container" action="data/" method="POST">
		<label>Student Code</label><input type="text" 
		class="w3-input w3-border 
		w3-animate-input
		w3-light-grey"
		style="width:200px"		
		name="stdcode" />
		<label>Family Name</label><input type="text" 
		class="w3-input w3-border 
		w3-animate-input
		w3-light-grey"
		style="width:200px"		
		name="stdfname" />
		<label>Given Name</label><input type="text" 
		class="w3-input w3-border 
		w3-animate-input
		w3-light-grey"
		style="width:200px"		
		name="stdgname" />
		<label>Preffered Name</label><input type="text" 
		class="w3-input w3-border 
		w3-animate-input
		w3-light-grey"
		style="width:200px"		
		name="stdprename" />
		<label>Birthday</label><input type="date"
		class="w3-input w3-border 
		w3-animate-input
		w3-light-grey"
		style="width:200px"		
		name="stdbth" />
		<label>Age</label><input type="number"
		class="w3-input w3-border 
		w3-animate-input
		w3-light-grey"
		style="width:200px"		
		name="stdage" />
		<div style="background-color: #09519c; color:#fff;">
			<h3 style="padding-left:16px;">Usual Residence</h3>
		</div>
		<label>Building/Property Name</label><input type="text" 
		class="w3-input w3-border 
		w3-animate-input
		w3-light-grey"
		style="width:200px"		
		name="stdbuild" />
		<label>Flat/Unit details</label><input type="text" 
		class="w3-input w3-border 
		w3-animate-input
		w3-light-grey"
		style="width:200px"		
		name="stdflast" />
		<label>Street/Lot number</label><input type="text" 
		class="w3-input w3-border 
		w3-animate-input
		w3-light-grey"
		style="width:200px"		
		name="stdstrnum" />
		<label>Suburb/Locality/Town</label><input type="text" 
		class="w3-input w3-border 
		w3-animate-input
		w3-light-grey"
		style="width:200px"		
		name="stdslt" />
		<label>Student Code</label><input type="text" 
		class="w3-input w3-border 
		w3-animate-input
		w3-light-grey"
		style="width:200px"		
		name="stdcode" />
		<label>Student Code</label><input type="text" 
		class="w3-input w3-border 
		w3-animate-input
		w3-light-grey"
		style="width:200px"		
		name="stdcode" />
		<label>Student Code</label><input type="text" 
		class="w3-input w3-border 
		w3-animate-input
		w3-light-grey"
		style="width:200px"		
		name="stdcode" />
		<div style="background-color: #09519c; color:#fff;">
			<h3 style="padding-left:16px;">Emegency Contact</h3>
		</div>
		</form>
</div>

<script>
	function w3_open() {
		document.getElementById("mySidebar").style.display = "block";
	}
	function w3_close() {
		document.getElementById("mySidebar").style.display = "none";
	}
</script>