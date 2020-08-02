<?php
	$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
	file_put_contents('UIDContainer.php',$Write);
?>

<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
		<style>
		html {
			font-family: Arial;
			display: inline-block;
			margin: 0px auto;
			text-align: center;
		}

		ul.topnav {
			list-style-type: none;
			margin: auto;
			padding: 0;
			overflow: hidden;
			background-color: blue;
			width: 100%;
		}

		ul.topnav li {float: left;}

		ul.topnav li a {
			display: block;
			color: white;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
		}

		ul.topnav li a:hover:not(.active) {background-color: skyblue;}

		ul.topnav li a.active {background-color: #333;}

		ul.topnav li.right {float: right;}

		@media screen and (max-width: 600px) {
			ul.topnav li.right, 
			ul.topnav li {float: none;}
		}
		
		img {
			display: block;
			margin-left: auto;
			margin-right: auto;
		}
            h1{
                color: blue;
                font-family: serif;
            }
            h2{
                font-family: serif;
                color: black;
            }
            .footer{
                font-family: sans-serif;
                color: blueviolet;
                font-size: 45;
                position: fixed;
                width: 100%;
                bottom: 0;
                left: 0;
                text-align: center;
            }
		</style>
		
		<title>PSMS RFID</title>
	</head>
	
	<body>
		<h2>PUBLIC TRANSPORT MANAGEMENT SYSTEM</h2>
		<ul class="topnav">
			<li><a class="active" href="home.php">Home</a></li>
			<li><a href="registration.php">Registration</a></li>
            <li><a href="userdata.php">User Data</a></li>
			<li><a href="readtag.php">Read Tag ID</a></li>
		</ul>
		<br>
		<h1>Welcome to <br>PUBLIC TRANSPORT MANAGEMENT SYSTEM</h1>
		
		<img src="home ok ok.jpg" alt="" style="width:55%;">
	</body>
    <footer>
    <p class="footer">&#169 Copyright PTMS Rfid :) </p>
    </footer>
</html>