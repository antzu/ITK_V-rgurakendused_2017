<?php
	require_once('login.php');
	require_once('logout.php');
	require_once('home.php');
	require_once('posts.php');
	require_once('newpost.php');
	require_once('signup.php');

	function connect_db(){
	global $connection;
	$host="shareddb1b.hosting.stackcp.net";
	$user="anaava";
	$pass="t3st3r123";
	$db="10162844-blogapp-35b396";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));


	}

	function deletepost(){
		global $connection;
		if (!empty($_SESSION['username'])&&isset($_GET["postid"])) {

			$id = $_GET["postid"];


	    	$sql = "DELETE FROM `10162844-posts` WHERE id='$id'";
	            
	        $result = mysqli_query($connection, $sql) or die("Sellist postitust pole!!!");
	            
	        $row = mysqli_num_rows($result);
			echo "deleted";
			echo "<br>";
			echo '<a href="?page=posts">Back to posts</a>';
		} else {
			echo "not deleted";
			echo "<br>";
			echo '<a href="?page=posts">Back to posts</a>';
		}
	}
?>