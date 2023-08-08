<!DOCTYPE html>
<html>
<head>
	<title>Car Rental System</title>
	<style>
		.container {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
            padding-left: -10%; 
		
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
		.p{
			font-size: 2.5em;
		}
		body {
			font-family: 'Times New Roman', Times, serif;
			display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-image: url('runn.jpg');
            background-repeat: no-repeat;
			background-size: cover;
        }
	</style>
</head>
<body>
      <p><center><h1 style="font-size: 50px;">Fleet of Rental Cars</h1></center></p>
	<div class="container">
		<a class="link" href="client">Client</a>
		<a class="link" href="agency">Agency</a>
	</div>
</body>
</html>
