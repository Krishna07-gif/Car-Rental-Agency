<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<style> 
    body{
		font-family: 'Times New Roman', Times, serif;
            background-image: url('2.jpg');
        }
</style>
<body>
        <h2 style="font-size: 50px; color: blanchedalmond;">Login Form</h2>
	    <form action="" method="post">
		<label>Email:</label>
		<input type="text" name="email"><br>
		<label>Password:</label>
		<input type="password" name="password"><br>
		<input type="submit" name="submit" value="Submit">
		<a href='signup.php' style="float:right">Signup</a>
	</form>
	<?php
    require_once('../includes/config.php') ;
	$conn = connect_db("rental");
    session_start();
	if(isset($_SESSION['email']) && isset($_SESSION['role']) && $_SESSION['role']=='client'){
		header('Location: dashboard.php');
		exit();
	}
	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$password = md5($_POST['password']);
        $query = "select * from client where email='$email' and password='$password'";
        $res = $conn->query($query);
        if($res->num_rows==0){
            echo "<script>alert('Log in failed');window.location.href = 'http://localhost/dixant_programs/car/client/login.php';</script>";
            
        }else{
            $_SESSION['email']=$email;
			$_SESSION['role']='client';
            $res1 = $res->fetch_array();
            $_SESSION['client_id'] = $res1['id'];
			
            echo "<script>alert('Log in successful');window.location.href = 'http://localhost/dixant_programs/car/client/dashboard.php';</script>";
            
        }
        die();
		
	}
	?>
</body>
</html>
