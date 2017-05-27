<?php
   #session_start();
	function logout() {
	   unset($_SESSION["username"]);
	   unset($_SESSION["password"]);
	   session_destroy();
	   
	   echo '<span class="label label-warning">Logging out...</span>';
	   header('Refresh: 1; URL = ?');
	}
?>