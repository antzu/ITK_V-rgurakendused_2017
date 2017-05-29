<?php
	function home () {

 		global $connection;
    		
    		# This is view of generated in database :
    		/*
    		
    		$sql = "SELECT `10162844-posts`.`id`, public, post ,title, `date`, user_id, `10162844-users`.`username` FROM `10162844-posts`
INNER JOIN `10162844-users` ON `10162844-users`.`id`=`10162844-posts`.`user_id` WHERE public=1 ORDER BY `date` DESC";

			*/
			
			#This is query from view :

			$sql = "SELECT * FROM `posts_username`";
            
            $result = mysqli_query($connection, $sql) or die("Sellist postitust pole!!!");
            
            $row = mysqli_num_rows($result);
            $titles = array();
            $posts = array();
            #$ids = array();
            $dates = array();
            $users = array();

            while ($r = mysqli_fetch_assoc($result)){
            
	            array_push($titles, $r['title']);
	            array_push($posts, $r['post']);
	            #array_push($ids, $r['id']);
	            array_push($dates, $r['date']);
	            array_push($users, $r['username']);
	            
	            #$sqluus = "SELECT `id`, `username` FROM `10162844-users` WHERE id='$r["user_id"]' ";
	           
            /*
            	$result2 = mysqli_query($connection, $sql2) or die("Sellist postitust pole!!!");
            	$u = mysqli_fetch_assoc($result2);
            	array_push($users, $u['username']);*/
           }
           include('views/home.html');

           
    	} 
        
?>