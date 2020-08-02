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
		
		.table {
			margin: auto;
			width: 90%; 
		}
		
		thead {
			color: #FFFFFF;
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
		
		<title>User Data</title>
	</head>
	
	<body>
		<h2>PUBLIC TRANSPORT MANAGEMENT SYSTEM</h2>
		<ul class="topnav">
			<li><a href="home.php">Home</a></li>
            <li><a href="registration.php">Registration</a></li>
			<li><a class="active" href="userdata.php">User Data</a></li>
			<li><a href="readtag.php">Read Tag ID</a></li>
		</ul>
		<br>
		<div class="container">
            <div class="row">
                <h3>RFID USER DATA </h3>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr bgcolor="#10a0c5" color="#FFFFFF">
                      <th>ID</th>
                      <th>Terminal Name</th>
					 	  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM table_nodemcu_rfidrc522_mysql';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id'] . '</td>';
                            echo '<td>'. $row['sp'] . '</td>';
							echo '<td><a class="btn btn-success" href="userdataeditpage.php?id='.$row['id'].'">Edit</a>';
							echo ' ';
							echo '<a class="btn btn-danger" href="userdatadeletepage.php?id='.$row['id'].'">Delete</a>';
							echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
				</table>
			</div>
		</div> <!-- /container -->
	</body>
    <footer>
    <p class="footer">&#169 Copyright PTMS Rfid :) </p>
    </footer>
</html>