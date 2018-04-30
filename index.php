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
			<div class='login-page'>
			<div class='form'>
			<form class='login-form' action='data/login.php' method='POST'>
			<input type='text' name='uid' 
			placeholder='Username' />
			<input type='password' name='pwd' 
			placeholder='Password' />
			<button type='submit' name='submit'
			>Login</button></form>
			</div></div>";
	}

	include_once 'footer.php';
?>

