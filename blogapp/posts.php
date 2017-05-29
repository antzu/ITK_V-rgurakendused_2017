<?php
	function posts() {
        if (!empty($_SESSION['username'])) {
            
        
    		global $connection;
    		
    		
    		$user_id = $_SESSION["id"];


    		$sql = "SELECT `id`, `post`, `title`, `date` FROM `10162844-posts` WHERE user_id='$user_id' ORDER BY `date` DESC ";
            
            $result = mysqli_query($connection, $sql) or die("Sellist postitust pole!!!");
            
            $row = mysqli_num_rows($result);
            $titles = array();
            $posts = array();
            $ids = array();
            $dates = array();

            while ($r = mysqli_fetch_assoc($result)){
            
            array_push($titles, $r['title']);
            array_push($posts, $r['post']);
            array_push($ids, $r['id']);
            array_push($dates, $r['date']);
           }
           
    	} else {
            
            header("Location: ?page=home");
        }
        include('views/posts.html');
    }
?>