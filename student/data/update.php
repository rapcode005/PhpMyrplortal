<?php
	include_once '../../data/dbh.php';
	session_start();
	if (isset($_GET['submitupdate'])) {
		
		include_once '../../link/code/fpdf.php';
		//Personal
		//personaldt();
		//curempstatus();
		CreatePDF();
		
		/*	
		//Notification
		$linkid = urlencode(base64_encode($_SESSION['stdid']));
		$linkfn = urlencode(base64_encode($_GET['stdfname']));
		$linkgn = urlencode(base64_encode($_GET['stdgname']));
		$querystr = "ptid=".$linkid."&fnm=".$linkfn."&gnm=".$linkgn."&h=st";
		
		if (isset($_GET['n']) && isset($_GET['nid'])) {
			$userid = $_SESSION['u_id'];
			$notifyid =$_GET['nid'];
			$updatenotify = "UPDATE notification SET updateduserid=".$userid." 
			WHERE id = ".$notifyid;
			if(mysqli_query($GLOBALS['conn'],$updatenotify)) {
				header("Location: ../studentdt.php?".$querystr."&s=success");
			}
		}
		else {
			header("Location: ../studentdt.php?".$querystr."&s=success");
		}*/
	}
	
	/*phpinfo();*/
	
	function yesorno($var) {
	
		if ($var == "Yes") {
			$return = "1";
		}
		elseif ($var == "No") {
			$return = "0";
		}
		else {
			$return = "NULL";
		}
		
		return $return;
	}
	
	function personaldt() {
		$stfname = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdfname']);
		$stgname = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdgname']);
		$stpname = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdpname']);
		$stbth = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdbth']);
		$stage = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdage']);
		$course = mysqli_real_escape_string($GLOBALS['conn'],$_GET['optcourse']);
		$stdcode = mysqli_real_escape_string($GLOBALS['conn'],$_GET['stdcode']);
				
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
		$stdbuildr = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdbuildr']);
		$stdflastr = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdflastr']);
		$stdstrnumr = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdstrnumr']);
		$stdsltr = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdsltr']);
		$stdstater = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdstater']);
		$stdptlr = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdptlr']);
		
		//Check if values are empty
		if (empty($stdbuildr) && empty($stdflastr) && empty($stdstrnumr) &&
			empty($stdsltr) && empty($stdstater) && empty($stdptlr)) {
			
			postaladd();
			
		}
		else {
			
			//Check if there is no record yet
			if (isset($_SESSION['resdid'])) {
				$id = $_SESSION['resdid'];
				$count = 1;
			}
			else {
				$id = 0;
				$count = 0;
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
				,postalcode='$stdptlr' WHERE id=".$id.";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					postaladd();
				}
				
			}
		}		
	}
	
	function postaladd() {
		$stdbuildp = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdbuildp']);
		$stdflastp = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdflastp']);
		$stdstrnump= mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdstrnump']);
		$stdsltp = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdsltp']);
		$statept = mysqli_real_escape_string($GLOBALS['conn'], $_GET['statept']);
		$stdptlp = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdptlp']);
		
		//Check if values are empty
		if (empty($stdbuildp) && empty($stdflastp) && empty($stdstrnump) &&
			empty($stdsltp) && empty($statept) && empty($stdptlp)) {
			
			phonecontact();
			
		}
		else {
			
			//Check if there is no record yet
			if (isset($_SESSION['postid'])) {
				$id = $_SESSION['postid'];
				$count = 1;
			}
			else {
				$id = 0;
				$count = 0;
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
				,postalcode='$stdptlp' WHERE id=".$id.";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					phonecontact();
				}
				
			}
		}		
	}
	
	function phonecontact() {
		$stdhome = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdhome']);
		$stdwork = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdwork']);
		$stdmobile = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdmobile']);
		$stdemail = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdemail']);
		
		//Check if values are empty
		if (empty($stdhome) && empty($stdwork) && empty($stdmobile) &&
			empty($stdemail)) {
			
			emergency();
			
		}
		else {
			
			//Check if there is no record yet
			if (isset($_SESSION['pntid'])) {
				$id = $_SESSION['pntid'];
				$count = 1;
			}
			else {
				$id = 0;
				$count = 0;
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
				WHERE id=".$id.";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					emergency();
				}
				
			}
			
		}
	}
	
	function emergency() {
		$stdhomee = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdhomee']);
		$stdworke = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdworke']);
		$stdmobilee = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdmobilee']);
		$stdemaile = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdemaile']);
		
		//Check if values are empty
		if (empty($stdhomee) && empty($stdworke) && empty($stdmobilee) &&
			empty($stdemaile)) {
			
			languages();
			
		}
		else {
			
			//Check if there is no record yet
			if (isset($_SESSION['emegid'])) {
				$id = $_SESSION['emegid'];
				$count = 1;
			}
			else {
				$id = 0;
				$count = 0;
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
				WHERE id=".$id.";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					languages();
				}
				
			}
			
		}
		
		
	}
	
	function languages() {
		$stdlang = mysqli_real_escape_string($GLOBALS['conn'],$_GET['stdlang']);
		$stdstatep = mysqli_real_escape_string($GLOBALS['conn'],$_GET['stdstatep']);
		$stdrsttype = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdrsttype']);
		$stdvisatype= mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdvisatype']);
		$stdenghome = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdenghome']);
		$stdspecify = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdspecify']);
		$stdwelleng = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdwelleng']);
		$stdabotors = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdabotors']);
		
		//Check if values are empty
		if (empty($stdlang) && empty($stdstatep) && empty($stdrsttype) &&
			empty($stdvisatype) && empty($stdenghome) && empty($stdspecify) &&
			empty($stdwelleng) && empty($stdabotors)) {
			
			indlearnneeds();
			
		}
		else {
			
			//Check if there is no record yet
			if (isset($_SESSION['langid'])) {
				$id = $_SESSION['langid'];
				$count = 1;
			}
			else {
				$id = 0;
				$count = 0;
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
				
				//Check previous values
				if ($stdlang == "Australia")
					$stdstatep = "";
				
				if ($stdrsttype != "Visa Type")
					$stdvisatype = "";
				
				if($stdenghome != "Yes, Specify")
					$stdspecify = "";
				
				$update = "UPDATE languages SET cntbrn='$stdlang',cntbrnother='$stdstatep',
				rsdnttype='$stdrsttype',rsdnttypeother='$stdvisatype',languages='$stdenghome',
				abtor='$stdabotors',engwell='$stdwelleng',languagesother='$stdspecify'
				WHERE id=".$id.";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					indlearnneeds();
				}
			
			}
			
		}
		
		
	}
	
	function indlearnneeds() {
		if (isset($_GET['stdindicate']))
			$stdindicate = mysqli_real_escape_string($GLOBALS['conn'],$_GET['stdindicate']);
		else
			$stdindicate = "";
		
		$stdotherdis = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdotherdis']);
		$stdadjustment= mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdadjustment']);
		$stddisabi = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stddisabi']);
		
		//Check if values are empty
		if (empty($stdindicate) && empty($stdotherdis) && empty($stdadjustment) &&
			empty($stddisabi)) {
			
			education();
			
		}
		else {
		
			//Check if there is no record yet
			if (isset($_SESSION['indleid'])) {
				$id = $_SESSION['indleid'];
				$count = 1;
			}
			else {
				$id = 0;
				$count = 0;
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
				
				//Check for previous values
				if ($stddisabiint == 0) {
					$stdindicate = "";
					$stdadjustment = "";
					$stdotherdis = "";
				}
				else {
					if ($stdindicat != "Other")
						$stdotherdis = "";
				}
				
				$update = "UPDATE indlearnneeds SET disabimpr=".$stddisabiint.",disyes='$stdindicate',
				disother='$stdotherdis',disadjust='$stdadjustment'
				WHERE id=".$id.";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					education();
				}
			
			}
			
		}
		
	}
	
	function education() {
		$stdhgcomschlvl = mysqli_real_escape_string($GLOBALS['conn'],$_GET['stdhgcomschlvl']);
		$stdyearcomp = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdyearcomp']);
		$stdseclvl = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdseclvl']);
		$stdsuccessqual = mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdsuccessqual']);
		if (isset($_GET["scsscomp"]))
			$scsscomp = mysqli_real_escape_string($GLOBALS['conn'], $_GET["scsscomp"]);
		else
			$scsscomp = "";
		
		//Check if values are empty
		if (empty($stdhgcomschlvl) && empty($stdyearcomp) && empty($stdseclvl) &&
			empty($stdsuccessqual) && empty($scsscomp)) {
			
			reastud();
		}
		else {
		
			//Check if there is no record yet
			if (isset($_SESSION['eduid'])) {
				$id = $_SESSION['eduid'];
				$count = 1;
			}
			else {
				$id = 0;
				$count = 0;
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
				VALUES('$stdhgcomschlvl','".$stdyearcomp."', ".$stdseclvlint.",".$stdsuccessqualint.",'".$scsscomp."');";
				
				if(mysqli_query($GLOBALS['conn'],$insert)) {
					$insertstd = "Update studentinfo set educaid = ".$num.
					" where id=".$_SESSION['stdid'].";";
					mysqli_query($GLOBALS['conn'],$insertstd);
					reastud();
				}
			}
			else {
				
				//Check for previous values
				if ($stdsuccessqualint == 0)
					$scsscomp = "";
				
				$update = "UPDATE education SET highschool='$stdhgcomschlvl',year='$stdyearcomp',
				snd=".$stdseclvlint.",success=".$stdsuccessqualint.",successyes='".$scsscomp."'
				WHERE id=".$id.";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					reastud();
				}
				
			}
		
		}
	}
	
	function reastud() {
		if (isset($_GET["reasonqual"]))
			$reasonqual = $_GET["reasonqual"]; 
		else
			$reasonqual = array();
		
		$otherreasonstate = mysqli_real_escape_string($GLOBALS['conn'],
		$_GET['otherreasonstate']);
		
		if (isset($_GET["hearaboutcou"]))
			$hearaboutcou = mysqli_real_escape_string($GLOBALS['conn'],$_GET["hearaboutcou"]);
		else
			$hearaboutcou = "";
		
		$advertisementwhe= mysqli_real_escape_string($GLOBALS['conn'],
		$_GET['advertisementwhe']);
		
		$wordofmout = mysqli_real_escape_string($GLOBALS['conn'],
		$_GET['wordofmout']);
		
		$otherhear = mysqli_real_escape_string($GLOBALS['conn'],
		$_GET['otherhear']);
		
		//Check if values are empty
		if (empty($reasonqual) && empty($otherreasonstate) && empty($wordofmout) &&
			empty($hearaboutcou) && empty($advertisementwhe) && empty($otherhear)) {
			
			
		}
		else {
			
			//Check if there is no record yet
			if (isset($_SESSION['reasid'])) {
				$id = $_SESSION['reasid'];
				$count = 1;
			}
			else {
				$id = 0;
				$count = 0;
			}
			
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
				$other = "";
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
				}
			
			}
			//Exist already
			else {
						
				$update = "UPDATE reastud SET hearabout='$hearaboutcou',
				other='$otherreasonstate',
				hearaboutv='$other'
				WHERE id=".$id.";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {

					$delete = "DELETE FROM reastudlist WHERE reasid=".$id.";";
					
					if(mysqli_query($GLOBALS['conn'],$delete)) {
					
						foreach($reasonqual as $val) {
		
							$inserts ="INSERT INTO reastudlist(descrp,reasid) VALUES('".$val."','".$id."');";
							mysqli_query($GLOBALS['conn'],$inserts);
						}
					
					}
				
				}		
			}	
		}
	}
	
	function curempstatus() {
	
		if (isset($_GET['stdcurempsts'])) {
			$stdcurempsts = mysqli_real_escape_string($GLOBALS['conn'], 
			$_GET['stdcurempsts']);
		}
		else {
			$stdcurempsts = "NULL";
		}
		
		
		if (isset($_GET['stdbencen'])) {
			$stdbencen = yesorno($_GET['stdbencen']);
		}
		else {
			$stdbencen = "NULL";
		}
		
		//Check if values are empty
		if($stdcurempsts == "NULL" && $stdbencen == "NULL") {
			employerdt();
		}
		else {
			
			//Check if there is no record yet
			if (isset($_SESSION['curempidc'])) {
				$idc = $_SESSION['curempidc'];
				$count = 1;
			}
			else {
				$idc = 0;
				$count = 0;
			}
			
			if ($count == 0) {
				
				$insert = "INSERT INTO curempstatus(empstatus,regs) VALUES(".$stdcurempsts.",".$stdbencen.");";
				
				if(mysqli_query($GLOBALS['conn'],$insert)) {
					//Add to studentinfo table
					$sql = "SELECT IFNULL(max(id),0) as maxid FROM curempstatus;";
					$result = mysqli_query($GLOBALS['conn'],$sql);
					
					if ($row = mysqli_fetch_assoc($result)) {
						$num = $row['maxid'];
					}

					$insertstd = "Update studentinfo set curempid = ".$num." where stdcode=".$GLOBALS['stdnum'].";";
					mysqli_query($GLOBALS['conn'],$insertstd);
					
					employerdt();
				}
				
			}
			else {
				
				$update = "UPDATE curempstatus SET empstatus='".$stdcurempsts."',
				regs=".$stdbencen." WHERE id=".$idc.";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					employerdt();
				}
			}
		}
		
	}
	
	function employerdt() {
		$empcomname = mysqli_real_escape_string($GLOBALS['conn'], $_GET['empcomname']);
		$empcntname= mysqli_real_escape_string($GLOBALS['conn'], $_GET['empcntname']);
		$empaddr = mysqli_real_escape_string($GLOBALS['conn'], $_GET['empaddr']);
		$empsuburb = mysqli_real_escape_string($GLOBALS['conn'], $_GET['empsuburb']);
		$empphone = mysqli_real_escape_string($GLOBALS['conn'], $_GET['empphone']);
		$empemail = mysqli_real_escape_string($GLOBALS['conn'],$_GET['empemail']);
		
		if (empty($empcomname) && empty($empcntname) && empty($empaddr) &&
		empty($empsuburb) && empty($empphone) && empty($empemail)) {
			apprentrn();
		}
		else {
			
			//Check if there is no record yet
			if (isset($_SESSION['empdtid'])) {
				$id = $_SESSION['empdtid'];
				$count = 1;
			}
			else {
				$id = 0;
				$count = 0;
			}
			
			if ($count == 0) {
				
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
			else {
				
				$update = "UPDATE employerdt SET empcomname='".$empcomname."',
				empcntname='".$empcntname."',empaddress='".$empaddr."',
				empsub='".$empsuburb."',emphone='".$empphone."',empemail='".$empemail."' WHERE id=".$id.";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					apprentrn();
				}
				
			}
			
		}
	}
	
	function apprentrn() {
		
		$strdateemp = mysqli_real_escape_string($GLOBALS['conn'], $_GET['strdateemp']);
		$empjobtitle= mysqli_real_escape_string($GLOBALS['conn'], $_GET['empjobtitle']);
		$emphrperweek = mysqli_real_escape_string($GLOBALS['conn'], $_GET['emphrperweek']);
		$apprentrain = mysqli_real_escape_string($GLOBALS['conn'], $_GET['apprentrain']);
		
		if(empty($apprentrain) && empty($strdateemp) &&
		empty($empjobtitle) &&  empty($emphrperweek)) {
			
			recogprior();
			
		}
		else {
			
			//Check if there is no record yet
			if (isset($_SESSION['apptid'])) {
				$id = $_SESSION['apptid'];
				$count = 1;
			}
			else {
				$id = 0;
				$count = 0;
			}
			
			$apprentrainint = yesorno($apprentrain);
			
			if ($count == 0) {
				$sql = "SELECT IFNULL(max(id),0) as maxid FROM apprentrn;";
				$result = mysqli_query($GLOBALS['conn'],$sql);
			
				if ($row = mysqli_fetch_assoc($result)) {
					$num = $row['maxid'];
				}
				
				$num += 1;
				
				$insert = "INSERT INTO apprentrn(appres,appresdate,
				appretitle,hrsperweek)
				VALUES('".$apprentrainin."','".$strdateemp."','".$empjobtitle."'
				,'".$emphrperweek."');";
				
				if(mysqli_query($GLOBALS['conn'],$insert)){
					//Add to studentinfo table
					$insertstd = "Update studentinfo set appid = ".$num.
					" where stdcode=".$GLOBALS['stdnum'].";";
					mysqli_query($GLOBALS['conn'],$insertstd);
					recogprior();
				}
			}
			else {
				
				$update = "UPDATE apprentrn SET appres=".$apprentrainint.",
				appresdate='".$strdateemp."',appretitle='".$empjobtitle."',
				hrsperweek='".$emphrperweek."' WHERE id=".$id.";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					recogprior();
				}
			
			}
			
		}
	}
	
	function recogprior() {
		if (isset($_GET['recgprlrcr'])) {
			
			$recgprlrcr = yesorno($_GET['recgprlrcr']);
			
			//Check if there is no record yet
			if (isset($_SESSION['recogid'])) {
				$id = $_SESSION['recogid'];
				$count = 1;
			}
			else {
				$id = 0;
				$count = 0;
			}
			
			if ($count == 0) {
				$insert = "INSERT INTO recogprior(recog)
				VALUES(".$recgprlrcr.");";
				
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
				$update = "UPDATE recogprior SET recog=".$recgprlrcr." WHERE id='".$id."';";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					jobseekers();
				}
			}
		}
		else {
			jobseekers();
		}
				
	}
	
	function jobseekers() {
		$jobsrchagen = mysqli_real_escape_string($GLOBALS['conn'], $_GET['jobsrchagen']);
		$emocorname= mysqli_real_escape_string($GLOBALS['conn'], $_GET['emocorname']);
		$jobskrsuburb = mysqli_real_escape_string($GLOBALS['conn'], $_GET['jobskrsuburb']);
		$jobskrlandline = mysqli_real_escape_string($GLOBALS['conn'], $_GET['jobskrlandline']);
		$jobskrmobile = mysqli_real_escape_string($GLOBALS['conn'], $_GET['jobskrmobile']);
		$jobskremail = mysqli_real_escape_string($GLOBALS['conn'],$_GET['jobskremail']);
		$jbaclient = mysqli_real_escape_string($GLOBALS['conn'],$_GET['jbaclient']);
		$jbsrcagencypart = mysqli_real_escape_string($GLOBALS['conn'],$_GET['jbsrcagencypart']);
			
		//Check if all fields are empty
		if(empty($jobsrchagen) && empty($emocorname) && empty($jobskrsuburb) &&
			empty($jobskrlandline) && empty($jobskrmobile) && empty($jobskremail)
		    && empty($jbaclient) && empty($jbsrcagencypart)) {
			centrelink();
		}
		else {
			
			//Check if there is no record yet
			if (isset($_SESSION['jobid'])) {
				$id = $_SESSION['jobid'];
				$count = 1;
			}
			else {
				$id = 0;
				$count = 0;
			}
			
			$jbsrcagencypartint = yesorno($jbsrcagencypart);
			
			if ($count == 0) {
				$insert = "INSERT INTO jobseekers(jbseekagen,empcoorname,jobseeksur,
					landline,jobseeknobile,jobseekstrdte,jsaclient,jobsearchfee)
				VALUES('".$jobsrchagen."','".$emocorname."','".$jobskrsuburb."','".$jobskrlandline."',
				'".$jobskrmobile."','".$jobskremail."','".$jbaclient."',".$jbsrcagencypartint.");";
				
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
					
					if ($jbsrcagencypartint == "1") {
						coursefee();
					}
					else {
						centrelink();
					}
				}
			}
			else {
				$update = "UPDATE jobseekers SET jbseekagen='".$jobsrchagen."',empcoorname='".$emocorname."',
				jobseeksur='".$jobskrsuburb."',landline='".$jobskrlandline."',jobseeknobile='".$jobskrmobile."',
				jobseekstrdte='".$jobskremail."',jsaclient='".$jbaclient."',
				jobsearchfee=".$jbsrcagencypartint." WHERE id=".$id.";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					if ($jbsrcagencypartint == "1") {
						coursefee();
					}
					else {
						centrelink();
					}
				}
				else 
					echo $update;
			}
		}
	}
	
	function coursefee() {
		
		$paymenttype = mysqli_real_escape_string($GLOBALS['conn'], $_GET['paymenttype']);
		$stdnamefee= mysqli_real_escape_string($GLOBALS['conn'], $_GET['stdnamefee']);
		$thrdpartrep = mysqli_real_escape_string($GLOBALS['conn'], $_GET['thrdpartrep']);
		$thrdparinv = mysqli_real_escape_string($GLOBALS['conn'], $_GET['thrdparinv']);
		$crdtype = mysqli_real_escape_string($GLOBALS['conn'], $_GET['crdtype']);
		$crdnum = mysqli_real_escape_string($GLOBALS['conn'], $_GET['crdnum']);
	
		if (empty($paymenttype) && empty($stdnamefee) && empty($thrdpartrep) &&
			empty($thrdparinv) && empty($crdtype) && empty($crdnum)) {
			centrelink();
		}
		else {
			
			//Check if there is no record yet
			if (isset($_SESSION['coursefid'])) {
				$id = $_SESSION['coursefid'];
				$count = 1;
			}
			else {
				$id = 0;
				$count = 0;
			}
			
			if ($count == 0) {
				
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
			else {
				$update = "UPDATE coursefee SET paytype='".$paymenttype."'
				,stdname='".$stdnamefee."',thrdrepname='".$thrdpartrep."',
				thrdinvoice='".$thrdparinv."',crdtype='".$crdtype."',
				crdnum='".$crdnum."' WHERE id=".$id.";";
				
				if(mysqli_query($GLOBALS['conn'],$update)) {
					centrelink();
				}
			}
		}
	}
	
	function centrelink() {
		
		$allowyes = mysqli_real_escape_string($GLOBALS['conn'], $_GET['allowyes']);
		$regcenallow = mysqli_real_escape_string($GLOBALS['conn'], $_GET['regcenallow']);
		$refnum= mysqli_real_escape_string($GLOBALS['conn'], $_GET['refnum']);
		$vetnum= mysqli_real_escape_string($GLOBALS['conn'], $_GET['vetnum']);
		
		if (empty($regcenallow) && empty($allowyes) && empty($refnum) ||
			empty($vetnum)) {
		}
		else {
			
			//Check if there is no record yet
			if (isset($_SESSION['centid'])) {
				$id = $_SESSION['centid'];
				$count = 1;
			}
			else {
				$id = 0;
				$count = 0;
			}
			
			if ($count == 0) {
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
			else {
				$update = "UPDATE centrelink SET cntrallow='".$regcenallow."'
				,allowances='".$allowyes."',refnum=".$refnum.",
				vetnum='".$vetnum."' WHERE id=".$id.";";
					
				if(mysqli_query($GLOBALS['conn'],$update)) {
				}
			}
		}
	}
	
	function CheckforGET($title) {
		if (!empty($_GET[$title])) {
			return $_GET[$title];
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
		$pdf->Alignment('USI:',$_GET['stdcode']);
		$pdf->Alignment('Name:',$_GET['stdgname'].' '.$_GET['stdfname']);
		$pdf->Alignment('Preffered Name:',$_GET['stdpname']);
		$pdf->Alignment('Course:',$_GET['optcourse']);
		$pdf->Alignment('Birthday:',$_GET['stdbth']);
		$pdf->Alignment('Age:',$_GET['stdage']);
		$pdf->Ln(5);
		
		$pdf->Headertitle('Residence');
		$pdf->Alignment('Building/Property Name:',$_GET['stdbuildr']);
		$pdf->Alignment('Flat/Unit details:',$_GET['stdflastr']);
		$pdf->Alignment('Street/Lot number:',$_GET['stdstrnumr']);
		$pdf->Alignment('Suburb/Locality/Town: ',$_GET['stdstater']);
		$pdf->Alignment('Postal Code: ',$_GET['stdptlr']);
        $pdf->Ln(5);
		
		$pdf->Headertitle('Postal Address');
		$pdf->Alignment('Building/Property Name:',$_GET['stdbuildp']);
		$pdf->Alignment('Flat/Unit details:',$_GET['stdflastp']);
		$pdf->Alignment('Street/Lot number:',$_GET['stdstrnump']);
		$pdf->Alignment('Suburb/Locality/Town: ',$_GET['stdsltp']);
		$pdf->Alignment('Postal Code: ',$_GET['stdptlp']);
		$pdf->Ln(5);
		
		$pdf->Headertitle('Phone and Contact details');
		$pdf->Alignment('Home:',$_GET['stdhome']);
		$pdf->Alignment('Work:',$_GET['stdwork']);
		$pdf->Alignment('Mobile:',$_GET['stdmobile']);
		$pdf->Alignment('Email: ',$_GET['stdemail']);
		$pdf->Ln(5);
		
		$pdf->Headertitle('Emegency Contact');
		$pdf->Alignment('Home:',$_GET['stdhomee']);
		$pdf->Alignment('Work:',$_GET['stdworke']);
		$pdf->Alignment('Mobile:',$_GET['stdmobilee']);
		$pdf->Alignment('Email: ',$_GET['stdemaile']);
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
		if (isset($_GET["reasonqual"]))
			$reasonqual = $_GET["reasonqual"];
		else
			$reasonqual = array();
		
		$f = 1;
		foreach($reasonqual as $val) {
			if ($f == 1) {
				$pdf->Alignment('List of reason:',$val);
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
		
		if ($jobfee == "Yes") {
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
		}
		
		$pdf->Headertitle('Centrelink Details');
		$allow = CheckforGET('regcenallow');
		$pdf->Alignment('Centrelink Allowances:',$allow);
		if ($allow == "Yes") {
			$pdf->Alignment('Allowances:',CheckforGET('allowyes'));
			$pdf->Alignment('Reference Number:',CheckforGET('refnum'));
			$pdf->Alignment('VET Number:',CheckforGET('vetnum'));
		}
		$pdf->Ln(5);
		
		$pdf->Output();
		//$pdf->Output('F',$folder."appform.pdf");
	}
?>