<?php 
	include_once 'headerwithoutsearch.php';
	include_once '../data/dbh.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
	unset($_SESSION['stdid']);
	include_once 'menu.php';
?>
<div style="width:25%">
	<button class="w3-button w3-blueh w3-hover-green w3-xlarge w3-hide-large" 
	onclick="w3_open()">&#9776;</button>
</div>

<form action="data/save.php" method="POST" onsubmit="return checkform();">
<div class="w3-bottom">
	<div class="w3-display-bottomright w3-margin"
		style="font-family: Arial, Helvetica, sans-serif;">
		<button type="submit" name="submitsave" 
		class="w3-blueh w3-hover-green w3-padding-large
		w3-border w3-large"
		style="float:right;">Save</button>
	</div>	
</div>	

<div class="w3-main w3-container w3-small" style="margin-top:20px; 
	margin-left:200px; font-family: Arial, Helvetica, sans-serif;">

	
	<div id="pt" class="w3-greyb w3-card-4">
		<header class="w3-container w3-blueh w3-tea">
			<span id="perdt"><h3>Personal Details</h3></span>
		</header>
		
		<div class="w3-container">
			<p>
				<select class="w3-select w3-select-input w3-animate-input"
				style="width:200px;" name="optcourse" id="optcourse">
					<option value="" disabled selected>Choose your unit/course</option>
					<?php
						$sql = "SELECT code,descrp FROM courselist";
						$result = mysqli_query($conn,$sql);
						while($row = mysqli_fetch_assoc($result)) {
							echo "<option value='".$row['code']."'
							>".$row['descrp']."</option>";
						}
					?>
				</select>
				<label id="loptcourse" style="color: red; display:none;" for="optcourse">Course is required.</label></p>
			<p>
			<label class="w3-margin-right">USI</label>
			<a class="w3-hover-green w3-small w3-blueh w3-padding-small w3-margin-right"
			target="_blank" href="https://portal.usi.gov.au/student/ForgottenUsi">Forgotten USI</a> 
			<a class="w3-hover-green w3-small w3-blueh w3-padding-small" target="_blank"
			href="https://www.usi.gov.au/students/create-your-usi">Create USI</a>
			<input type="text" class="w3-input w3-border w3-animate-input" 
			style="width:200px"	name="stdcode" id="stdcode" />
			<label id="lstdcode" style="color: red; display:none;">USI is required.</label></p>
			<p>
			<label>Family Name</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdfname" id="stdfname" />
			<label id="lstdfname" style="color: red; display:none;">Family Name is required.</label></p>
			<p>
			<label>Given Name</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdgname" id="stdgname"  />
			<label id="lstdgname" style="color: red; display:none;">Given Name is required.</label></p>
			<p>
			<label>Preffered Name</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdpname" id="stdpname" />
			<label id="lstdpname" style="color: red; display:none;">Preffered Name is required.</label></p>
			<p>
			<label>Birthday</label><input type="date"
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdbth" id="stdbth"  />
			<label id="lstdbth" style="color: red; display:none;">Birthday is required.</label></p>
			<p>
			<label>Age</label><input type="number"
			class="w3-input w3-border"
			style="width:70px"		
			name="stdage" id="stdage"  />
			<label id="lstdage" style="color: red; display:none;">Age is required.</label></p>
		</div>
		
	</div>
		
	<div class="w3-greyb w3-card-4" style="margin-top:20px;" >
	
		<header class="w3-container w3-blueh">
			<h3>Residence</h3>
		</header>
		
		<div class="w3-container">
			<p>
			<label>Building/Property Name</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdbuildr" /></p>
			<p>
			<label>Flat/Unit details</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdflastr" /></p>
			<p>
			<label>Street/Lot number</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdstrnumr" /></p>
			<p>
			<label>Suburb/Locality/Town</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdsltr" /></p>
			<p>
			<label>State</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdstater" /></p>
			<p>
			<label>Postal Code</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdptlr" /></p>
		</div>
		
	</div>
		
	<div class="w3-greyb w3-card-4" style="margin-top:20px;" >
		<header class="w3-container w3-blueh">
			<h3>Postal Address</h3>
		</header>
		
		<div class="w3-container">
			<p>
			<label>Building/Property Name</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px;"		
			name="stdbuildp" /></p>
			<p>
			<label>Flat/Unit details</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdflastp" /></p>
			<p>
			<label>Street/Lot Number</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdstrnump" /></p>
			<p>
			<label>Suburb/Locality/Town</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdsltp" /></p>
			<p>
			<label>State</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="statept" /></p>
			<p>
			<label>Postal Code</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdptlp" /></p>
		</div>
		
	</div>
		
	<div class="w3-greyb w3-card-4" style="margin-top:20px;">
	
		<header class="w3-container w3-blueh">
			<h3>Phone and Contact details</h3>
		</header>
		
		<div class="w3-container">
			<p>
			<label>Home</label><input type="number"
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdhome" /></p>
			<p>
			<label>Work</label><input type="number"
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdwork" /></p>
			<p>
			<label>Mobile</label><input type="number"
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdmobile" /></p>
			<p>
			<label>Email</label><input type="email"
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdemail" /></p>
		</div>
		
	</div>
	
	<div class="w3-greyb w3-card-4" style="margin-top:20px;" >
	
		<header class="w3-container w3-blueh">
			<h3>Emegency Contact</h3>
		</header>
		
		<div class="w3-container">
			<p>
			<label>Home</label><input type="number"
			class="w3-input w3-border w3-animate-input"
			style="width:200px"		
			name="stdhomee" /></p>
			<p>
			<label>Work</label><input type="number"
			class="w3-input w3-border w3-animate-input"
			style="width:200px"		
			name="stdworke" /></p>
			<p>
			<label>Mobile</label><input type="number"
			class="w3-input w3-border w3-animate-input"
			style="width:200px"		
			name="stdmobilee" /></p>
			<p>
			<label>Email</label><input type="email"
			class="w3-input w3-border w3-animate-input"
			style="width:200px"		
			name="stdemaile" /></p>
		</div>
		
	</div>
		
	<div class="w3-greyb w3-card-4" style="margin-top:20px;">
		<header class="w3-container w3-blueh">
			<h3>Language and Cultural Diversity</h3>
		</header>
		
		<div class="w3-container w3-white w3-card-4 w3-padding-large w3-margin">
			<label>In which country were you born?</label>
			<p><input class="w3-radio" type="radio" name="stdlang" value="Australia"  
			onclick="w3_hideother()"  />
			<label>Australia</label></p>
			<p><input class="w3-radio" type="radio" name="stdlang" value="Other"
			onclick="w3_showother()" />
			<label>Other</label></p>
			<input type="text" class="w3-input w3-border 
			w3-animate-input w3-light-grey"
			style="width:200px; display: none;"		
			name="stdstatep"
			id="stdstatep"/>
		</div>
		
		<div class="w3-container w3-white w3-card-4 w3-padding-large w3-margin">
			<label>Resident Type</label>
			<p><input class="w3-radio" type="radio" name="stdrsttype" value="Australian Citizen"  
			onclick="w3_hideothervisa()"  />
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
		</div>
		
		<div class="w3-container w3-white w3-card-4 w3-padding-large w3-margin">
			<label>Languages</label>
			<p><input class="w3-radio" type="radio" name="stdenghome" value="No, English Only"  
			onclick="w3_hideotherlang()"  />
			<label>No, English only</label></p>
			<p><input class="w3-radio" type="radio" name="stdenghome" value="Yes, Specify" 
			onclick="w3_showotherlang()" />
			<label>Yes, Specify</label></p>
			<input type="text" class="w3-input w3-border 
			w3-animate-input w3-light-grey"
			style="width:200px; display: none;"		
			name="stdspecify"
			id="stdspecify"/>
		</div>
		
		<div class="w3-container w3-white w3-card-4 w3-padding-large w3-margin">
			<label>How well do you speak in English?</label>
			<p><input class="w3-radio" type="radio" name="stdwelleng" 
			value="Very Well"   />
			<label>Very Well</label></p>
			<p><input class="w3-radio" type="radio" name="stdwelleng" value="Well"  />
			<label>Well</label></p>
			<p><input class="w3-radio" type="radio" name="stdwelleng" value="Not Well" />
			<label>Not Well</label></p>
			<p><input class="w3-radio" type="radio" name="stdwelleng" value="Not at all" />
			<label>Not at all</label></p>
		</div>
		
		<div class="w3-container w3-white w3-card-4 w3-padding-large w3-margin">
			<label>Are you of Aboriginal or Torres Strait Islander origin?</label>
			<p><input class="w3-radio" type="radio" name="stdabotors" value="No"  />
			<label>No</label></p>
			<p><input class="w3-radio" type="radio" name="stdabotors" value="Yes - Aboriginal" 
			 />
			 <label>Yes - Aboriginal</label></p>
			<p><input class="w3-radio" type="radio" name="stdabotors" value="Yes - Torres Strait Islander" />
			<label>Yes - Torres Strait Islander</label></p>
		</div>
		
		<div class="w3-container w3-margin">
		</div>
	</div>
		
	<div class="w3-greyb w3-card-4" style="margin-top:20px;">
	
		<header class="w3-container w3-blueh">
			<h3>Individual Learning Needs</h3>
		</header>
		
		<div class="w3-container w3-white w3-card-4 w3-padding-large w3-margin">
			<label>Do you consider yourself to have a disability, Impairment or long-term condition?</label>
			<p><input class="w3-radio" type="radio" name="stddisabi" value="Yes"  onclick="w3_showdisability()"  />
			<label>Yes</label></p>
			<p><input class="w3-radio" type="radio" name="stddisabi" value="No"  onclick="w3_hidedisability()"  />
			<label>No</label></p>
		</div>
		
		<div id="disabilityYes" style="display:none;" >
			<div class="w3-container w3-white w3-card-4 w3-padding-large
			w3-margin-top w3-margin-right w3-margin-left">
				<label>If yes, please indicate(You may indicate more than one)?</label>
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
					w3-animate-input"
					style="width:200px;"		
					name="stdotherdis"
					id="stdotherdis"/>
				</div>
			</div>
			
			<div class="w3-container">
				<p>
				<label>Adjustment</label>
				<input type="text" class="w3-input w3-border 
				w3-animate-input "
				style="width:200px;"		
				name="stdadjustment"
				id="stdadjustment"/></p>
			</div>
			
		</div>
		
		<div class="w3-container w3-margin-right w3-margin-left">
		</div>
		
	</div>
		
	<div class="w3-greyb w3-card-4" style="margin-top:20px;">
		<header class="w3-container w3-blueh">
			<h3>Education</h3>
		</header>
		
		<div class="w3-container w3-white w3-card-4 w3-padding-large 
		w3-margin-top w3-margin-right w3-margin-left">
			<label>Highest Completed School Level</label>
			<p><input class="w3-radio" type="radio" name="stdhgcomschlvl" value="Year 12 or Equivalent"   />
			<label>Year 12 or Equivalent</label></p>
			<p><input class="w3-radio" type="radio" name="stdhgcomschlvl" value="Year 11 or Equivalent"  />
			<label>Year 11 or Equivalent</label></p>
			<p><input class="w3-radio" type="radio" name="stdhgcomschlvl" value="Year 10 or Equivalent"  />
			<label>Year 10 or Equivalent</label></p>
			<p><input class="w3-radio" type="radio" name="stdhgcomschlvl" value="Year 9 or Equivalent"  />
			<label>Year 9 or Equivalent</label></p>
			<p><input class="w3-radio" type="radio" name="stdhgcomschlvl" value="Year 8 or Below"  />
			<label>Year 8 or Below</label></p>
			<p><input class="w3-radio" type="radio" name="stdhgcomschlvl" value="Never Attended School"  />
			<label>Never Attended School</label></p>
		</div>
		
		<div class="w3-container">
			<p><label>In which Year did you complete that level</label>
			<input type="number"class="w3-input w3-border w3-animate-input" 
			style="width:200px"	name="stdyearcomp" /></p>
		</div>
		
		<div class="w3-container w3-white w3-card-4 w3-padding-large 
		w3-margin-right w3-margin-left w3-margin-bottom">
			<label>Are you still attending secondary level?</label>
			<p><input class="w3-radio" type="radio" name="stdseclvl" value="Yes"  />
			<label>Yes</label></p>
			<p><input class="w3-radio" type="radio" name="stdseclvl" value="No"  />
			<label>No</label></p>
		</div>
		
		<div class="w3-container w3-white w3-card-4 w3-padding-large w3-margin">
			<label>Have you successfully completed any of the following qualification?</label>
			<p><input class="w3-radio" type="radio" name="stdsuccessqual" value="Yes" onclick="w3_showqualcomp()"/>
			<label>Yes</label></p>
			<p><input class="w3-radio" type="radio" name="stdsuccessqual" value="No"  onclick="w3_hidequalcomp()" />
			<label>No</label></p>
		</div>
		
		<div id="qualsuccomp" style="display:none;" >
		
			<div class="w3-container w3-white w3-card-4 w3-padding-large w3-margin">
				<p><input class="w3-radio" type="radio" name="stdqualsuccomp" value="Bachelor Degree or Higher Degree Level" />
				<label>Bachelor Degree or Higher Degree Level</label></p>
				<p><input class="w3-radio" type="radio" name="stdqualsuccomp" value="Advanced Diploma or Assiociate Degree Level"  />
				<label>Advanced Diploma or Assiociate Degree Level</label></p>
				<p><input class="w3-radio" type="radio" name="stdqualsuccomp" value="Diploma (or associate diploma)"  />
				<label>Diploma (or associate diploma)</label></p>
				<p><input class="w3-radio" type="radio" name="stdqualsuccomp" value="Certificate IV"  />
				<label>Certificate IV</label></p>
				<p><input class="w3-radio" type="radio" name="stdqualsuccomp" value="Certificate III"  />
				<label>Certificate III</label></p>
				<p><input class="w3-radio" type="radio" name="stdqualsuccomp" value="Certificate II"  />
				<label>Certificate II</label></p>
				<p><input class="w3-radio" type="radio" name="stdqualsuccomp" value="Certificate I"  />
				<label>Certificate I</label></p>
				<p><input class="w3-radio" type="radio" name="stdqualsuccomp" value="Certificates other than the above"  />
				<label>Certificates other than the above</label></p>
			</div>
			
		</div>
		
		<div class="w3-container w3-margin">
		</div>
		
	</div>
	
	<div class="w3-greyb w3-card-4" style="margin-top:20px;">
	
		<header class="w3-container w3-blueh">
			<h3>Reason for study</h3>
		</header>
		
		<div class="w3-container w3-white w3-card-4 w3-padding-large w3-margin">
			<label>Which best describes your reasons for enrolling in the qualification?</label>
			<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="To get a Job"
			/>
			<label>To get a Job</label></p>
			<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="To develop my existing business"
			/>
			<label>To develop my existing business</label></p>
			<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="To start my own business"
			/>
			<label>To start my own business</label></p>
			<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="To try a different career"
			/>
			<label>To try a different career</label></p>
			<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="To get a better job or promotion"
			/>
			<label>To get a better job or promotion</label></p>
			<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="It is requirement of my job"
			/>
			<label>It is requirement of my job</label></p>
			<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="To start my own business"
			/>
			<label>To start my own business</label></p>
			<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="I want extra skills for my job"
			/>
			<label>I want extra skills for my job</label></p>
			<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="To get into another course of study"
			/>
			<label>To get into another course of study</label></p>
			<p><input class="w3-check" type="checkbox" name="reasonqual[]" value="For personal interest or self-development"
			/>
			<label>For personal interest or self-development</label></p>
			<p><input class="w3-check" type="checkbox" name="reasonqual[]" id="otherreason" value="Other reason"
			onclick="w3_showotherreason()"/>
			<label>Other reason</label></p>
			<input type="text"
			class="w3-input w3-border w3-animate-input w3-light-grey" style="width:200px; Display:none;"		
			name="otherreasonstate"
			id="otherreasonstate" />
		</div>
		
		<div class="w3-container w3-white w3-card-4 w3-padding-large w3-margin">
			<label>How did you hear about this course?</label>
			<p><input class="w3-radio" type="radio" name="hearaboutcou" value="Advertisement - where" 
			onclick="w3_showadvertisemen()"  />
			<label>Advertisement - where</label></p>
			<input type="text"
			class="w3-input w3-border w3-animate-input w3-light-grey" style="width:200px; Display:none;"		
			name="advertisementwhe"
			id="advertisementwhe" />
			<p><input class="w3-radio" type="radio" name="hearaboutcou" value="Word of mouth - who" 
			onclick="w3_showwordof()" />
			<label>Word of mouth - who</label></p>
			<input type="text"
			class="w3-input w3-border w3-animate-input w3-light-grey" style="width:200px; Display:none;"		
			name="wordofmout"
			id="wordofmout" />
			<p><input class="w3-radio" type="radio" name="hearaboutcou"  value="Website" onclick="w3_showwebsite()"  />
			<label>Website</label></p>
			<p><input class="w3-radio" type="radio" name="hearaboutcou" value="Other"  
			onclick="w3_showotherhear()"/>
			<label>Other</label></p>
			<input type="text"
			class="w3-input w3-border w3-animate-input w3-light-grey" style="width:200px; Display:none;"		
			name="otherhear"
			id="otherhear" />
		</div>
		
		<div class="w3-container w3-margin">
		</div>
		
	</div>
		
	<div class="w3-greyb w3-card-4" style="margin-top:20px;">
		<header class="w3-container w3-blueh">
			<h3>Current Employment Status</h3>
		</header>
		
		<div class="w3-container w3-white w3-card-4 w3-padding-large w3-margin">
			<label>Employment Status</label>
			<p><input class="w3-radio" type="radio" name="stdcurempsts" value="Full Time"   />
			<label>Full Time</label></p>
			<p><input class="w3-radio" type="radio" name="stdcurempsts" value="Part Time"  />
			<label>Part Time</label></p>
			<p><input class="w3-radio" type="radio" name="stdcurempsts" value="Self-employed - not employing others" />
			<label>Self-employed - not employing others</label></p>
			<p><input class="w3-radio" type="radio" name="stdcurempsts" value="Employer" />
			<label>Employer</label></p>
			<p><input class="w3-radio" type="radio" name="stdcurempsts" value="Employer - unpaid worker in family business"  />
			<label>Employer - unpaid worker in family business</label></p>
			<p><input class="w3-radio" type="radio" name="stdcurempsts" value="Unemployed seeking full time work"  />
			<label>Unemployed seeking full time work</label></p>
			<p><input class="w3-radio" type="radio" name="stdcurempsts" value="Unemployed seeking part time work"  />
			<label>Unemployed seeking part time work</label></p>
			<p><input class="w3-radio" type="radio" name="stdcurempsts" value="Not employed, not seeking employment"  />
			<label>Not employed. not seeking employment</label></p>
		</div>
		
		<div class="w3-container w3-white w3-card-4 w3-padding-large w3-margin">
			<label>Registered for unemployment benefits with centrelink</label>
			<p><input class="w3-radio" type="radio" name="stdbencen" value="Yes" />
			<label>Yes</label></p>
			<p><input class="w3-radio" type="radio" name="stdbencen" value="No"  />
			<label>No</label></p>
		</div>
		
		<div class="w3-container w3-margin">
		</div>
		
	</div>
	
	<div class="w3-greyb w3-card-4" style="margin-top:20px;">
	
		<header class="w3-container w3-blueh">
			<h3>Employer Details</h3>
		</header>
		
		<div class="w3-container">
			<p>
			<label>Company Name</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empcomname" /></p>
			<p>
			<label>Contact Name</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empcntname" /></p>
			<p>
			<label>Address</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empaddr" /></p>
			<p>
			<label>Suburb</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empsuburb" /></p>
			<p>
			<label>Phone</label><input type="number" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empphone" /></p>
			<p>
			<label>Email</label><input type="email" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empemail" /></p>
		</div>
		
	</div>
		
	<div class="w3-greyb w3-card-4" style="margin-top:20px;">
	
		<header class="w3-container w3-blueh">
			<h3>Apprenticeships and Traineeships</h3>
		</header>
		
		<div class="w3-container w3-white w3-card-4 w3-padding-large 
		w3-margin-top w3-margin-left w3-margin-right">
			<label>Part of apprenticeships and traineeships</label>
			<p><input class="w3-radio" type="radio" name="apprentrain" value="Yes"  />
			<label>Yes</label></p>
			<p><input class="w3-radio" type="radio" name="apprentrain" value="No"  />
			<label>No</label></p>
		</div>
		
		<div class="w3-container">
			<p>
			<label>Start Date</label><input type="date" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="strdateemp" /></p>
			<p>
			<label>Job Title</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empjobtitle" /></p>
			<p>
			<label>Hours per week</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="emphrperweek" /></p>
		</div>
		
	</div>
	
	<div class="w3-greyb w3-card-4" style="margin-top:20px;">
		<header class="w3-container w3-blueh">
			<h3>Recognition of Prior Learning/Credit</h3>
		</header>
		<div class="w3-container w3-white w3-card-4 w3-padding-large w3-margin">
			<label>RPL or credit transfer</label>
			<p><input class="w3-radio" type="radio" name="recgprlrcr" value="Yes"  />
			<label>Yes</label></p>
			<p><input class="w3-radio" type="radio" name="recgprlrcr" value="No"  />
			<label>No</label></p>
		</div>
		
		<div class="w3-container w3-margin">
		</div>
		
	</div>
		
	<div class="w3-greyb w3-card-4" style="margin-top:20px;">
	
		<header class="w3-container w3-blueh">
			<h3>Jobseekers Seeking Concession</h3>
		</header>
		
		<div class="w3-container">
			<p>
			<label>Job Search Agency</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="jobsrchagen" /></p>
			<p>
			<label>Employment Co-ordinator's Name</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="emocorname" /></p>
			<p>
			<label>Suburb</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="jobskrsuburb" /></p>
			<p>
			<label>Landline</label><input type="number" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="jobskrlandline" /></p>
			<p>
			<label>Mobile</label><input type="number" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="jobskrmobile" /></p>
			<p>
			<label>Start Date</label><input type="date" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="jobskremail" /></p>
		</div>
		
		<div class="w3-container w3-white w3-card-4 w3-padding-large 
		w3-margin-bottom w3-margin-left w3-margin-right">
			<label>JSA Client Group</label>
			<p><input class="w3-radio" type="radio" name="jbaclient" value="Youth at risk"   />
			<label>Youth at risk</label></p>
			<p><input class="w3-radio" type="radio" name="jbaclient" value="CALD"  />
			<label>CALD</label></p>
			<p><input class="w3-radio" type="radio" name="jbaclient" value="Carer/Parent"  />
			<label>Carer/Parent</label></p>
		</div>
		
		<div class="w3-container w3-white w3-card-4 w3-padding-large w3-margin">
			<label>Job Search Agency Fees</label>
			<p><input class="w3-radio" type="radio" name="jbsrcagencypart" value="Yes"
			onclick="w3_showcoursefee()"/>
			<label>Yes</label></p>
			<p><input class="w3-radio" type="radio" name="jbsrcagencypart" value="No" 
			onclick="w3_hidecoursefee()" />
			<label>No</label></p>
		</div>
		
		<div class="w3-container w3-margin">
		</div>
		
	</div>
		
	<div id="coursefee" style="display:none;">
	
		<div class="w3-greyb w3-card-4" style="margin-top:20px;">
			<header class="w3-container w3-blueh">
				<h3>Course Fee</h3>
			</header>
			<div class="w3-container w3-white w3-card-4 w3-padding-large 
			w3-margin-top w3-margin-left w3-margin-right">
				<label>Payment Type</label>
				<p><input class="w3-radio" type="radio" name="paymenttype" value="Student - Full Payment"
				/>
				<label>Student - Full Payment</label></p>
				<p><input class="w3-radio" type="radio" name="paymenttype" value="Third Party - Full Payment"  />
				<label>Third Party - Full Payment</label></p>
			</div>
			<div class="w3-container">
				<p>
				<label>Student Name</label><input type="text" 
				class="w3-input w3-border w3-animate-input "
				style="width:200px"		
				name="stdnamefee" /></p>
				<p>
				<label>Third Party Representative Name</label><input type="text" 
				class="w3-input w3-border w3-animate-input "
				style="width:200px"		
				name="thrdpartrep" /></p>
				<p>
				<label>Third, the invoice is to be made out to</label><input type="text" 
				class="w3-input w3-border w3-animate-input "
				style="width:200px"		
				name="thrdparinv" /></p>
			</div>
		</div>
		
	</div>
	
	<div id="creditcard" style="display:none;">
		<div class="w3-greyb w3-card-4" style="margin-top:20px;">
			<header class="w3-container w3-blueh">
				<h3>Credit Card</h3>
			</header>
			<div class="w3-container">
				<p>
				<label>Card Type</label><input type="text" 
				class="w3-input w3-border w3-animate-input "
				style="width:200px"		
				name="crdtype" /></p>
				<p>
				<label>Card Number</label><input type="number" 
				class="w3-input w3-border w3-animate-input "
				style="width:200px"		
				name="crdnum" /></p>
			</div>
		</div>
	</div>
		
	<div class="w3-greyb w3-card-4" style="margin-top:20px;">
		<header class="w3-container w3-blueh">
			<h3>Centrelink Details</h3>
		</header>
		<div class="w3-container w3-white w3-card-4 w3-padding-large w3-margin">
			<label>Registred Centrelink Allowances</label>
			<p><input class="w3-radio" type="radio" name="regcenallow" 
			value="Yes" onclick="w3_showreg()" />
			<label>Yes</label></p>
			<p><input class="w3-radio" type="radio" name="regcenallow" 
			value="No" onclick="w3_hidereg()" />
			<label>No</label></p>
		</div>
		
		<div id="regiscentre" style="display:none;">
			<div class="w3-container w3-white w3-card-4 w3-padding-large 
			w3-margin-top w3-margin-left w3-margin-right">
				<label>Allowances</label>
				<p><input class="w3-radio" type="radio" name="allowyes" value="Newstart Allowance"   />
				<label>Newstart Allowance</label></p>
				<p><input class="w3-radio" type="radio" name="allowyes" value="Youth Allowance"  />
				<label>Youth Allowance</label></p>
				<p><input class="w3-radio" type="radio" name="allowyes" value="Age Pension"  />
				<label>Age Pension</label></p>
				<p><input class="w3-radio" type="radio" name="allowyes" value="Disability Support Pension"   />
				<label>Disability Support Pension</label></p>
				<p><input class="w3-radio" type="radio" name="allowyes" value="Parenting Payment(single)"  />
				<label>Parenting Payment(single)</label></p>
				<p><input class="w3-radio" type="radio" name="allowyes" value="Parent Payment (partnered)"  />
				<label>Parent Payment (partnered)</label></p>
			</div>
			
			<div class="w3-container">
				<p>
				<label>Reference Number</label><input type="number" 
				class="w3-input w3-border w3-animate-input "
				style="width:200px"		
				name="refnum" /></p>
				<p>
				<label>VET Number</label><input type="number" 
				class="w3-input w3-border w3-animate-input "
				style="width:200px"		
				name="vetnum" /></p>
			</div>
		</div>
		
		<div class="w3-container w3-margin-bottom
		w3-margin-left w3-margin-right">
		</div>
		
	</div>
		
