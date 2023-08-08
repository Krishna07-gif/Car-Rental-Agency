<?php
// Include database configuration file
require_once('../includes/config.php') ;
$conn = connect_db("rental");
session_start();


if (!isset($_SESSION['email']) || $_SESSION['role']!='client') {
    // Redirect to login page
    header('Location: logout.php');
    exit;
}


    $car_id = $_POST['car_id'];
    $days = $_POST['num_days'];
    $start_date = $_POST['start_date'];
    $client_id = $_SESSION['client_id'];
    // Get car info from the database
    $query = "SELECT * FROM car WHERE id = $car_id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $car = mysqli_fetch_assoc($result);
        $rent = $car['rent_per_day'];
        $total = $rent * $days;

        // Insert booking info into bookings table
        $query = "INSERT INTO bookings (car_id, client_id, days,start_date ,total_cost,status) VALUES ($car_id, $client_id, $days,'$start_date', $total,'1')";
        
        mysqli_query($conn, $query);
        
    } else {
        echo "<script>alert('car not found');window.location.href = 'http://localhost/dixant_programs/car/client/dashboard.php';</script>";
        die();
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Rent Car</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="container">
        <h2>Booking successful</h2>
        <a href="dashboard.php"> Dashboard </a><br><br>
        <a href="logout.php"> Logout </a>
    </div>
</body>
</html>
