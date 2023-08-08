<!DOCTYPE html>
<html>
<head>
	<title>Signup Page</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<style>
	body{
		font-family: 'Times New Roman', Times, serif;
        background-image: url('3.jpg');
        }
</style>
<body>
        <h2 style="color: blanchedalmond; font-size: 50px;">Signup Form</h2>
	    <form action="" method="post">
	    <label>Name:</label>
		<input type="text" name="name"><br>
		<label>Email:</label>
		<input type="text" name="email"><br>
		<label>Password:</label>
		<input type="password" name="password"><br>
		<label>Phone Number:</label>
		<input type="text" name="phone"><br>
        <div class="form-group">
          <label for="gender">Gender:</label>
            <div class="row">
              <div class="col-sm-2">
                <label class="radio-inline">
                  <input type="radio" name="gender" value="Male" checked>Male
                </label>
            </div>
               <div class="col-sm-2">
                  <label class="radio-inline">
                    <input type="radio" name="gender" value="Female">Female
                  </label>
               </div>
            </div>
        </div>

		<label>Address:</label>
		<textarea name="address"></textarea><br>
		<input type="submit" name="submit" value="Submit">
		<a href='login.php' style="float:right">Login</a>
	</form>
	<?php
	require_once('../includes/config.php') ;
	session_start();
	if(isset($_SESSION['email']) && isset($_SESSION['role']) && $_SESSION['role']=='client'){
		header('Location: dashboard.php');
		exit();
	}
	$conn = connect_db("rental");
	$query = "select * from client";
	$res = $conn->query($query);
	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$phone = $_POST['phone'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		$gender = $_POST['gender'];
		$email_check = "select * from client where email='$email'";
		$res = $conn->query($email_check);
		if($res->num_rows!=0){
			echo "<script>alert('Email already exist');window.location.href = 'http://localhost/dixant_programs/car/client/signup.php';</script>";
			die();
		}
		$query = "insert into client (name,email,password,gender,phone,address,status) values ('$name','$email','$password','$gender','$phone','$address','0')";
		echo $query;
		if($conn->query($query)){
			$_SESSION['email']=$email;
			$_SESSION['role']='client';
			$get_id = "select id from client where email='$email'";
            $res1 = $conn->query($get_id);
            $res1 = $res1->fetch_row();
            $_SESSION['client_id'] = $res1[0];
			echo "<script>alert('Sign up successful');window.location.href = 'http://localhost/dixant_programs/car/client/dashboard.php';</script>";
			die();
		}else{
			echo "<script>alert('Sign up Failed');window.location.href = 'http://localhost/dixant_programs/car/client/signup.php';</script>";
			die();
		}
	}
	?>
</body>
</html>
