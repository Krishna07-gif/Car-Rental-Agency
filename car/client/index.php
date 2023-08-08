<!DOCTYPE html>
<html>
<head>
	<title>Client</title>
	<style>
		.container {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
            height: 95vh;
            width: 80%;
           
		}
		.link {
			font-size: 24px;
			margin: 10px;
			padding: 10px;
			border: 2px solid black;
			border-radius: 10px;
			text-align: center;
			width: 200px;
			text-decoration: none;
			color: black;
			background-color: #E6E6FA;
		}
		.link:hover {
			background-color: #B0C4DE;
		}
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('1.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
	</style>
</head>
<body>
	<div class="container">
		<a class="link" href="login.php">Login</a>
		<a class="link" href="signup.php">Signup</a>
        <a class="link" href="dashboard.php">Rent Car</a>
	</div>
</body>
</html>
