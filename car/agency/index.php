<!DOCTYPE html>
<html>
<head>
	<title>Agency</title>
	<style>
		.container {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			height: 100vh;
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
			font-family: 'Times New Roman', Times, serif;
			display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('5.jpg');
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
	</div>
</body>
</html>
