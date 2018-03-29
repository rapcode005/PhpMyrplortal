<?php
	include_once '../../data/dbh.php';
	
	if (isset($_POST['submitsave'])) {
		
		
		//Personal
		//personaldt();
		reastud();

	}
	
	function personaldt() {
		$stfname = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdfname']);
		$stgname = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdgname']);
		$stpname = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdpname']);
		$stbth = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdbth']);
		$stage = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdage']);
		$course = mysqli_real_escape_string($GLOBALS['conn'],$_POST['optcourse']);
		
		$sql = "SELECT IFNULL(max(id),0) as maxid FROM personaldt";
		$result = mysqli_query($GLOBALS['conn'],$sql);
		
		if ($row = mysqli_fetch_assoc($result)) {
			$GLOBALS['maxidper'] = $row['maxid'];
		}
		
		$GLOBALS['maxidper'] += 1;
		
		$insert = "INSERT INTO personaldt(fname,gname,pname,brhday,age)
		VALUES('$stfname','$stgname','$stpname','$stbth','$stage');";
		
		if(mysqli_query($GLOBALS['conn'],$insert)){
			//Insert into studentinfo table
			$insertstd = "INSERT INTO studentinfo(stdcode)
			VALUES('".$GLOBALS['maxidper']."')";
			residence();
		}
	}
	
	function residence() {
		$stdbuildr = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdbuildr']);
		$stdflastr = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdflastr']);
		$stdstrnumr = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdstrnumr']);
		$stdsltr = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdsltr']);
		$stdstater = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdstater']);
		$stdptlr = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdptlr']);
		
		$sql = "SELECT IFNULL(max(id),0) as maxid FROM residence";
		$result = mysqli_query($GLOBALS['conn'],$sql);
		
		if ($row = mysqli_fetch_assoc($result)) {
			$GLOBALS['maxidre'] = $row['maxid'];
		}
		
		$GLOBALS['maxidre'] += 1;
		
		$insert = "INSERT INTO residence(building,flat,street,suburb,state,postalcode)
		VALUES('$stdbuildr','$stdflastr','$stdstrnumr','$stdsltr',
		'$stdstater','$stdptlr');";
		
		if(mysqli_query($GLOBALS['conn'],$insert)) {
			postaladd();
		}
	}
	
	function postaladd() {
		$stdbuildp = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdbuildp']);
		$stdflastp = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdflastp']);
		$stdstrnump= mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdstrnump']);
		$stdsltp = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdsltp']);
		$stdstatep = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdstatep']);
		$stdptlp = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdptlp']);
		
		$sql = "SELECT IFNULL(max(id),0) as maxid FROM postaladdress";
		$result = mysqli_query($GLOBALS['conn'],$sql);
		
		if ($row = mysqli_fetch_assoc($result)) {
			$GLOBALS['maxidpa'] = $row['maxid'];
		}
		
		$GLOBALS['maxidpa'] += 1;
		
		$insert = "INSERT INTO postaladdress(building,flat,street,suburb,state,postalcode)
		VALUES('$stdbuildp','$stdflastp','$stdstrnump','$stdsltp','$stdstatep','$stdptlp');";
		
		if(mysqli_query($GLOBALS['conn'],$insert)) {
			phonecontact();
		}
	}
	
	function phonecontact() {
		$stdhome = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdhome']);
		$stdwork = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdwork']);
		$stdmobile = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdmobile']);
		$stdemail = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdemail']);
		
		$sql = "SELECT IFNULL(max(id),0) as maxid FROM phonecontact";
		$result = mysqli_query($GLOBALS['conn'],$sql);
		
		if ($row = mysqli_fetch_assoc($result)) {
			$GLOBALS['maxidpc'] = $row['maxid'];
		}
		
		$GLOBALS['maxidpc'] += 1;
		
		$insert = "INSERT INTO phonecontact(homeph,workph,mobile,email)
		VALUES('$stdhome','$stdwork','$stdmobile','$stdemail');";
		
		if(mysqli_query($GLOBALS['conn'],$insert)) {
			emergency();
		}
	}
	
	function emergency() {
		$stdhomee = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdhomee']);
		$stdworke = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdworke']);
		$stdmobilee = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdmobilee']);
		$stdemaile = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdemaile']);
		
		$sql = "SELECT IFNULL(max(id),0) as maxid FROM emergency";
		$result = mysqli_query($GLOBALS['conn'],$sql);
		
		if ($row = mysqli_fetch_assoc($result)) {
			$GLOBALS['maxide'] = $row['maxid'];
		}
		
		$GLOBALS['maxide'] += 1;
		
		$insert = "INSERT INTO emergency(homeph,workph,mobile,email)
		VALUES('$stdhomee','$stdworke','$stdmobilee','$stdemaile');";
		
		if(mysqli_query($GLOBALS['conn'],$insert)) {
			languages();
		}
	}
	
	function languages() {
		$stdlang = mysqli_real_escape_string($GLOBALS['conn'],$_POST['stdlang']);
		$stdstatep = mysqli_real_escape_string($GLOBALS['conn'],$_POST['stdstatep']);
		$stdrsttype = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdrsttype']);
		$stdvisatype= mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdvisatype']);
		$stdenghome = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdenghome']);
		$stdspecify = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdspecify']);
		$stdwelleng = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdwelleng']);
		$stdabotors = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdabotors']);
		
		$sql = "SELECT IFNULL(max(id),0) as maxid FROM languages";
		$result = mysqli_query($GLOBALS['conn'],$sql);
		
		if ($row = mysqli_fetch_assoc($result)) {
			$GLOBALS['maxidl'] = $row['maxid'];
		}
		
		$GLOBALS['maxidl'] += 1;
		
		$insert = "INSERT INTO languages(cntbrn,cntbrnother,rsdnttype,rsdnttypeother,
		languages,languagesother,engwell,abtor)
		VALUES('$stdlang','$stdstatep','$stdrsttype','$stdvisatype','$stdenghome',
		'$stdspecify','$stdwelleng','$stdabotors');";
		
		if(mysqli_query($GLOBALS['conn'],$insert)) {
			indlearnneeds();
		}
	}
	
	function indlearnneeds() {
		if ($_POST['stddisabi'] == "Yes") {
			$stddisabi = 1;
			$stdindicate = mysqli_real_escape_string($GLOBALS['conn'],$_POST['stdindicate']);
			$stdotherdis = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdotherdis']);
			$stdadjustment= mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdadjustment']);
		}
		elseif ($_POST['stddisabi'] == "No") {
			$stddisabi = 0;
			$stdindicate = "NULL";
			$stdotherdis = "NULL";
			$stdadjustment= "NULL";
		}
		
		$sql = "SELECT IFNULL(max(id),0) as maxid FROM indlearnneeds";
		$result = mysqli_query($GLOBALS['conn'],$sql);
		
		if ($row = mysqli_fetch_assoc($result)) {
			$GLOBALS['maxidin'] = $row['maxid'];
		}
		
		$GLOBALS['maxidin'] += 1;
		
		$insert = "INSERT INTO indlearnneeds(disabimpr,disyes,disother,disadjust)
		VALUES('$stddisabi','$stdindicate','$stdotherdis','$stdadjustment');";
		
		if(mysqli_query($GLOBALS['conn'],$insert)) {
			education();
		}
	}
	
	function education() {
		$stdhgcomschlvl = mysqli_real_escape_string($GLOBALS['conn'],$_POST['stdhgcomschlvl']);
		$stdyearcomp = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdyearcomp']);
		
		if ($_POST['stdseclvl'] == "Yes") {
			$stdseclvl = 1;
		}
		elseif ($_POST['stdseclvl'] == "No") {
			$stdseclvl = 0;
		}
		else {
			$stdseclvl = "NULL";
		}
		
		if ($_POST['stdsuccessqual'] == "Yes") {
			$stdsuccessqual = 1;
			$stdqualsuccomp = mysqli_real_escape_string($GLOBALS['conn'], 
			$_POST['stdqualsuccomp']);
		}
		elseif ($_POST['stdsuccessqual'] == "No") {
			$stdsuccessqual = 0;
			$stdqualsuccomp = "NULL";
		}
		else {
			$stdsuccessqual = "NULL";
			$stdqualsuccomp = "NULL";
		}
		
		$sql = "SELECT IFNULL(max(id),0) as maxid FROM education";
		$result = mysqli_query($GLOBALS['conn'],$sql);
		
		if ($row = mysqli_fetch_assoc($result)) {
			$GLOBALS['maxide'] = $row['maxid'];
		}
		
		$GLOBALS['maxide'] += 1;
		
		$insert = "INSERT INTO education(highschool,year,snd,success,successyes)
		VALUES('$stdhgcomschlvl','$stdyearcomp','$stdseclvl','$stdsuccessqual','$stdqualsuccomp');";
		
		if(mysqli_query($GLOBALS['conn'],$insert)) {
			reastud();
		}
	}
	
	function reastud() {
		$reasonqual = $_POST['reasonqual'];
		
		$otherreasonstate = mysqli_real_escape_string($GLOBALS['conn'],
		$_POST['otherreasonstate']);
		
		$hearaboutcou = mysqli_real_escape_string($GLOBALS['conn'],
		$_POST['hearaboutcou']);
		
		$advertisementwhe= mysqli_real_escape_string($GLOBALS['conn'],
		$_POST['advertisementwhe']);
		
		$wordofmout = mysqli_real_escape_string($GLOBALS['conn'],
		$_POST['wordofmout']);
		
		$otherhear = mysqli_real_escape_string($GLOBALS['conn'],
		$_POST['otherhear']);
		
		if(!empty($advertisementwhe)) {
			$other = $advertisementwhe;
		}
		elseif (!empty($wordofmout)) {
			$other =$wordofmout;
		}
		elseif (!empty($otherhear)) {
			$other = $otherhear;
		}
		else {
			$other = "NULL";
		}
		
		$sql = "SELECT IFNULL(max(id),0) as maxid FROM reastud";
		$result = mysqli_query($GLOBALS['conn'],$sql);
		
		if ($row = mysqli_fetch_assoc($result)) {
			$GLOBALS['maxidrs'] = $row['maxid'];
		}
		
		$GLOBALS['maxidrs'] += 1;
		
		$insert = "INSERT INTO reastud(hearabout,other,hearaboutv) 
		VALUES('$hearaboutcou','$otherreasonstate','$other');";
		
		if(mysqli_query($GLOBALS['conn'],$insert)) {
			//Save List
			foreach($reasonqual as $val) {
				$inserts ="INSERT INTO reastudlist(descrp,reasid)
				VALUES('$val','".$GLOBALS['maxidrs']."');";
				mysqli_query($GLOBALS['conn'],$inserts);
			}
			curempstatus();
		}
	}
	
	function curempstatus() {
		$stdbencen = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdbencen']);
		if ($_POST['stdseclvl'] == "Yes") {
			$stdbencen = 1;
			curremp();
		}
		elseif ($_POST['stdseclvl'] == "No") {
			$stdbencen = 0;
			curremp();
		}
		else {
			$stdbencen = "NULL";
			employerdt();
		}
	}
	
	function curremp() {
		$sql = "SELECT IFNULL(max(id),0) as maxid FROM curempstatus";
		$result = mysqli_query($GLOBALS['conn'],$sql);
		
		if ($row = mysqli_fetch_assoc($result)) {
			$GLOBALS['maxidcs'] = $row['maxid'];
		}
		
		$GLOBALS['maxidcs'] += 1;
		
		$insert = "INSERT INTO curempstatus(hearabout,other) 
		VALUES('$hearaboutcou','$otherreasonstate');";
		
		if(mysqli_query($GLOBALS['conn'],$insert)) {
			employerdt();
		}
	}
	
	function employerdt() {
		$empcomname = mysqli_real_escape_string($GLOBALS['conn'], $_POST['empcomname']);
		$empcntname= mysqli_real_escape_string($GLOBALS['conn'], $_POST['empcntname']);
		$empaddr = mysqli_real_escape_string($GLOBALS['conn'], $_POST['empaddr']);
		$empsuburb = mysqli_real_escape_string($GLOBALS['conn'], $_POST['empsuburb']);
		$empphone = mysqli_real_escape_string($GLOBALS['conn'], $_POST['empphone']);
		$empemail = mysqli_real_escape_string($GLOBALS['conn'],$_POST['empemail']);
		
		$sql = "SELECT IFNULL(max(id),0) as maxid FROM employerdt";
		$result = mysqli_query($GLOBALS['conn'],$sql);
		
		if ($row = mysqli_fetch_assoc($result)) {
			$GLOBALS['maxidpedt'] = $row['maxid'];
		}
		
		$GLOBALS['maxidpedt'] += 1;
		
		$insert = "INSERT INTO employerdt(empcomname,empcntname,empaddress,
		empsub,emphone,empemail)
		VALUES('$empcomname','$empcntname','$empaddr','$empsuburb','$empphone'
		,'$empemail ');";
		
		if(mysqli_query($GLOBALS['conn'],$insert)){
			apprentrn();
		}
	}
	
	function apprentrn() {
		
		if(empty($_POST['apprentrain']) && empty($_POST['strdateemp']) &&
		empty($_POST['empjobtitle']) &&  empty($_POST['emphrperweek'])) {
			
			recogprior();
			
		}
		else {
			
			if ($_POST['apprentrain'] == "Yes") {
				$apprentrain = 1;
			}
			elseif ($_POST['apprentrain'] == "No") {
				$apprentrain = 0;
			}
			else {
				$apprentrain = "NULL";
			}
			
			$strdateemp = mysqli_real_escape_string($GLOBALS['conn'], $_POST['strdateemp']);
			$empjobtitle= mysqli_real_escape_string($GLOBALS['conn'], $_POST['empjobtitle']);
			$emphrperweek = mysqli_real_escape_string($GLOBALS['conn'], $_POST['emphrperweek']);
			
			$sql = "SELECT IFNULL(max(id),0) as maxid FROM apprentrn";
			$result = mysqli_query($GLOBALS['conn'],$sql);
		
			if ($row = mysqli_fetch_assoc($result)) {
				$GLOBALS['maxidpedt'] = $row['maxid'];
			}
			
			$GLOBALS['maxidpedt'] += 1;
			
			$insert = "INSERT INTO apprentrn(appres,appresdate,
			appretitle,hrsperweek)
			VALUES('$apprentrain','$strdateemp','$empjobtitle',
			,'$emphrperweek');";
			
			if(mysqli_query($GLOBALS['conn'],$insert)){
				recogprior();
			}
		}
	}
	
	function recogprior() {
		$recgprlrcr = mysqli_real_escape_string($GLOBALS['conn'], $_POST['recgprlrcr']);
		
		if (empty($recgprlrcr)) {
			jobseekers();
		}
		else {
			$sql = "SELECT IFNULL(max(id),0) as maxid FROM recogprior";
				$result = mysqli_query($GLOBALS['conn'],$sql);
			
			if ($row = mysqli_fetch_assoc($result)) {
				$GLOBALS['maxidrp'] = $row['maxid'];
			}
			
			$GLOBALS['maxidrp'] += 1;
			
			$insert = "INSERT INTO recogprior(recog)
			VALUES('$recgprlrcr');";
			
			if(mysqli_query($GLOBALS['conn'],$insert)){
				recogprior();
			}
		}
		
	}
	
	function jobseekers() {
		$jobsrchagen = mysqli_real_escape_string($GLOBALS['conn'], $_POST['jobsrchagen']);
		$emocorname= mysqli_real_escape_string($GLOBALS['conn'], $_POST['emocorname']);
		$jobskrsuburb = mysqli_real_escape_string($GLOBALS['conn'], $_POST['jobskrsuburb']);
		$jobskrlandline = mysqli_real_escape_string($GLOBALS['conn'], $_POST['jobskrlandline']);
		$jobskrmobile = mysqli_real_escape_string($GLOBALS['conn'], $_POST['jobskrmobile']);
		$jobskremail = mysqli_real_escape_string($GLOBALS['conn'],$_POST['jobskremail']);
		$jbaclient = mysqli_real_escape_string($GLOBALS['conn'],$_POST['jbaclient']);
		
		if ($_POST['jbsrcagencypart'] == "Yes") {
			$jbsrcagencypart = 1; 
		}
		elseif ($_POST['jbsrcagencypart'] == "No") {
			$jbsrcagencypart = 0;
		}
		else {
			$jbsrcagencypart=$_POST['jbsrcagencypart'];
		}
		
		//Check if all fields are empty
		if(empty($jobsrchagen) && empty($emocorname) && empty($jobskrsuburb)
			empty($jobskrlandline) && empty($jobskrmobile ) && empty($jobskremail )
		    && empty($jbaclient) && empty($jbsrcagencypart)) {
			centrelink();
		}
		else {
			$insert = "INSERT INTO jobseekers(jbseekagen,empcoorname,jobseeksur,
					landline,jobseeknobile,jobseekstrdte,jsaclient,jobsearchfee)
			VALUES('$jobsrchagen','$emocorname','$jobskrsuburb','$jobskrlandline',
			'$jobskrmobile','$jobskremail','$jbaclient','$jbsrcagencypart');";
			if(mysqli_query($GLOBALS['conn'],$insert)){
				if ($jbsrcagencypart == "Yes") {
					coursefee();
				}
				else {
					centrelink();
				}
			}
		}
	}
	
	function coursefee() {
		$paymenttype = mysqli_real_escape_string($GLOBALS['conn'], $_POST['paymenttype']);
		$stdnamefee= mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdnamefee']);
		$thrdpartrep = mysqli_real_escape_string($GLOBALS['conn'], $_POST['thrdpartrep']);
		$thrdparinv = mysqli_real_escape_string($GLOBALS['conn'], $_POST['thrdparinv']);
		$crdtype = mysqli_real_escape_string($GLOBALS['conn'], $_POST['crdtype']);
		$crdnum = mysqli_real_escape_string($GLOBALS['conn'], $_POST['crdnum']);
		if (empty($paymenttype) && empty($stdnamefee) && empty($thrdpartrep)
			empty($thrdparinv) && empty($crdtype) && empty($crdnum)) {
			centrelink();
		}
		else {
			$insert = "INSERT INTO coursefee(paytype,stdname,thrdrepname,
					thrdinvoice,crdtype,crdnum)
			VALUES('$paymenttype','$stdnamefee','$thrdpartrep','$thrdparinv'
			,'$crdtype','$crdnum');";
			if(mysqli_query($GLOBALS['conn'],$insert)){
				centrelink();
			}
		}
	}
	
	function centrelink() {
		if ($_POST['regcenallow'] == "Yes") {
			$regcenallow = 1; 
		}
		elseif ($_POST['regcenallow'] == "No") {
			$regcenallow= 0;
		}
		else {
			$regcenallow=$_POST['regcenallow'];
		}
		$allowyes = mysqli_real_escape_string($GLOBALS['conn'], $_POST['allowyes']);
		$refnum= mysqli_real_escape_string($GLOBALS['conn'], $_POST['refnum']);
		$vetnum= mysqli_real_escape_string($GLOBALS['conn'], $_POST['vetnum']);
		if (!empty($regcenallow ) && !empty($allowyes) && !empty($refnum)
			!empty($vetnum)) {
			$insert = "INSERT INTO centrelink(cntrallow,allowances,refnum,vetnum)
			VALUES('$regcenallow','$allowyes','$refnum','$vetnum');";
			mysqli_query($GLOBALS['conn'],$insert){
		}
	}
	
	
?>