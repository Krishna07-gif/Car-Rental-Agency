<!DOCTYPE html>
<head>
  <title>Available Cars</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
    <style>
        body{
		font-family: 'Times New Roman', Times, serif;
        background-color: #E2E2E2;
        } 
    </style>
<body>
<?php
require_once('../includes/config.php') ;
$conn = connect_db("rental");
session_start();
if(!isset($_SESSION['email'])){
    echo '<form action="login.php" method="post">
          <button type="submit" name="submit">Login</button>
          </form>';
    echo '<form action="signup.php" method="post">
          <button type="submit" name="submit">Signup</button>
          </form>';
}

if (isset($_SESSION['email'])) {
    echo '<form action="logout.php" method="post">
          <button type="submit" name="submit">Logout</button>
          </form>';
}
if (isset($_SESSION['email']) && $_SESSION['role']=='client') {
    // Show number of days and start date input fields
    $num_days_input = '<input type="number" name="num_days" placeholder="Number of days" required>';
    $start_date_input = '<input type="date" name="start_date" placeholder="Start date" required>';
} else {
    // Hide number of days and start date input fields
    $num_days_input = '';
    $start_date_input = '';
}
// Connect to database and retrieve available cars

$sql = "SELECT * FROM car WHERE is_available = 1";
$result = mysqli_query($conn, $sql);

// Display available cars in a table
echo '<table>';
echo '<tr><th>Vehicle model</th><th>Vehicle number</th><th>Seating capacity</th><th>Rent per day</th><th></th></tr>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['model'] . '</td>';
    echo '<td>' . $row['vehicle_number'] . '</td>';
    echo '<td>' . $row['seating_capacity'] . '</td>';
    echo '<td>' . $row['rent_per_day'] . '</td>';
    echo '<td>';
    if (isset($_SESSION['email']) && $_SESSION['role'] == 'client') {
        // Display 'Rent Car' button for logged in customers only
        echo '<form action="rent-car.php" method="post">';
        echo '<input type="hidden" name="car_id" value="' . $row['id'] . '">';
        echo $num_days_input;
        echo $start_date_input;
        echo '<button type="submit" name="submit">Rent Car</button>';
        echo '</form>';
    }else
    {
        echo "<button onclick='fun()'>Rent Car</button>";
    }
    echo '</td>';
    echo '</tr>';
}

echo '</table>';


?>
<script>function fun(){
    window.location.href="http://localhost/dixant_programs/car/client/login.php";
}

</script>
</body>
</html>
