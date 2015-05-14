<?php

createDB();

function createDB(){
	$servername = "localhost";//change to your host
	$username = "root";//change to your username
	$password = "";//add password
	$dbname = "location";

	// Create connection
	$conn = new mysqli($servername, $username, $password);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	// Create database
	$sql = "CREATE DATABASE ".$dbname;
	if ($conn->query($sql) === TRUE) {
		echo "Database created successfully";
	} else {
		echo "Error creating database: " . $conn->error;
	}
	$conn->close();
	createTBL();
}
function createTBL(){
	
	$servername = "localhost";//change to your host
	$username = "root";//change to your username
	$password = "";//add password
	$dbname = "location";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	// sql to create table
	$sql = "CREATE TABLE latlong (
	name VARCHAR(32), 
	lat FLOAT(10),
	lng FLOAT(10)
	)";

	if ($conn->query($sql) === TRUE) {
		echo "Table MyGuests created successfully";
	} else {
		echo "Error creating table: " . $conn->error;
	}	
	
}
?>