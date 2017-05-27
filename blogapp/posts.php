<?php
	function posts() {
		global $connection;
		include('views/posts.html');
		
		$user_id = $_SESSION["id"];

		$sql = "SELECT `post`, `title` FROM `10162844-posts` WHERE user_id='1' ";
        
        $result = mysqli_query($connection, $sql) or die("Sellist postitust pole!!!");
        
        $row = mysqli_num_rows($result);
        while ($r = mysqli_fetch_assoc($result)){

        echo $r["title"];
        echo "<br>";
        echo $r["post"];
        echo "<br><br>";


       }
	}
?>