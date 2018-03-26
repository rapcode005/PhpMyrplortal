<?php 
	include_once '../header.php';
	include_once 'menu.php';
?>

<div class="w3-main" style="margin-left:200px">
	<button class="w3-button w3-blueh w3-hover-green w3-teal w3-xlarge w3-hide-large" 
	onclick="w3_open()">&#9776;</button>
</div>

<div class="w3-main" style="margin-left:200px">
	<div style="background-color: #09519c; color:#fff;">
		<h3 style="padding-left:16px;">Personal Details</h3>
	</div>
	<form action="data/" method="POST">
		<div class="w3-container">
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
				<h3>Residence</h3>
			</div>
			<label>Building/Property Name</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdbuildr" />
			<label>Flat/Unit details</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdflastr" />
			<label>Street/Lot number</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdstrnumr" />
			<label>Suburb/Locality/Town</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdsltr" />
			<label>State</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdstater" />
			<label>Postal Code</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdptlr" />
			<div style="background-color: #09519c; color:#fff;">
				<h3>Postal Address</h3>
			</div>
			<label>Building/Property Name</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdbuildp" />
			<label>Flat/Unit details</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdflastp" />
			<label>Street/Lot Number</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdstrnump" />
			<label>Suburb/Locality/Town</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdsltp" />
			<label>State</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdstatep" />
			<label>Postal Code</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdptlp" />
			<div style="background-color: #09519c; color:#fff;">
				<h3>Phone and Contact details</h3>
			</div>
			<label>Home</label><input type="number"
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdhome" />
			<label>Work</label><input type="number"
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdwork" />
			<label>Mobile</label><input type="number"
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdmobile" />
			<label>Email</label><input type="email"
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdemail" />
		</div>
		<div style="background-color: #09519c; color:#fff;">
			<h3 style="padding-left:16px;">Emegency Contact</h3>
		</div>
		<div class="w3-container">
			<label>Home</label><input type="number"
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdhomee" />
			<label>Work</label><input type="number"
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdworke" />
			<label>Mobile</label><input type="number"
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdmobilee" />
			<label>Email</label><input type="email"
			class="w3-input w3-border 
			w3-animate-input
			w3-light-grey"
			style="width:200px"		
			name="stdemaile" />
		</div>
		<div style="background-color: #09519c; color:#fff;">
			<h3 style="padding-left:16px;">Language and Cultural Diversity</h3>
		</div>
		<div class="w3-container">
			<label>In which country were you born?<label>
			<p><input class="w3-radio" type="radio" name="stdlang" value="Australia" checked 
			onclick="w3_hideother()" />
			<label>Australia</label></p>
			<p><input class="w3-radio" type="radio" name="stdlang" value="Other"
			onclick="w3_showother()" />
			<label>Other</label></p>
			<input type="text" class="w3-input w3-border 
			w3-animate-input w3-light-grey"
			style="width:200px; display: none;"		
			name="stdstatep"
			id="stdstatep"/>
			<label>Resident Type<label>
			<p><input class="w3-radio" type="radio" name="stdrsttype" value="Australian Citizen" checked 
			onclick="w3_hideothervisa()" />
			<label>Australian Citizen</label></p>
			<p><input class="w3-radio" type="radio" name="stdrsttype" value="Permament Australia Resident" 
			onclick="w3_hideothervisa()" />
			<label>Permament Australia Resident</label></p>
			<p><input class="w3-radio" type="radio" name="stdrsttype" value="New Zealand Citizen Living in Austrialia" 
			onclick="w3_hideothervisa()" />
			<label>New Zealand Citizen Living in Austrialia</label></p>
			<p><input class="w3-radio" type="radio" name="stdrsttype" value="Visa Type" 
			onclick="w3_showothervisa()" />
			<label>Visa Type</label></p>
			<input type="text" class="w3-input w3-border 
			w3-animate-input w3-light-grey"
			style="width:200px; display: none;"		
			name="stdvisatype"
			id="stdvisatype"/>
			<label>Do you speak a language other English at home?<label>
			<label>If more than one languge, indicate the one which is spoken the most<label>
			<p><input class="w3-radio" type="radio" name="stdenghome" value="No, English Only" checked 
			onclick="w3_hideotherlang()" />
			<label>No, English only</label></p>
			<p><input class="w3-radio" type="radio" name="stdenghome" value="Yes, Specify" 
			onclick="w3_showotherlang()" />
			<label>Yes, Specify</label></p>
			<input type="text" class="w3-input w3-border 
			w3-animate-input w3-light-grey"
			style="width:200px; display: none;"		
			name="stdspecify"
			id="stdspecify"/>
			<label>How well do you speak in English?<label>
			<p><input class="w3-radio" type="radio" name="stdwelleng" value="Very Well" checked  />
			<label>Very Well</label></p>
			<p><input class="w3-radio" type="radio" name="stdwelleng" value="Well"  />
			<label>Well</label></p>
			<p><input class="w3-radio" type="radio" name="stdwelleng" value="Not Well" />
			<label>Not Well</label></p>
			<p><input class="w3-radio" type="radio" name="stdwelleng" value="Not at all" />
			<label>Not at all</label></p>
			<label>Are you of Aboriginal or Torres Strait Islander origin?<label>
			<p><input class="w3-radio" type="radio" name="stdabotors" value="No" checked 
			 />
			<label>No</label></p>
			<p><input class="w3-radio" type="radio" name="stdabotors" value="Yes - Aboriginal" 
			 />
			 <label>Yes - Aboriginal</label></p>
			<p><input class="w3-radio" type="radio" name="stdabotors" value="Yes - Torres Strait Islander" />
			<label>Yes - Torres Strait Islander</label></p>
		</div>
		<div style="background-color: #09519c; color:#fff;">
			<h3 style="padding-left:16px;">Individual Learning Needs</h3>
		</div>
		<div class="w3-container">
			<label>Do you consider yourself to have a disability, Impairment or long-term condition?<label>
			<p><input class="w3-radio" type="radio" name="stddisabi" value="Yes"  onclick="w3_hidedisability()"  />
			<label>Yes</label></p>
			<p><input class="w3-radio" type="radio" name="stddisabi" value="No - go to Question 5" checked onclick="w3_showdisability()"  />
			<label>No - go to Question 5</label></p>
			<div id="disabilityYes" style="display:none" >
				<label>If yes, please indicate(You may indicate more than one)?<label>
				<p><input class="w3-radio" type="radio" name="stdindicate" value="Vision" onclick="w3_hideotherdisability()" />
				<label>Vision</label></p>
				<p><input class="w3-radio" type="radio" name="stdindicate" value="Physical" onclick="w3_hideotherdisability()" />
				<label>Physical</label></p>
				<p><input class="w3-radio" type="radio" name="stdindicate" value="Learning" onclick="w3_hideotherdisability()" />
				<label>Learning</label></p>
				<p><input class="w3-radio" type="radio" name="stdindicate" value="Intellectual" onclick="w3_hideotherdisability()" />
				<label>Intellectual</label></p>
				<p><input class="w3-radio" type="radio" name="stdindicate" value="Hearing/Def" onclick="w3_hideotherdisability()" />
				<label>Hearing/Def</label></p>
				<p><input class="w3-radio" type="radio" name="stdindicate" value="Mental illness" onclick="w3_hideotherdisability()" />
				<label>Mental illness</label></p>
				<p><input class="w3-radio" type="radio" name="stdindicate" value="Medical condition" onclick="w3_hideotherdisability()"/>
				<label>Medical condition</label></p>
				<p><input class="w3-radio" type="radio" name="stdindicate" value="Acquired brain impairment" onclick="w3_hideotherdisability()" />
				<label>Acquired brain impairment</label></p>
				<p><input class="w3-radio" type="radio" name="stdindicate" value="Other" onclick="w3_showotherdisability()" />
				<label>Other</label></p>
				<div id="otherdisability" style="display: none;">
					<input type="text" class="w3-input w3-border 
					w3-animate-input w3-light-grey"
					style="width:200px;"		
					name="stdotherdis"
					id="stdotherdis"/>
				</div>
				<label>Adjustment<label><br>
				<label>If yes, please specify<label>
				<input type="text" class="w3-input w3-border 
				w3-animate-input w3-light-grey"
				style="width:200px;"		
				name="stdotherplsspecify"
				id="stdotherplsspecify"/>
			</div>
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
	function w3_showother() {
		document.getElementById("stdstatep").style.display = "block";
	}
	function w3_hideother() {
		document.getElementById("stdstatep").style.display = "none";
	}
	function w3_hideothervisa() {
		document.getElementById("stdvisatype").style.display = "none";
	}
	function w3_showothervisa() {
		document.getElementById("stdvisatype").style.display = "block";
	}
	function w3_showotherlang() {
		document.getElementById("stdspecify").style.display = "block";
	}
	function w3_hideotherlang() {
		document.getElementById("stdspecify").style.display = "none";
	}
	function w3_showdisability() {
		document.getElementById("disabilityYes").style.display = "block";
	}
	function w3_hidedisability() {
		document.getElementById("disabilityYes").style.display = "none";
	}
	function w3_showotherdisability() {
		document.getElementById("otherdisability").style.display = "block";
	}
	function w3_hideotherdisability() {
		document.getElementById("otherdisability").style.display = "none";
	}
</script>