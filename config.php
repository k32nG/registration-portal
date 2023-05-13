<?php
	error_reporting(E_ALL ^ E_NOTICE);

	if(isset($_GET['logout-submit']) && $_GET['logout-submit'] == 'logout') {
		session_unset();
		session_destroy();
		header('location:login.php');
	}
        
    // database credentials
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'user_database');

    // create database connection
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // check connection
    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>