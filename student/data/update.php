<?php
	include_once '../../data/dbh.php';
	session_start();
	if (isset($_POST['submitupdate'])) {
		
		
		//Personal
		personaldt();
		//Studentinfo ID
		$id = $_SESSION['stdid'];
		header("Location: ../studentdt.php?ptid=".$id."&success");
	}
	
	function yesorno($var) {
	
		if ($var == "Yes") {
			$return = "1";
		}
		elseif ($stddisabi == "No") {
			$return = "0";
		}
		else {
			$return = "NULL";
		}
		
		return $return;
	}
	
	function personaldt() {
		$stfname = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdfname']);
		$stgname = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdgname']);
		$stpname = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdpname']);
		$stbth = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdbth']);
		$stage = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdage']);
		$course = mysqli_real_escape_string($GLOBALS['conn'],$_POST['optcourse']);
		$stdcode = mysqli_real_escape_string($GLOBALS['conn'],$_POST['stdcode']);
				
		if (isset($_SESSION['perid'])) {
			
			$update = "UPDATE personaldt SET fname='$stfname',gname='$stgname',
			pname='$stpname',brhday='$stbth',age='$stage',code='".$stdcode."'
			WHERE id=".$_SESSION['perid'].";";
			
			if(mysqli_query($GLOBALS['conn'],$update)){
				
				residence();
			}
		}
	}
	
	function residence() {
		$stdbuildr = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdbuildr']);
		$stdflastr = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdflastr']);
		$stdstrnumr = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdstrnumr']);
		$stdsltr = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdsltr']);
		$stdstater = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdstater']);
		$stdptlr = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdptlr']);
		
		//Check if values are empty
		if (empty($stdbuildr) && empty($stdflastr) && empty($stdstrnumr) &&
			empty($stdsltr) && empty($stdstater) && empty($stdptlr)) {
			
			postaladd();
			
		}
		else {
			
			//Check if there is no record yet
			$sqlcheck = "SELECT count(*) as cnt FROM residence WHERE id='".$_SESSION['resdid']."'";
			$resultcheck = mysqli_query($GLOBALS['conn'],$sqlcheck);
		
			if ($row = mysqli_fetch_assoc($resultcheck)) {
				$count =  $row['cnt'];
			}
			
			if ($count == 0) {
				
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
					" where id=".$_SESSION['stdid'].";";
					mysqli_query($GLOBALS['conn'],$insertstd);
					postaladd();
					
				}
				
			}
			else {
				
				$update = "UPDATE residence SET building='$stdbuildr',flat='$stdflastr',
				street='$stdstrnumr',suburb='$stdsltr',state='$stdstater'
				,postalcode='$stdptlr' WHERE id=".$_SESSION['resdid'].";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					postaladd();
				}
				
			}
		}		
	}
	
	function postaladd() {
		$stdbuildp = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdbuildp']);
		$stdflastp = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdflastp']);
		$stdstrnump= mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdstrnump']);
		$stdsltp = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdsltp']);
		$statept = mysqli_real_escape_string($GLOBALS['conn'], $_POST['statept']);
		$stdptlp = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdptlp']);
		
		//Check if values are empty
		if (empty($stdbuildp) && empty($stdflastp) && empty($stdstrnump) &&
			empty($stdsltp) && empty($statept) && empty($stdptlp)) {
			
			phonecontact();
			
		}
		else {
			
			//Check if there is no record yet
			$sqlcheck = "SELECT count(*) as cnt FROM postaladdress WHERE id='".$_SESSION['postid']."'";
			$resultcheck = mysqli_query($GLOBALS['conn'],$sqlcheck);
		
			if ($row = mysqli_fetch_assoc($resultcheck)) {
				$count =  $row['cnt'];
			}
			
			if ($count == 0) {
				
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
					" where id=".$_SESSION['stdid'].";";
					mysqli_query($GLOBALS['conn'],$insertstd);
					phonecontact();
				}
				
			}
			else {
				
				$update = "UPDATE postaladdress SET building='$stdbuildp',flat='$stdflastp',
				street='$stdstrnump',suburb='$stdsltp',state='$statept'
				,postalcode='$stdptlp' WHERE id=".$_SESSION['postid'].";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					phonecontact();
				}
				
			}
		}		
	}
	
	function phonecontact() {
		$stdhome = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdhome']);
		$stdwork = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdwork']);
		$stdmobile = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdmobile']);
		$stdemail = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdemail']);
		
		//Check if values are empty
		if (empty($stdhome) && empty($stdwork) && empty($stdmobile) &&
			empty($stdemail)) {
			
			emergency();
			
		}
		else {
			
			//Check if there is no record yet
			$sqlcheck = "SELECT count(*) as cnt FROM phonecontact WHERE id='".$_SESSION['pntid']."'";
			$resultcheck = mysqli_query($GLOBALS['conn'],$sqlcheck);
		
			if ($row = mysqli_fetch_assoc($resultcheck)) {
				$count =  $row['cnt'];
			}
			
			if ($count == 0) {
				
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
					" where id=".$_SESSION['stdid'].";";
					mysqli_query($GLOBALS['conn'],$insertstd);
					emergency();
				}
				
			}
			else {
				
				$update = "UPDATE phonecontact SET homeph='$stdhome',workph='$stdwork',
				mobile='$stdmobile',email='$stdemail'
				WHERE id=".$_SESSION['pntid'].";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					emergency();
				}
				
			}
			
		}
	}
	
	function emergency() {
		$stdhomee = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdhomee']);
		$stdworke = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdworke']);
		$stdmobilee = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdmobilee']);
		$stdemaile = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdemaile']);
		
		//Check if values are empty
		if (empty($stdhomee) && empty($stdworke) && empty($stdmobilee) &&
			empty($stdemaile)) {
			
			languages();
			
		}
		else {
			
			//Check if there is no record yet
			$sqlcheck = "SELECT count(*) as cnt FROM emergency WHERE id='".$_SESSION['emegid']."'";
			$resultcheck = mysqli_query($GLOBALS['conn'],$sqlcheck);
		
			if ($row = mysqli_fetch_assoc($resultcheck)) {
				$count =  $row['cnt'];
			}
			
			if ($count == 0) {
				
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
					" where id=".$_SESSION['stdid'].";";
					mysqli_query($GLOBALS['conn'],$insertstd);
					languages();
				}
				
			}
			else {
				
				$update = "UPDATE emergency SET homeph='$stdhomee',workph='$stdworke',
				mobile='$stdmobilee',email='$stdemaile'
				WHERE id=".$_SESSION['emegid'].";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					languages();
				}
				
			}
			
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
		
		//Check if values are empty
		if (empty($stdlang) && empty($stdstatep) && empty($stdrsttype) &&
			empty($stdvisatype) && empty($stdenghome) && empty($stdspecify) &&
			empty($stdwelleng) && empty($stdabotors)) {
			
			indlearnneeds();
			
		}
		else {
			
			//Check if there is no record yet
			$sqlcheck = "SELECT count(*) as cnt FROM languages WHERE id='".$_SESSION['langid']."'";
			$resultcheck = mysqli_query($GLOBALS['conn'],$sqlcheck);
		
			if ($row = mysqli_fetch_assoc($resultcheck)) {
				$count =  $row['cnt'];
			}
			
			if($count == 0) {
			
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
					" where id=".$_SESSION['stdid'].";";
					mysqli_query($GLOBALS['conn'],$insertstd);
					indlearnneeds();
				}
			
			}
			else {
			
				$update = "UPDATE languages SET cntbrn='$stdlang',cntbrnother='$stdstatep',
				rsdnttype='$stdrsttype',rsdnttypeother='$stdvisatype',languages='$stdenghome',
				abtor='$stdabotors',engwell='$stdwelleng',languagesother='$stdspecify'
				WHERE id=".$_SESSION['emegid'].";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					indlearnneeds();
				}
			
			}
			
		}
		
		
	}
	
	function indlearnneeds() {
		$stdindicate = mysqli_real_escape_string($GLOBALS['conn'],$_POST['stdindicate']);
		$stdotherdis = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdotherdis']);
		$stdadjustment= mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdadjustment']);
		$stddisabi = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stddisabi']);
		
		//Check if values are empty
		if (empty($stdindicate) && empty($stdotherdis) && empty($stdadjustment) &&
			empty($stddisabi)) {
			
			education();
			
		}
		else {
		
			//Check if there is no record yet
			$sqlcheck = "SELECT count(*) as cnt FROM indlearnneeds WHERE id='".$_SESSION['indleid']."'";
			$resultcheck = mysqli_query($GLOBALS['conn'],$sqlcheck);
		
			if ($row = mysqli_fetch_assoc($resultcheck)) {
				$count =  $row['cnt'];
			}
			
			$stddisabiint = yesorno($stddisabi);

			if($count == 0) {
				
				$sql = "SELECT IFNULL(max(id),0) as maxid FROM indlearnneeds;";
				$result = mysqli_query($GLOBALS['conn'],$sql);
				
				if ($row = mysqli_fetch_assoc($result)) {
					$num = $row['maxid'];
				}
				
				$num += 1;
				
				$insert = "INSERT INTO indlearnneeds(disabimpr,disyes,disother,disadjust)
				VALUES(".$stddisabiint.",'$stdindicate','$stdotherdis','$stdadjustment');";
				
				if(mysqli_query($GLOBALS['conn'],$insert)) {
					$insertstd = "Update studentinfo set indlearid = ".$num.
					" where id=".$_SESSION['stdid'].";";
					mysqli_query($GLOBALS['conn'],$insertstd);
					education();
				}
				
			}
			else {
			
				$update = "UPDATE indlearnneeds SET disabimpr=".$stddisabiint.",disyes='$stdindicate',
				disother='$stdotherdis',disadjust='$stdadjustment'
				WHERE id=".$_SESSION['emegid'].";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					education();
				}
			
			}
			
		}
		
	}
	
	function education() {
		$stdhgcomschlvl = mysqli_real_escape_string($GLOBALS['conn'],$_POST['stdhgcomschlvl']);
		$stdyearcomp = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdyearcomp']);
		$stdseclvl = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdseclvl']);
		$stdsuccessqual = mysqli_real_escape_string($GLOBALS['conn'], $_POST['stdsuccessqual']);
		$stdqualsuccomp = mysqli_real_escape_string($GLOBALS['conn'], $_POST['$stdqualsuccomp']);
		
		//Check if values are empty
		if (empty($stdhgcomschlvl) && empty($stdyearcomp) && empty($stdseclvl) &&
			empty($stdsuccessqual) && empty($stdqualsuccomp)) {
			
			reastud();
			
		}
		else {
		
			//Check if there is no record yet
			$sqlcheck = "SELECT count(*) as cnt FROM education WHERE id='".$_SESSION['eduid']."'";
			$resultcheck = mysqli_query($GLOBALS['conn'],$sqlcheck);
		
			if ($row = mysqli_fetch_assoc($resultcheck)) {
				$count =  $row['cnt'];
			}
			
			$stdseclvlint = yesorno($stdseclvl);
			$stdsuccessqualint = yesorno($stdsuccessqual);
			
			if($count == 0) {
				
				$sql = "SELECT IFNULL(max(id),0) as maxid FROM education;";
				$result = mysqli_query($GLOBALS['conn'],$sql);
				
				if ($row = mysqli_fetch_assoc($result)) {
					$num = $row['maxid'];
				}
				
				$num += 1;
				
				$insert = "INSERT INTO education(highschool,year,snd,success,successyes)
				VALUES('$stdhgcomschlvl','".$stdyearcomp."', ".$stdseclvlint.",".$stdsuccessqualint.",'".$stdqualsuccomp."');";
				
				if(mysqli_query($GLOBALS['conn'],$insert)) {
					$insertstd = "Update studentinfo set educaid = ".$num.
					" where id=".$_SESSION['stdid'].";";
					mysqli_query($GLOBALS['conn'],$insertstd);
					reastud();
				}
			}
			else {
				
				$update = "UPDATE education SET highschool='$stdhgcomschlvl',year='$stdyearcomp',
				snd=".$stdseclvlint.",success=".$stdsuccessqualint.",successyes='$stdqualsuccomp'
				WHERE id=".$_SESSION['eduid'].";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					reastud();
				}
			}
		
		}
	}
	
	function reastud() {

		$reasonqual = mysqli_real_escape_string($GLOBALS['conn'],
		$_POST['reasonqual']); 
		
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
		
		//Check if values are empty
		if (empty($reasonqual) && empty($otherreasonstate) && empty($wordofmout) &&
			empty($hearaboutcou) && empty($advertisementwhe) && empty($otherhear)) {
			
			//curempstatus();
			
		}
		else {
			
			//Others
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
			
			//Check if there is no record yet
			$sqlcheck = "SELECT count(*) as cnt FROM reastud WHERE id='".$_SESSION['reasid']."'";
			$resultcheck = mysqli_query($GLOBALS['conn'],$sqlcheck);
		
			if ($row = mysqli_fetch_assoc($resultcheck)) {
				$count =  $row['cnt'];
			}
			
			if ($count == 0) {
					
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
					" where id=".$_SESSION['stdid'].";";
					mysqli_query($GLOBALS['conn'],$insertstd);
					//curempstatus();
				}
			
			}
			//Exist already
			else {
				
				//Others
				if(!empty($advertisementwhe)) {
					$other = $advertisementwhe;
				}
				elseif (!empty($wordofmout)) {
					$other =$wordofmout;
				}
				elseif (!empty($otherhear)) {
					$other = $otherhear;
				}
				
				$update = "UPDATE reastud SET hearabout='$stdseclvlint',
				other='$otherreasonstate',
				hearaboutv='$other'
				WHERE id=".$_SESSION['reasid'].";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					
					$delete = "DELETE FROM reastudlist 
					WHERE reasid = ".$_SESSION['reasid'].";";
					
					if(mysqli_query($GLOBALS['conn'],$delete)) {
					
						foreach($reasonqual as $val) {
							$inserts ="INSERT INTO reastudlist(descrp,reasid)
							VALUES('".$val."','".$_SESSION['reasid']."');";
							mysqli_query($GLOBALS['conn'],$inserts);
						}
						
					}
					
					//curempstatus();
				}
				
			
			}	
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
		
		header("Location: ../evidence.php");
	}
	
?>