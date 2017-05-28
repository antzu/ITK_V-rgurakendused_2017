<?php
      function login() {
         global $connection;
            $msg = '';
            if(!empty($_SESSION["username"])){
               header("Location: ?page=home");
            } elseif(isset($_POST['login']) &&!empty($_POST['username']) &&!empty($_POST['password'])) {

               $username = mysqli_real_escape_string ($connection, $_POST["username"]);
               $password = mysqli_real_escape_string ($connection, $_POST["password"]);
               $password = md5(md5('salt').$password);
               $sql = "SELECT `id` FROM `10162844-users` WHERE username='$username' AND password='$password' ";
               $result = mysqli_query($connection, $sql);
               $row = mysqli_num_rows($result);
               $id = mysqli_fetch_assoc($result);

               if ($row) {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $_POST["username"];
                  $_SESSION['id'] = $id["id"];
                  
                  $msg ='<span class="label label-success">You have entered valid use name and password</span>';
                  header('Refresh: 1; URL = ?page=login');
               }else {
                  $msg = '<span class="label label-danger">Wrong username or password</span>';
               }
            }
               include('views/login.html');
            }
               
?>