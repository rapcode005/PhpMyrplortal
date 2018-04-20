<?php	
	if(isset($_SESSION['u_r'])) {
		if ($_SESSION['u_r'] == "admin") {
			header("Location: admin/");
		}
		elseif ($_SESSION['u_r'] == "agent") {
			header("Location: student/");
		}
		elseif ($_SESSION['u_r'] == "aser") {
			header("Location: assessor/");
		}
	}
	else {
		include 'headerhomeadmin.php';
		
		echo "
			<div class='main-wrapper'>
			<form class='login-form' action='data/login.php' method='POST'>
			<input type='text' name='uid' class='w3-input w3-border w3-round'
			placeholder='Username' />
			<input type='password' name='pwd' class='w3-input w3-border w3-round'  
			placeholder='Password' />
			<button type='submit' name='submit'
			class='w3-blueh w3-hover-green'>Login</button></form>
			</div>";
	}

	include_once 'footer.php';
?>

