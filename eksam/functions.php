
<?php
function connect_db(){
	global $connection;
	$host="shareddb1b.hosting.stackcp.net";
	$user="anaava";
	$pass="t3st3r123";
	$db="10162844-blogapp-35b396";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));


	}

?>