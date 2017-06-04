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

function like(){
	echo "tere";
	/*connect_db();
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	#updates visit count or inserts new ipaddress to visitors
	$sql = "SELECT `ipaddress`, `likes` FROM `likes` WHERE ipaddress='$ipaddress'";
	$result = mysqli_query($connection, $sql);
	$success = mysqli_num_rows($result);

	if ($success == 1) {

		$sql = "UPDATE `likes` SET likes = likes + 1 WHERE ipaddress = '$ipaddress' ";
		$result = mysqli_query($connection, $sql);

	} else {
		$sql = "INSERT INTO `likes` (`ipaddress`, `likes`) VALUES ('$ipaddress', 1) ";
		$result = mysqli_query($connection, $sql);

		}
		*/
}
?>