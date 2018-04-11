<?php 
	include_once 'headerwithoutsearch.php';
	include_once 'menu.php';
	include_once '../data/dbh.php';
	if (isset($_SESSION['uid']) == false) {
		header("Location: ../index.php");
	}
	unset($_SESSION['stdid']);
?>
<div class="w3-main" style="width:25%">
	<button class="w3-button w3-blueh w3-hover-green w3-teal w3-xlarge w3-hide-large" 
	onclick="w3_open()">&#9776;</button>
</div>
	
<div style="margin-left:220px; margin-top:16px;">
	<form action="data/save.php" method="POST">
	
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:98%;">
			<header class="w3-container w3-blueh w3-tea">
				<h2>Personal Details</h2>
			</header>
			<p style="margin-top:20px;">
				<select class="w3-select w3-select-input"
				style="width:500px;" name="optcourse">
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
			</p>
			<p style="margin-top:20px;">
			<label>USI</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:500px"		
			name="stdcode" /></p>
			<p style="margin-top:20px;">
			<label>Family Name</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:500px"		
			name="stdfname" /></p>
			<p style="margin-top:20px;">
			<label>Given Name</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:500px"		
			name="stdgname" /></p>
			<p style="margin-top:20px;">
			<label>Preffered Name</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:500px"		
			name="stdpname" /></p>
			<p style="margin-top:20px;">
			<label>Birthday</label><input type="date"
			class="w3-input w3-border 
			w3-animate-input"
			style="width:500px"		
			name="stdbth" /></p>
			<p style="margin-top:20px;">
			<label>Age</label><input type="number"
			class="w3-input w3-border 
			w3-animate-input"
			style="width:500px"		
			name="stdage" /></p>
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:98%; margin-top:20px;" >
			<header class="w3-container w3-blueh w3-tea">
				<h2>Residence</h2>
			</header>
			<p style="margin-top:20px;">
			<label>Building/Property Name</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdbuildr" /></p>
			<p style="margin-top:20px;">
			<label>Flat/Unit details</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdflastr" /></p>
			<p style="margin-top:20px;">
			<label>Street/Lot number</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdstrnumr" /></p>
			<p style="margin-top:20px;">
			<label>Suburb/Locality/Town</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdsltr" /></p>
			<p style="margin-top:20px;">
			<label>State</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdstater" /></p>
			<p style="margin-top:20px;">
			<label>Postal Code</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdptlr" /></p>
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:98%; margin-top:20px;" >
			<header class="w3-container w3-blueh w3-tea">
				<h2>Postal Address</h2>
			</header>
			<p style="margin-top:20px;">
			<label>Building/Property Name</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px;"		
			name="stdbuildp" /></p>
			<p style="margin-top:20px;">
			<label>Flat/Unit details</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdflastp" /></p>
			<p style="margin-top:20px;">
			<label>Street/Lot Number</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdstrnump" /></p>
			<p style="margin-top:20px;">
			<label>Suburb/Locality/Town</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdsltp" /></p>
			<p style="margin-top:20px;">
			<label>State</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="statept" /></p>
			<p style="margin-top:20px;">
			<label>Postal Code</label><input type="text" 
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdptlp" /></p>
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:98%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<h2>Phone and Contact details</h2>
			</header>
			<p style="margin-top:20px;">
			<label>Home</label><input type="number"
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdhome" /></p>
			<p style="margin-top:20px;">
			<label>Work</label><input type="number"
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdwork" /></p>
			<p style="margin-top:20px;">
			<label>Mobile</label><input type="number"
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdmobile" /></p>
			<p style="margin-top:20px;">
			<label>Email</label><input type="email"
			class="w3-input w3-border 
			w3-animate-input"
			style="width:200px"		
			name="stdemail" /></p>
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:98%; margin-top:20px;" >
			<header class="w3-container w3-blueh w3-tea">
				<h2>Emegency Contact</h2>
			</header>
			<p style="margin-top:20px;">
			<label>Home</label><input type="number"
			class="w3-input w3-border w3-animate-input"
			style="width:200px"		
			name="stdhomee" /></p>
			<p style="margin-top:20px;">
			<label>Work</label><input type="number"
			class="w3-input w3-border w3-animate-input"
			style="width:200px"		
			name="stdworke" /></p>
			<p style="margin-top:20px;">
			<label>Mobile</label><input type="number"
			class="w3-input w3-border w3-animate-input"
			style="width:200px"		
			name="stdmobilee" /></p>
			<p style="margin-top:20px;">
			<label>Email</label><input type="email"
			class="w3-input w3-border w3-animate-input"
			style="width:200px"		
			name="stdemaile" /></p>
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:98%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<h2>Language and Cultural Diversity</h2>
			</header>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
			style="margin-top:20px;">
				<label>In which country were you born?<label>
				<p><input class="w3-radio" type="radio" name="stdlang" value="Australia"  
				onclick="w3_hideother()" checked />
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
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
			style="margin-top:20px;">
				<label>Resident Type</label>
				<p><input class="w3-radio" type="radio" name="stdrsttype" value="Australian Citizen"  
				onclick="w3_hideothervisa()" checked />
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
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
			style="margin-top:20px;">
				<label>Languages</label>
				<p><input class="w3-radio" type="radio" name="stdenghome" value="No, English Only"  
				onclick="w3_hideotherlang()" checked />
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
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
			style="margin-top:20px;">
				<label>How well do you speak in English?<label>
				<p><input class="w3-radio" type="radio" name="stdwelleng" 
				value="Very Well"  checked />
				<label>Very Well</label></p>
				<p><input class="w3-radio" type="radio" name="stdwelleng" value="Well"  />
				<label>Well</label></p>
				<p><input class="w3-radio" type="radio" name="stdwelleng" value="Not Well" />
				<label>Not Well</label></p>
				<p><input class="w3-radio" type="radio" name="stdwelleng" value="Not at all" />
				<label>Not at all</label></p>
			</div>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
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
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:98%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<h2>Individual Learning Needs</h2>
			</header>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Do you consider yourself to have a disability, Impairment or long-term condition?<label>
				<p><input class="w3-radio" type="radio" name="stddisabi" value="Yes"  onclick="w3_showdisability()"  />
				<label>Yes</label></p>
				<p><input class="w3-radio" type="radio" name="stddisabi" value="No"  onclick="w3_hidedisability()"  />
				<label>No</label></p>
			</div>
			<div id="disabilityYes" style="display:none; margin-top:20px;" >
				<div class="w3-container w3-white w3-card-4 w3-padding-large">
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
						w3-animate-input"
						style="width:200px;"		
						name="stdotherdis"
						id="stdotherdis"/>
					</div>
				</div>
				<p style="margin-top:20px;">
				<label>Adjustment<label>
				<input type="text" class="w3-input w3-border 
				w3-animate-input "
				style="width:200px;"		
				name="stdadjustment"
				id="stdadjustment"/></p>
			</div>
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:98%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<h2>Education</h2>
			</header>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Highest Completed School Level<label>
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
			<p style="margin-top:20px;"><label>In which Year did you complete that level</label>
			<input type="number"class="w3-input w3-border w3-animate-input" 
			style="width:200px"	name="stdyearcomp" /></p>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Are you still attending secondary level?</label>
				<p><input class="w3-radio" type="radio" name="stdseclvl" value="Yes"  />
				<label>Yes</label></p>
				<p><input class="w3-radio" type="radio" name="stdseclvl" value="No"  />
				<label>No</label></p>
			</div>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Have you successfully completed any of the following qualification?<label>
				<p><input class="w3-radio" type="radio" name="stdsuccessqual" value="Yes" onclick="w3_showqualcomp()"/>
				<label>Yes</label></p>
				<p><input class="w3-radio" type="radio" name="stdsuccessqual" value="No"  onclick="w3_hidequalcomp()" />
				<label>No</label></p>
			</div>
			<div id="qualsuccomp" class="w3-container w3-white w3-card-4 w3-padding-large"
			style="display:none; margin-top:20px;" >
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
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:98%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<h2>Reason for study</h2>
			</header>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Which best describes your reasons for enrolling in the qualification?<label>
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
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
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
				<p><input class="w3-radio" type="radio" name="hearaboutcou" checked value="Website" onclick="w3_showwebsite()"  />
				<label>Website</label></p>
				<p><input class="w3-radio" type="radio" name="hearaboutcou" value="Other"  
				onclick="w3_showotherhear()"/>
				<label>Other</label></p>
				<input type="text"
				class="w3-input w3-border w3-animate-input w3-light-grey" style="width:200px; Display:none;"		
				name="otherhear"
				id="otherhear" />
			</div>
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:98%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<h2>Current Employment Status</h2>
			</header>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
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
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Registered for unemployment benefits with centrelink</label>
				<p><input class="w3-radio" type="radio" name="stdbencen" value="Yes" />
				<label>Yes</label></p>
				<p><input class="w3-radio" type="radio" name="stdbencen" value="No"  />
				<label>No</label></p>
			</div>
		</div>
		
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:98%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<h2>Employer Details</h2>
			</header>
			<p style="margin-top:20px;">
			<label>Company Name</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empcomname" /></p>
			<p style="margin-top:20px;">
			<label>Contact Name</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empcntname" /></p>
			<p style="margin-top:20px;">
			<label>Address</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empaddr" /></p>
			<p style="margin-top:20px;">
			<label>Suburb</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empsuburb" /></p>
			<p style="margin-top:20px;">
			<label>Phone</label><input type="number" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empphone" /></p>
			<p style="margin-top:20px;">
			<label>Email</label><input type="email" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empemail" /></p>
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:98%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<h2>Apprenticeships and Traineeships</h2>
			</header>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Part of apprenticeships and traineeships</label>
				<p><input class="w3-radio" type="radio" name="apprentrain" value="Yes"  />
				<label>Yes</label></p>
				<p><input class="w3-radio" type="radio" name="apprentrain" value="No"  />
				<label>No</label></p>
			</div>
			<p style="margin-top:20px;">
			<label>Start Date</label><input type="date" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="strdateemp" /></p>
			<p style="margin-top:20px;">
			<label>Job Title</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="empjobtitle" /></p>
			<p style="margin-top:20px;">
			<label>Hours per week</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="emphrperweek" /></p>
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:98%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<h2>Recognition of Prior Learning/Credit</h2>
			</header>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>RPL or credit transfer</label>
				<p><input class="w3-radio" type="radio" name="recgprlrcr" value="Yes"  />
				<label>Yes</label></p>
				<p><input class="w3-radio" type="radio" name="recgprlrcr" value="No"  />
				<label>No</label></p>
			</div>
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:98%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<h2>Jobseekers Seeking Concession</h2>
			</header>
			<p style="margin-top:20px;">
			<label>Job Search Agency</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="jobsrchagen" /></p>
			<p style="margin-top:20px;">
			<label>Employment Co-ordinator's Name</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="emocorname" /></p>
			<p style="margin-top:20px;">
			<label>Suburb</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="jobskrsuburb" /></p>
			<p style="margin-top:20px;">
			<label>Landline</label><input type="number" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="jobskrlandline" /></p>
			<p style="margin-top:20px;">
			<label>Mobile</label><input type="number" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="jobskrmobile" /></p>
			<p style="margin-top:20px;">
			<label>Start Date</label><input type="date" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="jobskremail" /></p>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>JSA Client Group</label>
				<p><input class="w3-radio" type="radio" name="jbaclient" value="Youth at risk"   />
				<label>Youth at risk</label></p>
				<p><input class="w3-radio" type="radio" name="jbaclient" value="CALD"  />
				<label>CALD</label></p>
				<p><input class="w3-radio" type="radio" name="jbaclient" value="Carer/Parent"  />
				<label>Carer/Parent</label></p>
			</div>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Job Search Agency Fees</label>
				<p><input class="w3-radio" type="radio" name="jbsrcagencypart" value="Yes"
				onclick="w3_showcoursefee()"/>
				<label>Yes</label></p>
				<p><input class="w3-radio" type="radio" name="jbsrcagencypart" value="No" 
				onclick="w3_hidecoursefee()" />
				<label>No</label></p>
			</div>
		</div>
		
		<div id="coursefee" class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:98%; margin-top:20px; display:none;">
			<header class="w3-container w3-blueh w3-tea">
				<h2>Course Fee</h2>
			</header>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
				style="margin-top:20px;">
				<label>Payment Type</label>
				<p><input class="w3-radio" type="radio" name="paymenttype" value="Student - Full Payment"
				/>
				<label>Student - Full Payment</label></p>
				<p><input class="w3-radio" type="radio" name="paymenttype" value="Third Party - Full Payment"  />
				<label>Third Party - Full Payment</label></p>
			</div>
			<p style="margin-top:20px;">
			<label>Student Name</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="stdnamefee" /></p>
			<p style="margin-top:20px;">
			<label>Third Party Representative Name</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="thrdpartrep" /></p>
			<p style="margin-top:20px;">
			<label>Third, the invoice is to be made out to</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="thrdparinv" /></p>
		</div>
		
		<div id="creditcard" class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:98%; margin-top:20px; display:none;">
			<header class="w3-container w3-blueh w3-tea">
				<h2>Credit Card</h2>
			</header>
			<p style="margin-top:20px;">
			<label>Card Type</label><input type="text" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="crdtype" /></p>
			<p style="margin-top:20px;">
			<label>Card Number</label><input type="number" 
			class="w3-input w3-border w3-animate-input "
			style="width:200px"		
			name="crdnum" /></p>
		</div>
		
		<div class="w3-container w3-greyb w3-card-4 w3-padding-large"
			style="width:98%; margin-top:20px;">
			<header class="w3-container w3-blueh w3-tea">
				<h2>Centrelink Details</h2>
			</header>
			<div class="w3-container w3-white w3-card-4 w3-padding-large"
			style="margin-top:20px;">
				<label>Registred Centrelink Allowances</label>
				<p><input class="w3-radio" type="radio" name="regcenallow" 
				value="Yes" onclick="w3_showreg()" />
				<label>Yes</label></p>
				<p><input class="w3-radio" type="radio" name="regcenallow" 
				value="No" onclick="w3_hidereg()" />
				<label>No</label></p>
			</div>
			<div id="regiscentre" style="margin-top:20px; display:none;">
				<div class="w3-container w3-white w3-card-4 w3-padding-large">
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
				<p style="margin-top:20px;">
				<label>Reference Number</label><input type="number" 
				class="w3-input w3-border w3-animate-input "
				style="width:200px"		
				name="refnum" /></p>
				<p style="margin-top:20px;">
				<label>VET Number</label><input type="number" 
				class="w3-input w3-border w3-animate-input "
				style="width:200px"		
				name="vetnum" /></p>
			</div>
		</div>
		
		<div class="w3-container w3-white w3-padding-large"
			style="width:98%; margin-top:20px;">
			<button type="submit" name="submitsave" 
			class="w3-blueh w3-hover-green w3-padding-large
			w3-border w3-large"
			style="float:right;">Save</button>
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
</script>