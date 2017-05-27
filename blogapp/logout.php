<?php
   #session_start();
	function logout() {
	   unset($_SESSION["username"]);
	   unset($_SESSION["password"]);
	   session_destroy();
	   
	   echo 'Logging out...';
	   header('Refresh: 1; URL = ?');
	}
?>