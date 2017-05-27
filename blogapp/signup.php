<?php
	function signup() {
		global $connection;
		
		if(isset($_POST['signup'])) {
			if(!empty($_POST['nusername']) && !empty($_POST['npassword'])){
				$username = mysqli_real_escape_string ($connection, $_POST["nusername"]);
                $password = mysqli_real_escape_string ($connection, $_POST["npassword"]);
                $password = md5(md5('salt').$password);
                $sql = "SELECT `id` FROM `10162844-users` WHERE username='$username' ";
                $result = mysqli_query($connection, $sql);
                $row = mysqli_num_rows($result);
                if(!$row) {
	                $sql = "INSERT INTO `10162844-users` (`username`, `password`) VALUES ('$username', '$password')";
	               	$result = mysqli_query($connection, $sql);
	               	$success = mysqli_insert_id($connection);

	         		if($success =! "") {
		               	$msg ='Thank you for SIGNING UP';
		                 header('Refresh: 2; URL = ?page=login');
	         		} else {
	         			header('URL = ?page=signup');
         			}
         		} else {
         			$msg = 'Username:<i> '.$username.' </i>already exists';
         		}
			}
		}

		include('views/signup.html');
	}
?>