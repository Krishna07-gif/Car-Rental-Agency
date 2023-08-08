<?php
// Start the session
session_start();

// Include database connection
require_once('../includes/config.php') ;
 $conn = connect_db("rental");

// Check if user is logged in as agency
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'agency') {
  // Redirect to login page if user is not an agency
  session_destroy();
    echo "<script>alert('Agency not logged in. Please Login');window.location.href = 'http://localhost/dixant_programs/car/agency/login.php';</script>";
}

// Check if car_id is provided in the URL
if (!isset($_GET['car_id'])) {
  // Redirect to manage_cars page if car_id is not provided
  header('Location: dashboard.php');
  exit();
}

echo '<form action="logout.php" method="post">
		  <button type="submit" name="submit">Logout</button>
		  </form>';


	echo '<form action="dashboard.php" method="post">
		  <button type="submit" name="submit">Dashboard</button>
		  </form>';

// Get car details from the database
$car_id = $_GET['car_id'];
$agency_id = $_SESSION['agency_id'];
$query = "SELECT * FROM car WHERE id = $car_id and agency_id=$agency_id";
$result = $conn->query($query);

// Check if car exists
if ($result->num_rows === 0) {
  // Redirect to manage_cars page if car does not exist
  header('Location: dashboard.php');
  exit();
}

// Fetch car details
$car = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Sanitize inputs
  $model = htmlspecialchars($_POST['model']);
  $number = htmlspecialchars($_POST['vehicle_number']);
  $seating_capacity = intval($_POST['seating_capacity']);
  $rent_per_day = floatval($_POST['rent_per_day']);

  // Update car details in the database
  $query = "UPDATE car SET model='$model', vehicle_number='$number', seating_capacity='$seating_capacity', rent_per_day='$rent_per_day' WHERE id=$car_id and agency_id=$agency_id";
  $conn->query($query);

  // Redirect to manage_cars page after updating car details
  header('Location: dashboard.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Car</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Edit Car</h1>
    <form method="POST">
      <label for="model">Model:</label>
      <input type="text" name="model" id="model" value="<?php echo $car['model'] ?>" required>

      <label for="number">Number:</label>
      <input type="text" name="vehicle_number" id="vehicle_number" value="<?php echo $car['vehicle_number'] ?>" required>

      <label for="seating_capacity">Seating Capacity:</label>
      <input type="number" name="seating_capacity" id="seating_capacity" value="<?php echo $car['seating_capacity'] ?>" min="1" max="10" required>

      <label for="rent_per_day">Rent Per Day:</label>
      <input type="number" name="rent_per_day" id="rent_per_day" value="<?php echo $car['rent_per_day'] ?>" min="0" max="1000" step="0.01" required>

      <button type="submit">Update Car</button>
    </form>
  </div>
</body>
</html>
