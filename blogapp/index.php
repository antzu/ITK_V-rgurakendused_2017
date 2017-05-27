<?php
	require_once('functions.php');

	ob_start();
	session_start();
	connect_db();

	$page="home";
	if (isset($_GET['page']) && $_GET['page']!=""){
		$page=htmlspecialchars($_GET['page']);
	}

	include_once('views/head.html');

	switch ($page) {

		case 'login':
			login();
			break;
		case 'logout':
			logout();
			
		case 'home':
			home();
			break;

		default:
			home();
			break;

	}

	include_once('views/foot.html');
	

?>