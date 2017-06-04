<?php
	require_once('functions.php');
	connect_db();
	session_start();

	if (!empty($_GET['postid'])) {
		
		
			$postid = $_GET['postid'];
			$sql = "SELECT `post` FROM `posts` WHERE id='$postid' ";
	    	$result = mysqli_query($connection, $sql) or die("Sellist postitust pole!!!");
			$r = mysqli_fetch_assoc($result);

			$changablepost = $r['post'];
		

		if (isset($_POST['muuda'])) {
			

				$postid = $_GET['postid'];
				$post = mysqli_real_escape_string ($connection, $_POST["post"]);
				$sql = "UPDATE `posts` SET id='$postid', post='$post' WHERE id='$postid' ";
			            
			    $result = mysqli_query($connection, $sql);

			
			   	
		}

} elseif(isset($_POST['postita'])) {

		$post = mysqli_real_escape_string ($connection, $_POST["post"]);
        $sql = "INSERT INTO `posts` (`post`) VALUES ('$post')";
        $result = mysqli_query($connection, $sql);
        $success = mysqli_insert_id($connection);

}

	$sql = "SELECT `id`, `post` FROM `posts` ";
    $result = mysqli_query($connection, $sql) or die("Sellist postitust pole!!!");
	$r = mysqli_fetch_assoc($result);

	
	$post = $r['post'];
	$postid = $r['id'];
	$postids = array();
	$posts = array();
	
	while ($r = mysqli_fetch_assoc($result)) {
            
            	array_push($posts, $r['post']);
            	array_push($postids, $r['id']);
            
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
		
		<form method="post" action="">
			<h3>Muuda postitust:</h3>
			<br>
			<textarea name = "post" placeholder = "your post here" cols="80" rows="10" required><?php echo $changablepost; ?></textarea>
			<br>
			<button type="submit" name="muuda">Muuda</button>
		</form>

		<form method="post" action="?">
			<h3>Postita siia:</h3>
			<br>
			<textarea name = "post" placeholder = "your post here" cols="80" rows="10" required></textarea>
			<br>
			<button type="submit" name="postita">Postita uus</button>
		</form>


		<div>
			<?php
				foreach ($posts as $n => $post) {
						echo "<div><p>".htmlspecialchars($posts[$n])."</p></div>";
						echo "</div>";
						echo "<a href='?postid=".$postids[$n]."'>Edit this post</a>";
					}
			?>
		</div>
	</div>
</body>
</html>