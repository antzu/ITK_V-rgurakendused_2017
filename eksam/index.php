<?php
	require_once('functions.php');
	connect_db();
	session_start();

	if (isset($_POST['post'])) {
		$post = mysqli_real_escape_string ($connection, $_POST["post"]);
        $id = mysqli_real_escape_string ($connection, $_SESSION["id"]);
               
                
              

        $sql = "INSERT INTO `posts` (`post`) VALUES ('$post')";
        $result = mysqli_query($connection, $sql);
        $success = mysqli_insert_id($connection);
	}

	$sql = "SELECT `post` FROM `posts` ";
    $result = mysqli_query($connection, $sql) or die("Sellist postitust pole!!!");
	$r = mysqli_fetch_assoc($result);

	
	$post = $r['post'];
	$posts = array();
	
	while ($r = mysqli_fetch_assoc($result)) {
            
            	array_push($posts, $r['post']);
            
           }


?>


<!DOCTYPE html>
<html>
<head>
	<title>Andres Aava eksam</title>
</head>
<body>
	<div>
		<h1>Märkmed</h1>
		<form method="post">
			<h3>Postita siia:</h3>
			<br>
			<textarea name = "post" placeholder = "your post here" cols="80" rows="10" required></textarea>
			<br>
			<button type="submit" name="submit">Postita</button>
		</form>
		<div>
			<?php
				foreach ($posts as $n => $post) {
						echo "<div><p>".htmlspecialchars($posts[$n])."</p></div>";
						echo "</div>";
						}
			?>
		</div>
	</div>
</body>
</html>