<?php
	function posts() {
        if (!empty($_SESSION['username'])) {
            
        
    		global $connection;
    		include('views/posts.html');
    		
    		$user_id = $_SESSION["id"];


    		$sql = "SELECT `post`, `title` FROM `10162844-posts` WHERE user_id='$user_id' ";
            
            $result = mysqli_query($connection, $sql) or die("Sellist postitust pole!!!");
            
            $row = mysqli_num_rows($result);
            while ($r = mysqli_fetch_assoc($result)){

            echo "<h3>".$r["title"]."</h3>";
            echo "<p>".$r["post"]."</p>";
            echo "<br>";


           }
    	} else {
            header("Location: ?page=home");
        }
    }
?>