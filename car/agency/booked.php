<?php
require_once('../includes/config.php') ;
$conn = connect_db("rental");
session_start();
if(!isset($_SESSION['email'])){
	session_destroy();
	echo "<script>alert('Agency not logged in. Please Login');window.location.href = 'http://localhost/dixant_programs/car/agency/login.php';</script>";
}
if (isset($_SESSION['email'])) {
	echo '<form action="logout.php" method="post">
		  <button type="submit" name="submit">Logout</button>
		  </form>';
}
if (isset($_SESSION['email']) && $_SESSION['role']=='agency') {
	echo '<form action="dashboard.php" method="post">
		  <button type="submit" name="submit">Dashboard</button>
		  </form>';
}
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
            background-image: url('9.jpg');
        }
</style>
<body>
	<div class="container">
		

		<h2 style="font-size: 40px; color: black;">Booked car Info </h2>
		<table>
			<tr>
				<th>Client Name</th>
				<th>Car Model</th>
				<th>Client Phone</th>
				<th>Car number</th>
			</tr>
			<?php
            $id = $_SESSION['agency_id'];
			$sql = "SELECT c.name,a.model,c.phone,a.vehicle_number FROM car a join bookings b on a.id=b.car_id join client c on b.client_id = c.id where a.agency_id=$id";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr><td>".$row["name"]."</td><td>".$row["model"]."</td><td>".$row["phone"]."</td><td>".$row["vehicle_number"]."</td></tr>";
				}
			} 
			?>
		</table>
	</div>
</body>
</html>
