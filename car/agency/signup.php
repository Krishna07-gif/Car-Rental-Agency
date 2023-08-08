<!DOCTYPE html>
<html>
<head>
	<title>Signup Page</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<style>
	body{
		font-family: 'Times New Roman', Times, serif;
        background-image: url('7.jpg');
        }
</style>
<body>
	<h2 style="color: blanchedalmond; font-size: 50px;">Signup Form</h2>
	<form action="" method="post">
        <label>Agency Name:</label>
		<input type="text" name="name"><br>
		<label>Email:</label>
		<input type="text" name="email"><br>
		<label>Password:</label>
		<input type="password" name="password"><br>
		<label>Phone Number:</label>
		<input type="text" name="phone"><br>
		<label>Address:</label>
		<textarea name="address"></textarea><br>
		<input type="submit" name="submit" value="Submit">
		<a href='login.php' style="float:right">Login</a>
	</form>
	<?php
	require_once('../includes/config.php') ;
	session_start();
	if(isset($_SESSION['email']) && isset($_SESSION['role']) && $_SESSION['role']=='agency'){
		header('Location: dashboard.php');
		exit();
	}
	$conn = connect_db("rental");
	$query = "select * from agency";
	$res = $conn->query($query);
	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$phone = $_POST['phone'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		$email_check = "select * from agency where email='$email'";
		$res = $conn->query($email_check);
		if($res->num_rows!=0){
			echo "<script>alert('Email already exist');window.location.href = 'http://localhost/dixant_programs/car/agency/signup.php';</script>";
			die();
		}
		$query = "insert into agency (name,email,password,phone,address) values ('$name','$email','$password','$phone','$address')";
		echo $query;
		if($conn->query($query)){
			$_SESSION['email']=$email;
			$_SESSION['role']='agency';
            $get_id = "select id from agency where email='$email'";
            $res1 = $conn->query($get_id);
            $res1 = $res1->fetch_row();
			var_dump($res1);
            $_SESSION['agency_id'] = $res1[0];
            echo "<script>alert('Sign up successful');window.location.href = 'http://localhost/dixant_programs/car/agency/dashboard.php';</script>";
			die();
		}else{
			echo "<script>alert('Sign up Failed');window.location.href = 'http://localhost/dixant_programs/car/agency/signup.php';</script>";
			die();
		}
	}
	?>
</body>
</html>