</div>
</form>
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
	function w3_hidequalcomp() {
		document.getElementById("qualsuccomp").style.display = "none";
	}
	function w3_showqualcomp() {
		document.getElementById("qualsuccomp").style.display = "block";
	}
	function w3_showotherreason() {
		if (document.getElementById("otherreasonstate").style.display == "none")
			document.getElementById("otherreasonstate").style.display = "block";
		else
			document.getElementById("otherreasonstate").style.display = "none";
	}
	function w3_showadvertisemen() {
		document.getElementById("advertisementwhe").style.display = "block";
		document.getElementById("otherhear").style.display = "none";
		document.getElementById("wordofmout").style.display = "none";
	}
	function w3_showwordof() {
		document.getElementById("wordofmout").style.display = "block";
		document.getElementById("otherhear").style.display = "none";;
		document.getElementById("advertisementwhe").style.display = "none";
	}
	function w3_showotherhear() {
		document.getElementById("otherhear").style.display = "block";
		document.getElementById("advertisementwhe").style.display = "none";
		document.getElementById("wordofmout").style.display = "none";;
	}
	function w3_showwebsite() {
		document.getElementById("otherhear").style.display = "none";
		document.getElementById("advertisementwhe").style.display = "none";
		document.getElementById("wordofmout").style.display = "none";;
	}
	function w3_hideemployer() {
		document.getElementById("employerdetails").style.display = "none";
	}
	function w3_showemployer() {
		document.getElementById("employerdetails").style.display = "block";
	}
	function w3_showcoursefee() {
		document.getElementById("coursefee").style.display = "block";
		document.getElementById("creditcard").style.display = "block";
	}
	function w3_hidecoursefee() {
		document.getElementById("coursefee").style.display = "none";
		document.getElementById("creditcard").style.display = "none";
	}
	function w3_showreg() {
		document.getElementById("regiscentre").style.display = "block";
	}
	function w3_hidereg() {
		document.getElementById("regiscentre").style.display = "none";
	}
	
	function checkform() {
		var r = 0;
		
		if (document.getElementById("stdage").value == "") {
			document.getElementById("lstdage").style.display = "block";
			document.getElementById("stdage").focus();
			r += 1;
		}
		else {
			document.getElementById("lstdage").style.display = "none";
		}
		
		if (document.getElementById("stdbth").value == "") {
			document.getElementById("lstdbth").style.display = "block";
			document.getElementById("stdbth").focus();
			r += 1;
		}
		else {
			document.getElementById("lstdbth").style.display = "none";
		}
		
		if (document.getElementById("stdpname").value == "") {
			document.getElementById("lstdpname").style.display = "block";
			document.getElementById("stdpname").focus();
			r += 1;
		}
		else {
			document.getElementById("lstdpname").style.display = "none";
		}
		
		if (document.getElementById("stdgname").value == "") {
			document.getElementById("lstdgname").style.display = "block";
			document.getElementById("stdgname").focus();
			r += 1;
		}
		else {
			document.getElementById("lstdgname").style.display = "none";
		}
		
		if (document.getElementById("stdfname").value == "") {
			document.getElementById("lstdfname").style.display = "block";
			document.getElementById("stdfname").focus();
			r += 1;
		}
		else {
			document.getElementById("lstdfname").style.display = "none";
		}
		
		if (document.getElementById("stdcode").value == "") {
			document.getElementById("lstdcode").style.display = "block";
			document.getElementById("stdcode").focus();
			r += 1;
		}
		else {
			document.getElementById("lstdcode").style.display = "none";
		}
		
		
		if (document.getElementById("optcourse").value == "") {
			document.getElementById("loptcourse").style.display = "block";
			document.getElementById("optcourse").focus();
			r += 1;
		}
		else {
			document.getElementById("loptcourse").style.display = "none";
		}
		
		if(r > 0) {
			return false;
		}
		else 
			return true;
		
	}
	
</script>
