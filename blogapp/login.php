<?php
      function login() {
         global $connection;
            $msg = '';
            if(!empty($_SESSION["username"])){
               header("Location: ?page=home");
            } elseif(isset($_POST['login']) &&!empty($_POST['username']) &&!empty($_POST['password'])) {

               $username = mysqli_real_escape_string ($connection, $_POST["username"]);
               $password = mysqli_real_escape_string ($connection, $_POST["password"]);
               $sql = "SELECT `id` FROM `10162844-users` WHERE username='$username' AND password='$password' ";
               $result = mysqli_query($connection, $sql);
               $rida = mysqli_num_rows($result);

               if ($rida) {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $_POST["username"];
                  
                  echo 'You have entered valid use name and password';
                  header('Refresh: 2; URL = ?page=login');
               }else {
                  $msg = 'Wrong username or password';
               }
            }
               include('views/login.html');
            }
               
?>