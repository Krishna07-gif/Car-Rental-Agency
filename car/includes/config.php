<?php
function connect_db($db){
	$host = "localhost";
	$user = "root";
	$pass = "";
	
	$conn = new mysqli($host, $user, $pass, $db);
	if($conn->connect_error){
		echo "Failed:" . $conn->connect_error;
	}
    return $conn;
}	
?>
