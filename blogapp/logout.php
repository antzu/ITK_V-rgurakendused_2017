<?php
   #session_start();
	function logout() {
	   unset($_SESSION["username"]);
	   unset($_SESSION["password"]);
	   
	   echo 'Logging out...';
	   header('Refresh: 2; URL = ?');
	}
?>