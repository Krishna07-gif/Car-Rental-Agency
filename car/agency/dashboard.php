<?php
require_once('../includes/config.php') ;
$conn = connect_db("rental");
session_start();
if(!isset($_SESSION['email']) || $_SESSION['role']!='agency'){
	session_destroy();
    echo "<script>alert('Agency not logged in. Please Login');window.location.href = 'http://localhost/dixant_programs/car/agency/login.php';</script>";
}

	echo '<form action="logout.php" method="post">
		  <button type="submit" name="submit">Logout</button>
		  </form>';


	echo '<form action="booked.php" method="post">
		  <button type="submit" name="submit">View Booking</button>
		  </form>';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Add New Cars</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<style>
	body{
		font-family: 'Times New Roman', Times, serif;
        background-image: url('8.jpg');
        }
</style>
<body>
	<div class="container">
		<center><h1 style="font-size: 40px; color: black;">Add New Cars</h1></center>
		<form action="add_car.php" method="post">
			<label for="model">Vehicle Model:</label>
			<input type="text" id="model" name="model" required><br><br>

			<label for="number">Vehicle Number:</label>
			<input type="text" id="number" name="number" required><br><br>

			<label for="capacity">Seating Capacity:</label>
			<input type="number" id="capacity" name="capacity" required><br><br>

			<label for="rent">Rent Per Day:</label>
			<input type="number" id="rent" name="rent" required><br><br>

			<input type="submit" value="Add Car">
		</form>

		<h2 style="font-size: 30px; color: black;">Edit Existing Cars</h2>
		<table>
			<tr>
				<th>Vehicle Model</th>
				<th>Vehicle Number</th>
				<th>Seating Capacity</th>
				<th>Rent Per Day</th>
				<th>Action</th>
			</tr>
			<?php
            $id = $_SESSION['agency_id'];
			$sql = "SELECT * FROM car where agency_id='$id'";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr><td>".$row["model"]."</td><td>".$row["vehicle_number"]."</td><td>".$row["seating_capacity"]."</td><td>".$row["rent_per_day"]."</td><td><a href='edit_car.php?car_id=".$row["id"]."'>Edit</a></td></tr>";
				}
			} 
			?>
		</table>
	</div>
</body>
</html>
