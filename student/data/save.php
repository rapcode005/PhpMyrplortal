<?php
	include_once '../../data/dbh.php';
	session_start();
	if (isset($_POST['submitsave'])) {
		
		include_once '../../link/code/fpdf.php';
		//Personal
		personaldt();
		CreatePDF();
		$linkid = urlencode(base64_encode($GLOBALS['stdnum']));
		$linkfn = urlencode(base64_encode($_POST['stdfname']));
		$linkgn = urlencode(base64_encode($_POST['stdgname']));
		$querystr = "h=ev";
		header("Location: ../evidence.php?".$querystr);
		ob_end_flush();
	}
	
	function personaldt() {
		$stfname = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdfname']);
		$stgname = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdgname']);
		$stpname = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdpname']);
		$stbth = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdbth']);
		$stage = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdage']);
		$course = mysqli_real_escape_string($GLOBALS['conn'],$_POST['optcourse']);
		$stdcode = mysqli_real_escape_string($GLOBALS['conn'],$_POST['stdcode']);
				
		$sql = "SELECT IFNULL(max(id),0) as maxid FROM personaldt;";
		$result = mysqli_query($GLOBALS['conn'],$sql);
		
		if ($row = mysqli_fetch_assoc($result)) {
			$GLOBALS['stdnum']  = $row['maxid'];
		}
		
		$GLOBALS['stdnum'] += 1;
		
		$insert = "INSERT INTO personaldt(fname,gname,pname,brhday,age,code)
		VALUES('$stfname','$stgname','$stpname','$stbth','$stage','".$stdcode."');";
		
		if(mysqli_query($GLOBALS['conn'],$insert)){
			//Insert into studentinfo table
			$insertstd = "INSERT INTO studentinfo(stdcode,stdcourse,userid)
			VALUES('".$GLOBALS['stdnum']."','".$course."',".
			$_SESSION['u_id'].");";
			mysqli_query($GLOBALS['conn'],$insertstd);
			
			//Save studid, familyname, givenname, studcode
			$sql = "SELECT IFNULL(max(id),0) as maxid FROM studentinfo;";
			$result = mysqli_query($GLOBALS['conn'],$sql);
			
			if ($row = mysqli_fetch_assoc($result)) {
				$_SESSION['stdid']  = $row['maxid'];
			}
			
			$_SESSION['stdcode'] = $stdcode;
			$_SESSION['stdfname'] = $stfname;
			$_SESSION['stdgname'] = $stgname;
			
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
	
				
		$insert = "INSERT INTO residence(building,flat,street,suburb,state,postalcode)
		VALUES('$stdbuildr','$stdflastr','$stdstrnumr','$stdsltr',
		'$stdstater','$stdptlr');";
		
		if(mysqli_query($GLOBALS['conn'],$insert)) {
			
			$sql = "SELECT IFNULL(max(id),0) as maxid FROM residence;";
			$result = mysqli_query($GLOBALS['conn'],$sql);
			
			if ($row = mysqli_fetch_assoc($result)) {
				$num = $row['maxid'];
			}
				
			$insertstd = "Update studentinfo set rid = ".$num.
			" where stdcode=".$GLOBALS['stdnum'].";";
			mysqli_query($GLOBALS['conn'],$insertstd);
			postaladd();
		}
	}
	
	function postaladd() {
		$stdbuildp = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdbuildp']);
		$stdflastp = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdflastp']);
		$stdstrnump= mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdstrnump']);
		$stdsltp = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdsltp']);
		$statept = mysqli_real_escape_string($GLOBALS['conn'], $_POST['statept']);
		$stdptlp = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdptlp']);
		
		$sql = "SELECT IFNULL(max(id),0) as maxid FROM postaladdress;";
		$result = mysqli_query($GLOBALS['conn'],$sql);
		
		if ($row = mysqli_fetch_assoc($result)) {
			$num  = $row['maxid'];
		}
		
		$num  += 1;
		
		$insert = "INSERT INTO postaladdress(building,flat,street,suburb,state,postalcode)
		VALUES('$stdbuildp','$stdflastp','$stdstrnump','$stdsltp','$statept','$stdptlp');";
		
		if(mysqli_query($GLOBALS['conn'],$insert)) {
			$insertstd = "Update studentinfo set paddid = ".$num.
			" where stdcode=".$GLOBALS['stdnum'].";";
			mysqli_query($GLOBALS['conn'],$insertstd);
			phonecontact();
		}
	}
	
	function phonecontact() {
		$stdhome = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdhome']);
		$stdwork = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdwork']);
		$stdmobile = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdmobile']);
		$stdemail = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdemail']);
		
		$sql = "SELECT IFNULL(max(id),0) as maxid FROM phonecontact;";
		$result = mysqli_query($GLOBALS['conn'],$sql);
		
		if ($row = mysqli_fetch_assoc($result)) {
			$num = $row['maxid'];
		}
		
		$num += 1;
		
		$insert = "INSERT INTO phonecontact(homeph,workph,mobile,email)
		VALUES('$stdhome','$stdwork','$stdmobile','$stdemail');";
		
		if(mysqli_query($GLOBALS['conn'],$insert)) {
			$insertstd = "Update studentinfo set phocnt = ".$num.
			" where stdcode=".$GLOBALS['stdnum'].";";
			mysqli_query($GLOBALS['conn'],$insertstd);
			emergency();
		}
	}
	
	function emergency() {
		$stdhomee = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdhomee']);
		$stdworke = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdworke']);
		$stdmobilee = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdmobilee']);
		$stdemaile = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdemaile']);
		
		$sql = "SELECT IFNULL(max(id),0) as maxid FROM emergency;";
		$result = mysqli_query($GLOBALS['conn'],$sql);
		
		if ($row = mysqli_fetch_assoc($result)) {
			$num = $row['maxid'];
		}
		
		$num += 1;
		
		$insert = "INSERT INTO emergency(homeph,workph,mobile,email)
		VALUES('$stdhomee','$stdworke','$stdmobilee','$stdemaile');";
		
		if(mysqli_query($GLOBALS['conn'],$insert)) {
			$insertstd = "Update studentinfo set emerid = ".$num.
			" where stdcode=".$GLOBALS['stdnum'].";";
			mysqli_query($GLOBALS['conn'],$insertstd);
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
		
		$sql = "SELECT IFNULL(max(id),0) as maxid FROM languages;";
		$result = mysqli_query($GLOBALS['conn'],$sql);
		
		if ($row = mysqli_fetch_assoc($result)) {
			$num = $row['maxid'];
		}
		
		$num += 1;
		
		$insert = "INSERT INTO languages(cntbrn,cntbrnother,rsdnttype,rsdnttypeother,
		languages,languagesother,engwell,abtor)
		VALUES('$stdlang','$stdstatep','$stdrsttype','$stdvisatype','$stdenghome',
		'$stdspecify','$stdwelleng','$stdabotors');";
		
		if(mysqli_query($GLOBALS['conn'],$insert)) {
			$insertstd = "Update studentinfo set langid = ".$num.
			" where stdcode=".$GLOBALS['stdnum'].";";
			mysqli_query($GLOBALS['conn'],$insertstd);
			indlearnneeds();
		}
	}
	
	function indlearnneeds() {
		if(isset($_POST['stddisabi'])) {
			if ($_POST['stddisabi'] == "Yes") {
				$stddisabi = 1;
				$stdindicate = mysqli_real_escape_string($GLOBALS['conn'],$_POST['stdindicate']);
				$stdotherdis = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdotherdis']);
				$stdadjustment= mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdadjustment']);
				
				$sql = "SELECT IFNULL(max(id),0) as maxid FROM indlearnneeds;";
				$result = mysqli_query($GLOBALS['conn'],$sql);
				
				if ($row = mysqli_fetch_assoc($result)) {
					$num = $row['maxid'];
				}
				
				$num += 1;
				
				$insert = "INSERT INTO indlearnneeds(disabimpr,disyes,disother,disadjust)
				VALUES('$stddisabi','$stdindicate','$stdotherdis','$stdadjustment');";
				
				if(mysqli_query($GLOBALS['conn'],$insert)) {
					$insertstd = "Update studentinfo set indlearid = ".$num.
					" where stdcode=".$GLOBALS['stdnum'].";";
					mysqli_query($GLOBALS['conn'],$insertstd);
					education();
				}
				
			}
			elseif ($_POST['stddisabi'] == "No") {
				$stddisabi = 0;
				
				$sql = "SELECT IFNULL(max(id),0) as maxid FROM indlearnneeds;";
				$result = mysqli_query($GLOBALS['conn'],$sql);
				
				if ($row = mysqli_fetch_assoc($result)) {
					$num = $row['maxid'];
				}
				
				$num += 1;
				
				$insert = "INSERT INTO indlearnneeds(disabimpr)
				VALUES('".$stddisabi."');";
				
				if(mysqli_query($GLOBALS['conn'],$insert)) {
					$insertstd = "Update studentinfo set indlearid = ".$num.
					" where stdcode=".$GLOBALS['stdnum'].";";
					mysqli_query($GLOBALS['conn'],$insertstd);
					education();
				}
			}
			else {
				education();
			}
		}
		education();
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
			$_POST['scsscomp']);
		}
		elseif ($_POST['stdsuccessqual'] == "No") {
			$stdsuccessqual = 0;
			$stdqualsuccomp = "";
		}
		else {
			$stdsuccessqual = "NULL";
			$stdqualsuccomp = "";
		}
		
		if (empty($stdyearcomp))
			$stdyearcomp  = "NULL";
		
		//Check if empty
		if (empty($stdhgcomschlvl) && $stdyearcomp == "NULL" && 
		$stdsuccessqual == "NULL" && $stdqualsuccomp == "" && 
		$stdseclvl == "NULL") {
			reastud();
		}
		else {
			$sql = "SELECT IFNULL(max(id),0) as maxid FROM education;";
			$result = mysqli_query($GLOBALS['conn'],$sql);
			
			if ($row = mysqli_fetch_assoc($result)) {
				$num = $row['maxid'];
			}
			
			$num += 1;
			
			$insert = "INSERT INTO education(highschool,year,snd,success,successyes)
			VALUES('".$stdhgcomschlvl."',".$stdyearcomp.",".$stdseclvl.",".$stdsuccessqual.",'".$stdqualsuccomp."');";
			
			if(mysqli_query($GLOBALS['conn'],$insert)) {
				$insertstd = "Update studentinfo set educaid = ".$num.
				" where stdcode=".$GLOBALS['stdnum'].";";
				mysqli_query($GLOBALS['conn'],$insertstd);
			}
			reastud();
		}
		
		
	}
	
	function reastud() {
		
		if(isset($_POST['reasonqual']))
			$reasonqual = $_POST['reasonqual'];
		else
			$reasonqual = array();
		
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
			$other = "";
		}
		
		if (empty($hearaboutcou) && empty($otherreasonstate)
			&& empty($other) && $reasonqual == array()) {
			curempstatus();
		}
		else {
			$sql = "SELECT IFNULL(max(id),0) as maxid FROM reastud;";
			$result = mysqli_query($GLOBALS['conn'],$sql);
			
			if ($row = mysqli_fetch_assoc($result)) {
				$num = $row['maxid'];
			}
			
			$num += 1;
			
			$insert = "INSERT INTO reastud(hearabout,other,hearaboutv) 
			VALUES('".$hearaboutcou."','".$otherreasonstate."','".$other."');";
			
			if(mysqli_query($GLOBALS['conn'],$insert)) {
				//Save List
				foreach($reasonqual as $val) {
					$inserts ="INSERT INTO reastudlist(descrp,reasid)
					VALUES('".$val."','".$num."');";
					mysqli_query($GLOBALS['conn'],$inserts);
				}
				$insertstd = "Update studentinfo set reastudid = ".$num.
				" where stdcode=".$GLOBALS['stdnum'].";";
				mysqli_query($GLOBALS['conn'],$insertstd);
			}
			curempstatus();
		}
	}
	
	function curempstatus() {
		if (isset($_POST['stdcurempsts'])) {
			$stdcurempsts = mysqli_real_escape_string($GLOBALS['conn'], 
			$_POST['stdcurempsts']);
		}
		else {
			$stdcurempsts = "NULL";
		}
		
		if (isset($_POST['stdbencen'])) {
			if ($_POST['stdbencen'] == "Yes") {
				$stdbencen = 1;
			}
			elseif ($_POST['stdbencen'] == "No") {
				$stdbencen = 0;
			}
			else {
				$stdbencen = "NULL";
			}
		}
		else {
			$stdbencen = "NULL";
		}
		
		if($stdcurempsts == "NULL" && $stdbencen == "NULL") {
			employerdt();
		}
		else {
			$insert = "INSERT INTO curempstatus(empstatus,regs) 
			VALUES('".$stdcurempsts."','".$stdbencen."');";
			
			if(mysqli_query($GLOBALS['conn'],$insert)) {
				//Add to studentinfo table
				$sql = "SELECT IFNULL(max(id),0) as maxid FROM curempstatus;";
				$result = mysqli_query($GLOBALS['conn'],$sql);
				
				if ($row = mysqli_fetch_assoc($result)) {
					$num = $row['maxid'];
				}

				
				$insertstd = "Update studentinfo set curempid = ".$num.
				" where stdcode=".$GLOBALS['stdnum'].";";
				mysqli_query($GLOBALS['conn'],$insertstd);
				
				employerdt();
			}
		}
		
	}
	
	function employerdt() {
		$empcomname = mysqli_real_escape_string($GLOBALS['conn'], $_POST['empcomname']);
		$empcntname= mysqli_real_escape_string($GLOBALS['conn'], $_POST['empcntname']);
		$empaddr = mysqli_real_escape_string($GLOBALS['conn'], $_POST['empaddr']);
		$empsuburb = mysqli_real_escape_string($GLOBALS['conn'], $_POST['empsuburb']);
		$empphone = mysqli_real_escape_string($GLOBALS['conn'], $_POST['empphone']);
		$empemail = mysqli_real_escape_string($GLOBALS['conn'],$_POST['empemail']);
		
		if (empty($empcomname) && empty($empcntname) && empty($empaddr) &&
		empty($empsuburb) && empty($empphone) && empty($empemail)) {
			apprentrn();
		}
		else {
			$insert = "INSERT INTO employerdt(empcomname,empcntname,empaddress,
			empsub,emphone,empemail)
			VALUES('".$empcomname."','".$empcntname."','".$empaddr."','".$empsuburb."','".$empphone."'
			,'".$empemail."');";
			
			if(mysqli_query($GLOBALS['conn'],$insert)){
				//Add to studentinfo table
				$sql = "SELECT IFNULL(max(id),0) as maxid FROM employerdt;";
				$result = mysqli_query($GLOBALS['conn'],$sql);
				
				if ($row = mysqli_fetch_assoc($result)) {
					$num = $row['maxid'];
				}
				
				
				$insertstd = "Update studentinfo set empid = ".$num.
				" where stdcode=".$GLOBALS['stdnum'].";";
				mysqli_query($GLOBALS['conn'],$insertstd);
				
				apprentrn();
			}
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
			
			$sql = "SELECT IFNULL(max(id),0) as maxid FROM apprentrn;";
			$result = mysqli_query($GLOBALS['conn'],$sql);
		
			if ($row = mysqli_fetch_assoc($result)) {
				$num = $row['maxid'];
			}
			
			$num += 1;
			
			$insert = "INSERT INTO apprentrn(appres,appresdate,
			appretitle,hrsperweek)
			VALUES('".$apprentrain."','".$strdateemp."','".$empjobtitle."'
			,'".$emphrperweek."');";
			
			if(mysqli_query($GLOBALS['conn'],$insert)){
				//Add to studentinfo table
				$insertstd = "Update studentinfo set appid = ".$num.
				" where stdcode=".$GLOBALS['stdnum'].";";
				mysqli_query($GLOBALS['conn'],$insertstd);
				recogprior();
			}
			
		}
	}
	
	function recogprior() {
		if (isset($_POST['recgprlrcr'])) {
			
			if ($_POST['recgprlrcr'] == "Yes") {
				$recgprlrcr = 1;
			}
			elseif ($_POST['recgprlrcr'] == "No") {
				$recgprlrcr = 0;
			}
			else {
				$recgprlrcr = "NULL";
			}
			
			$insert = "INSERT INTO recogprior(recog)
			VALUES('".$recgprlrcr."');";
			
			if(mysqli_query($GLOBALS['conn'],$insert)){
				//Add to studentinfo table
				$sql = "SELECT IFNULL(max(id),0) as maxid FROM recogprior;";
				$result = mysqli_query($GLOBALS['conn'],$sql);
			
				if ($row = mysqli_fetch_assoc($result)) {
					$num = $row['maxid'];
				}
				
				$insertstd = "Update studentinfo set recogid = ".$num.
				" where stdcode=".$GLOBALS['stdnum'].";";
				mysqli_query($GLOBALS['conn'],$insertstd);
				
				jobseekers();
			}
		}
		else {
			jobseekers();
		}
				
	}
	
	function jobseekers() {
		$jobsrchagen = mysqli_real_escape_string($GLOBALS['conn'], $_POST['jobsrchagen']);
		$emocorname= mysqli_real_escape_string($GLOBALS['conn'], $_POST['emocorname']);
		$jobskrsuburb = mysqli_real_escape_string($GLOBALS['conn'], $_POST['jobskrsuburb']);
		$jobskrlandline = mysqli_real_escape_string($GLOBALS['conn'], $_POST['jobskrlandline']);
		$jobskrmobile = mysqli_real_escape_string($GLOBALS['conn'], $_POST['jobskrmobile']);
		$jobskremail = mysqli_real_escape_string($GLOBALS['conn'],$_POST['jobskremail']);
		
		if (isset($_POST['jbaclient'])) {
			$jbaclient = mysqli_real_escape_string($GLOBALS['conn'],$_POST['jbaclient']);
		}
		else {
			$jbaclient = "NULL";
		}
		
		if (isset($_POST['jbsrcagencypart'])) {
			if ($_POST['jbsrcagencypart'] == "Yes") {
				$jbsrcagencypart = 1; 
			}
			elseif ($_POST['jbsrcagencypart'] == "No") {
				$jbsrcagencypart = 0;
			}
			else {
				$jbsrcagencypart = "NULL";
			}
		}
		else {
			$jbsrcagencypart = "NULL";
		}
		
		//Check if all fields are empty
		if(empty($jobsrchagen) && empty($emocorname) && empty($jobskrsuburb) &&
			empty($jobskrlandline) && empty($jobskrmobile) && empty($jobskremail)
		    && ($jbaclient == "NULL") && ($jbsrcagencypart == "NULL")) {
			centrelink();
		}
		else {
			$insert = "INSERT INTO jobseekers(jbseekagen,empcoorname,jobseeksur,
					landline,jobseeknobile,jobseekstrdte,jsaclient,jobsearchfee)
			VALUES('".$jobsrchagen."','".$emocorname."','".$jobskrsuburb."','".$jobskrlandline."',
			'".$jobskrmobile."','".$jobskremail."','".$jbaclient."','".$jbsrcagencypart."');";
			
			if(mysqli_query($GLOBALS['conn'],$insert)){
				//Add to studentinfo table
				$sql = "SELECT IFNULL(max(id),0) as maxid FROM jobseekers;";
				$result = mysqli_query($GLOBALS['conn'],$sql);
			
				if ($row = mysqli_fetch_assoc($result)) {
					$num = $row['maxid'];
				}
				
				$insertstd = "Update studentinfo set jobid = ".$num.
				" where stdcode=".$GLOBALS['stdnum'].";";
				mysqli_query($GLOBALS['conn'],$insertstd);
				
				if ($jbsrcagencypart == 1) {
					coursefee();
				}
				else {
					centrelink();
				}
			}
		}
	}
	
	function coursefee() {
		if (isset($_POST['paymenttype'])) {
			$paymenttype = mysqli_real_escape_string($GLOBALS['conn'], $_POST['paymenttype']);
			$stdnamefee= mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdnamefee']);
			$thrdpartrep = mysqli_real_escape_string($GLOBALS['conn'], $_POST['thrdpartrep']);
			$thrdparinv = mysqli_real_escape_string($GLOBALS['conn'], $_POST['thrdparinv']);
			$crdtype = mysqli_real_escape_string($GLOBALS['conn'], $_POST['crdtype']);
			$crdnum = mysqli_real_escape_string($GLOBALS['conn'], $_POST['crdnum']);
		
			if ($paymenttype == "NULL" && empty($stdnamefee) && empty($thrdpartrep) &&
				empty($thrdparinv) && empty($crdtype) && empty($crdnum)) {
				centrelink();
			}
			else {
				$insert = "INSERT INTO coursefee(paytype,stdname,thrdrepname,
						thrdinvoice,crdtype,crdnum)
				VALUES('".$paymenttype."','".$stdnamefee."','".$thrdpartrep."','".$thrdparinv."'
				,'".$crdtype."','".$crdnum."');";
				if(mysqli_query($GLOBALS['conn'],$insert)){
					//Add to studentinfo table
					$sql = "SELECT IFNULL(max(id),0) as maxid FROM coursefee;";
					$result = mysqli_query($GLOBALS['conn'],$sql);
				
					if ($row = mysqli_fetch_assoc($result)) {
						$num = $row['maxid'];
					}
					
					$insertstd = "Update studentinfo set courseid = ".$num.
					" where stdcode=".$GLOBALS['stdnum'].";";
					mysqli_query($GLOBALS['conn'],$insertstd);
					
					centrelink();
				}
			}
		}
		else {
			$paymenttype = "NULL";
			centrelink();
		}
	}
	
	
	
	function centrelink() {
		if (isset($_POST['regcenallow'])) { 
			if ($_POST['regcenallow'] == "Yes") {
				$regcenallow = 1; 
			}
			elseif ($_POST['regcenallow'] == "No") {
				$regcenallow= 0;
			}
			else {
				$regcenallow="NULL";
			}
		}
		else {
			$regcenallow="NULL";
		}
		
		if(isset($_POST['allowyes'])) {
			$allowyes = mysqli_real_escape_string($GLOBALS['conn'], $_POST['allowyes']);
		}
		else {
			$allowyes = "NULL";
		}
		
		$refnum= mysqli_real_escape_string($GLOBALS['conn'], $_POST['refnum']);
		$vetnum= mysqli_real_escape_string($GLOBALS['conn'], $_POST['vetnum']);
		
		if ($regcenallow == "NULL" && $allowyes == "NULL" && empty($refnum) ||
			empty($vetnum)) {
		}
		else {
			$insert = "INSERT INTO centrelink(cntrallow,allowances,refnum,vetnum)
			VALUES('".$regcenallow."','".$allowyes."','".$refnum."','".$vetnum."');";
			mysqli_query($GLOBALS['conn'],$insert);
			
			//Add to studentinfo table
			$sql = "SELECT IFNULL(max(id),0) as maxid FROM centrelink;";
			$result = mysqli_query($GLOBALS['conn'],$sql);
		
			if ($row = mysqli_fetch_assoc($result)) {
				$num = $row['maxid'];
			}
			
			$insertstd = "Update studentinfo set centid = ".$num.
			" where stdcode=".$GLOBALS['stdnum'].";";
			mysqli_query($GLOBALS['conn'],$insertstd);
		}
	}
	
	function CheckforGET($title) {
		if (!empty($_POST[$title])) {
			return $_POST[$title];
		}
		else {
			return "";
		}
	}
	
	function CheckforOther($title,$otherword,$other) {
		if ($title != $otherword) {
			return $title;
		}
		else {
			return $other;
		}
	}
	
	function CreatePDF() {
		
		class PDF extends FPDF {
			// Page header
			function Header()
			{
				// Arial bold 15
				$this->SetFont('Arial','B',15);
				// Move to the right
				$this->Cell(72);
				// Title
				$this->Cell(50,10,'Application Form',1,0,'C');
				// Line break
				$this->Ln(20);
			}
			
			function Headertitle($title)
			{
				// Arial bold 15
				$this->SetFont('Arial','B',12);
				// Title
				$this->Cell(30,6,$title,0);
				// Line break
				$this->Ln();
			}
			
			// Page footer
			function Footer()
			{
				// Position at 1.5 cm from bottom
				$this->SetY(-15);
				// Arial italic 8
				$this->SetFont('Arial','I',8);
				// Page number
				$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
			}
			
			// Simple Alignment
			function Alignment($title,$value) {
				$this->SetFont('Arial','',10);
				$this->Cell(80,6,$title,0);
				$this->Cell(80,6,$value,0); 
				$this->Ln();
			}
		}

		//File Location
		$foldername = $_SESSION['stdfname'].$_SESSION['stdgname'].$_SESSION['stdid'];
		$folder = "../../appformstudent/".$foldername."/";
		
		if (!file_exists($folder)) {
			mkdir($folder, 0777, true);
		}
		
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);
		
		//Print Details		
		$pdf->Headertitle('Personal Details');
		$pdf->Alignment('USI:',$_POST['stdcode']);
		$pdf->Alignment('Name:',$_POST['stdgname'].' '.$_POST['stdfname']);
		$pdf->Alignment('Preffered Name:',$_POST['stdpname']);
		$pdf->Alignment('Course:',$_POST['optcourse']);
		$pdf->Alignment('Birthday:',$_POST['stdbth']);
		$pdf->Alignment('Age:',$_POST['stdage']);
		$pdf->Ln(5);
		
		$pdf->Headertitle('Residence');
		$pdf->Alignment('Building/Property Name:',$_POST['stdbuildr']);
		$pdf->Alignment('Flat/Unit details:',$_POST['stdflastr']);
		$pdf->Alignment('Street/Lot number:',$_POST['stdstrnumr']);
		$pdf->Alignment('Suburb/Locality/Town: ',$_POST['stdstater']);
		$pdf->Alignment('Postal Code: ',$_POST['stdptlr']);
        $pdf->Ln(5);
		
		$pdf->Headertitle('Postal Address');
		$pdf->Alignment('Building/Property Name:',$_POST['stdbuildp']);
		$pdf->Alignment('Flat/Unit details:',$_POST['stdflastp']);
		$pdf->Alignment('Street/Lot number:',$_POST['stdstrnump']);
		$pdf->Alignment('Suburb/Locality/Town: ',$_POST['stdsltp']);
		$pdf->Alignment('Postal Code: ',$_POST['stdptlp']);
		$pdf->Ln(5);
		
		$pdf->Headertitle('Phone and Contact details');
		$pdf->Alignment('Home:',$_POST['stdhome']);
		$pdf->Alignment('Work:',$_POST['stdwork']);
		$pdf->Alignment('Mobile:',$_POST['stdmobile']);
		$pdf->Alignment('Email: ',$_POST['stdemail']);
		$pdf->Ln(5);
		
		$pdf->Headertitle('Emegency Contact');
		$pdf->Alignment('Home:',$_POST['stdhomee']);
		$pdf->Alignment('Work:',$_POST['stdworke']);
		$pdf->Alignment('Mobile:',$_POST['stdmobilee']);
		$pdf->Alignment('Email: ',$_POST['stdemaile']);
		$pdf->Ln(5);
		
		$pdf->Headertitle('Language and Cultural Diversity');
		
		$country = CheckforOther(CheckforGET('stdlang'),
		"Other",CheckforGET('stdstatep'));
		
		$languages = CheckforOther(CheckforGET('stdenghome'),
		"Yes, Specify",CheckforGET('stdspecify'));
		
		$pdf->Alignment('Birthplace:',$country);
		$pdf->Alignment('Languages:',$languages);
		$pdf->Alignment('English:',CheckforGET('stdwelleng'));
		$pdf->Alignment('Aboriginal/Torres Strait Islander origin: ',
		CheckforGET('stdabotors'));
		$pdf->Ln(5);
		
		$pdf->Headertitle('Individual Learning Needs');	
		
		$dis = CheckforGET('stddisabi');
		
		$pdf->Alignment('Disability, Impairment or long-term condition:',$dis);
		
		if ($dis == "Yes") {
			$indicate = CheckforOther(CheckforGET('stdindicate'),"Other",
			CheckforGET('stdotherdis'));
			$pdf->Alignment('Indicate:',$dis);
			$pdf->Alignment('Adjustment:',CheckforGET('stdadjustment'));
		}
		$pdf->Ln(5);
		
		$pdf->Headertitle('Education');	
		$pdf->Alignment('Highest Completed School Level:',CheckforGET('stdhgcomschlvl'));
		$pdf->Alignment('Year Completed:',CheckforGET('stdyearcomp'));
		$sclvl = CheckforGET('stdsuccessqual');
		$pdf->Alignment('Secondary level:',$sclvl);
		if ($sclvl == "Yes") 
			$pdf->Alignment('Indicate:',CheckforGET('scsscomp'));
		$pdf->Ln(5);
		
		$pdf->Headertitle('Reason for study');
		if (isset($_POST["reasonqual"]))
			$reasonqual = $_POST["reasonqual"];
		else
			$reasonqual = array();
		
		$f = 1;
		foreach($reasonqual as $val) {
			if ($f == 1) {
				$pdf->Alignment('List of reasons:',$val);
				$f = 0;
			}
			else {
				if ($val == "Other reason")
					$pdf->Alignment('',CheckforGET('otherreasonstate'));
				else
					$pdf->Alignment('',$val);
			}
				
		}
		
		$hearabout = CheckforGET('hearaboutcou');
		
		if ($hearabout == "Advertisement - where")
			$hearf = $hearabout.": ".CheckforGET('advertisementwhe');
		elseif ($hearabout == "Word of mouth - who")
			$hearf = $hearabout.": ".CheckforGET('wordofmout');
		elseif ($hearabout == "Other")
			$hearf = CheckforGET('otherhear');
		else
			$hearf = $hearabout;

		$pdf->Alignment('Hear about this course:',$hearf);
		$pdf->Ln(5);
		
		$pdf->Headertitle('Current Employment Status');
		$pdf->Alignment('Employment Status:',CheckforGET('stdcurempsts'));
		$pdf->Alignment('Unemployment benefits with centrelink:'
		,CheckforGET('stdbencen'));
		$pdf->Ln(5);
		
		$pdf->Headertitle('Employer Details');
		$pdf->Alignment('Company Name:',CheckforGET('empcomname'));
		$pdf->Alignment('Contact Name:',CheckforGET('empcntname'));
		$pdf->Alignment('Address:',CheckforGET('empaddr'));
		$pdf->Alignment('Suburb:',CheckforGET('empsuburb'));
		$pdf->Alignment('Phone:',CheckforGET('empphone'));
		$pdf->Alignment('Email:',CheckforGET('empemail'));
		$pdf->Ln(5);
		
		$pdf->Headertitle('Apprenticeships and Traineeships');
		$pdf->Alignment('Apprenticeships and Traineeships:',CheckforGET('apprentrain'));
		$pdf->Alignment('Start Date:',CheckforGET('strdateemp'));
		$pdf->Alignment('Job Title',CheckforGET('empjobtitle'));
		$pdf->Alignment('Hours per week:',CheckforGET('emphrperweek'));
		$pdf->Ln(5);
		
		$pdf->Headertitle('Recognition of Prior Learning/Credit');
		$pdf->Alignment('RPL or credit transfer:',CheckforGET('recgprlrcr'));
		$pdf->Ln(5);
		
		$pdf->Headertitle('Jobseekers Seeking Concession');
		$pdf->Alignment('Job Search Agency:',CheckforGET('jobsrchagen'));
		$pdf->Alignment("Employment Co-ordinator's Name:",CheckforGET('emocorname'));
		$pdf->Alignment('Suburb:',CheckforGET('jobskrsuburb'));
		$pdf->Alignment('Landline:',CheckforGET('jobskrlandline'));
		$pdf->Alignment('Mobile:',CheckforGET('jobskrmobile'));
		$pdf->Alignment('Start Date:',CheckforGET('jobskremail'));
		$pdf->Alignment('JSA Client Group:',CheckforGET('jbaclient'));
		$jobfee = CheckforGET('jbsrcagencypart');
		$pdf->Alignment('Job Search Agency Fees:',$jobfee);
		$pdf->Ln(5);
		
		$pdf->Headertitle('Course Fee');
		$pdf->Alignment('Payment Type:',CheckforGET('paymenttype'));
		$pdf->Alignment('Student Name:',CheckforGET('stdnamefee'));
		$pdf->Alignment('Third Party Representative Name:',
		CheckforGET('thrdpartrep'));
		$pdf->Alignment('Third, the invoice is to be made out to:',
		CheckforGET('thrdparinv'));
		$pdf->Ln(5);
		$pdf->Headertitle('Credit Card');
		$pdf->Alignment('Card Type:',CheckforGET('crdtype'));
		$pdf->Alignment('Card Number:',CheckforGET('crdnum'));
		$pdf->Ln(5);
		
		$pdf->Headertitle('Centrelink Details');
		$allow = CheckforGET('regcenallow');
		$pdf->Alignment('Centrelink Allowances:',$allow);
		$pdf->Alignment('Allowances:',CheckforGET('allowyes'));
		$pdf->Alignment('Reference Number:',CheckforGET('refnum'));
		$pdf->Alignment('VET Number:',CheckforGET('vetnum'));
		$pdf->Ln(5);
		
		$pdf->Output('F',$folder."appform.pdf");
	}
?>