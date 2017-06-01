<?php

	require_once ('functions.php');
	
	connect_db();

	#display last visit from db
	$sql = "SELECT MAX(lastvisit) as lastvisit FROM `visitors`";
	$result = mysqli_query($connection, $sql);
	$success = mysqli_num_rows($result);
	$r = mysqli_fetch_assoc($result);
	echo 'Last visit according to db '.$r['lastvisit'].'<br>';

	#display last vsit from text file
	#update and get visits from text file
	echo "Tekst faili kohaselt on lehte kylastanud: ";
	$content = file('visits.txt', FILE_IGNORE_NEW_LINES);
	if(empty($content)) {
		$file = fopen('visits.txt', 'w');
		fwrite($file, '1');
	} else {
		$file = fopen('visits.txt', 'w');
		fwrite($file, $content[0]+1);
	}
	echo file_get_contents('visits.txt')."<br>";
	echo "Last visit according to text file: ";
	echo file_get_contents("lastvisit.txt")."<br>";

	#starts session, gets ip and time
	session_start();
	$t = time();
	$t = date("Y-m-d", $t);
	echo 'Current date is '.$t . '<br>';
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	$visits = 1;

	#updates tekst file logs
	$tekst = $t;
	$file = fopen("lastvisit.txt","w");
	fwrite($file, '<br>'.$tekst);

	$tekst = $ipaddress;
	$file = fopen("iplog.txt","a");
	fwrite($file, '\n'.$tekst);

	#updates visit count or inserts new ipaddress to visitors
	$sql = "SELECT `ipaddress`, `visits` FROM `visitors` WHERE ipaddress='$ipaddress'";
	$result = mysqli_query($connection, $sql);
	$success = mysqli_num_rows($result);

	if ($success == 1) {

		$sql = "UPDATE `visitors` SET visits = visits + 1, lastvisit='$t' WHERE ipaddress = '$ipaddress' ";
		$result = mysqli_query($connection, $sql);

	} else {
		$sql = "INSERT INTO `visitors` (`ipaddress`) VALUES ('$ipaddress') ";
		$result = mysqli_query($connection, $sql);

		}


	#get sum of visits from db
	$sql = "SELECT SUM(visits) AS totalvisits FROM `visitors`";
	$result = mysqli_query($connection, $sql);
	$r = mysqli_fetch_assoc($result);
	echo 'Total visits according to db:<b> '.$r['totalvisits'].'</b><br><br>';


	#gets count of distinct/diefferent ip addresses from db
	$sql = "SELECT DISTINCT COUNT(ipaddress) as address FROM `visitors`";
	$result = mysqli_query($connection, $sql);
	$r = mysqli_fetch_assoc($result);
	echo 'From:<b> '.$r['address'].'</b> different addresses.<br><br>';

	#prints out all posts from db
    $sql = "SELECT * FROM `posts` ";
    $result = mysqli_query($connection, $sql);
    echo "<b>Kylastajate jaetud kommentaarid ANDMEBAASIST: </b><br><br>";
    while ($r = mysqli_fetch_assoc($result)) {
    	echo $r['post'];
    	echo "<br>";
    }
    	
	#prints out all posts from text file
    echo "<br><b>Kylastajate kommentaarid TEKST.txt failist: </b><br><br>";
	if (isset($_POST['tekst'])) {
	$tekst = $_POST['tekst'];
	$file = fopen("test.txt","a");
	
	fwrite($file, '<br>'.$tekst);
	}
	echo file_get_contents("test.txt");


	
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="post" action="">
	<br>
	<br>
	<br>
	<label>Sisesta enda kommentaar:</label>
	<input type="text" name="tekst">
	<button type="submit">Kinnita</button>
</form>
</body>
</html>

