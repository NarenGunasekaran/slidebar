<?php 
	$servername = "localhost";
	$username = "root";
	$password = "Sellerworx123";
	$database = 'slider';

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);

	if(!$conn){
		die;
	}

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	//echo "Connected successfully";