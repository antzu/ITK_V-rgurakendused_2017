<?php
      function login() {
            $msg = '';
            if(!empty($_SESSION["username"])){
               header("Location: ?page=home");
            } elseif(isset($_POST['login']) &&!empty($_POST['username']) &&!empty($_POST['password'])) {
            
               if ($_POST['username'] == 'tutorialspoint' && 
                  $_POST['password'] == '1234') {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = 'tutorialspoint';
                  
                  echo 'You have entered valid use name and password';
                  header('Refresh: 2; URL = ?page=login');
               }else {
                  $msg = 'Wrong username or password';
               }
            }
               include('views/login.html');
            }
            
         
?>