<?php
 require_once('../includes/config.php') ;
 $conn = connect_db("rental");
 session_start();
if(!isset($_SESSION['email']) || $_SESSION['role']!='agency'){
    session_destroy();
    echo "<script>alert('Agency not logged in. Please Login');window.location.href = 'http://localhost/dixant_programs/car/agency/login.php';</script>";
}
$model = $_POST["model"];
$number = $_POST["number"];
$capacity = $_POST["capacity"];
$rent = $_POST["rent"];
$agency_id = $_SESSION['agency_id'];


$sql = "INSERT INTO car (model,agency_id, vehicle_number, seating_capacity, rent_per_day,is_available) VALUES ('$model','$agency_id', '$number', '$capacity', '$rent','1')";


if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Car added successfully');window.location.href = 'http://localhost/dixant_programs/car/agency/dashboard.php';</script>";
	die();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>
