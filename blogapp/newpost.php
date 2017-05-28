<?php
	function newpost() {

		global $connection;
			if(!empty($_SESSION['username'])) {
            if(!empty($_POST['title']) && !empty($_POST['post'])){
               	
            	$title = mysqli_real_escape_string ($connection, $_POST["title"]);
               	$post = mysqli_real_escape_string ($connection, $_POST["post"]);
               	$id = mysqli_real_escape_string ($connection, $_SESSION["id"]);

                

               	$sql = "INSERT INTO `10162844-posts` (`id`, `post`, `user_id`, `title`) VALUES (null, '$post', '$id', '$title')";
               	$result = mysqli_query($connection, $sql);
               	$success = mysqli_insert_id($connection);

         		if($success =! "") {
	               	$msg ='<span class="label label-success">Thank you for posting, '.$_SESSION['username'].'</span>';
	                 header('Refresh: 2; URL = ?page=posts');
         		} else {
         			header('URL = ?page=newpost');
         		}
         		

             

               } else {

               	$msg = '<span class="label label-warning">Please fill in your post, '.$_SESSION['username'].'</span>';              	
               }
            
           } else {

           		header('URL = ?page=home');

           }

		include('views/newpost.html');
	}

?>