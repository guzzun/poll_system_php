<?php
if(array_key_exists('admin', $_GET)){
	if ($_GET['admin'] == true){
		print <<<EOT
			<form style="width: 60%; margin: 0 auto; text-align: center;" action="" method="post">
				<input type="password" name="password"> <input type="submit" name="submit" value="Login">
			</form>
		EOT;
		if(isset($_POST['submit']) == 1){
			$adminka_pass = file_get_contents('user_mod/adminka_pass.txt', true);

			if($_POST['password'] == $adminka_pass)
				include 'user_mod/admin.php';
			else
				include 'user_mod/guest.php';
		}
	}
} else
	include 'user_mod/guest.php';