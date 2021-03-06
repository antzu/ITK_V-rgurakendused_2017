<?php

	require_once ('functions.php');
	
	
	session_start();
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

	
	
	$t = time();
	$t = date("Y-m-d H:i", $t);
	echo 'Current date is '.$t . '<br>';
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	$visits = 1;

	#display last visit from db
	$sql = "SELECT MAX(lastvisit) as lastvisit FROM `visitors` WHERE ipaddress = '$ipaddress' ";
	$result = mysqli_query($connection, $sql);
	$success = mysqli_num_rows($result);
	$r = mysqli_fetch_assoc($result);
	echo '<b>YOUR</b> Last visit according to db '.$r['lastvisit'].'<br>';

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


	#get sum of visits from db
	$sql = "SELECT SUM(visits) AS totalvisits FROM `visitors` WHERE ipaddress = '$ipaddress'";
	$result = mysqli_query($connection, $sql);
	$r = mysqli_fetch_assoc($result);
	echo '<b>YOUR</b> Total visits according to db:<b> '.$r['totalvisits'].'</b><br><br>';
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
<p>Laigi ja hinda lehte</p>
<button onClick="">Like</button>
<br>
<br>
<form method="post" action="">
	<br>
	<br>
	<br>
	<label>Sisesta enda kommentaar:</label>
	<input type="text" name="tekst">
	<button type="submit">Kinnita</button>
</form>
<?php
 echo "Hetkel yles laetud pildid: <br>";
 	$directory = "pictures/";
	$filecount = 0;
	$files = glob($directory . "*");
	if ($files){
 		$filecount = count($files);
	}
	echo $filecount;
?>
<form method="post" action="upload.php" enctype="multipart/form-data">
	<br>
	<br>
	<label>Sisesta pilt</label>
	<input type="file" name="image">
	<button type="submit" name="submit">Kinnita</button>
</form>
<br>
<br>
<?php
 echo "Hetkel yles laetud failid: <br>";
 	$directory = "files/";
	$filecount = 0;
	$files = glob($directory . "*");
	if ($files){
 		$filecount = count($files);
	}
	echo $filecount;
?>
<form method="post" action="upload.php" enctype="multipart/form-data">
	<br>
	<br>
	<label>Sisesta fail</label>
	<input type="file" name="file">
	<button type="submit" name="submit">Kinnita</button>
</form>
<div id="kpv"></div>
<div id="phpkpv"><?php echo time() ?></div>
<script type="text/javascript">
	var date = new Date();
	var datephp = document.getElementById('phpkpv').innerHTML;
	datephp = new Date(datephp*1000);
	console.log(datephp);
	console.log(date);
	var datehrs = date.getHours();
	var phphrs = datephp.getHours();
	var datemin = date.getMinutes();
	var phpmin = datephp.getMinutes();
	if (datemin == phpmin) {
		document.getElementById('kpv').innerHTML = 'kellaajad samad';
	} else {
		document.getElementById('kpv').innerHTML = datemin - phpmin;
	}

</script>
</body>

</html>

