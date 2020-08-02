<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM table_nodemcu_rfidrc522_mysql where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
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
		}
		
		textarea {
			resize: none;
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
		
		<title>RFID Edit</title>
		
	</head>
	
	<body>

		<h2 align="center">PUBLIC TRANASPORT MANAGEMENT SYSTEM</h2>
		
		<div class="container">
     
			<div class="center" style="margin: 0 auto; width:495px; border-style: solid; border-color: #f2f2f2;">
				<div class="row">
					<h3 align="center">Edit RFID User Data</h3>
					<p id="defaultGender" hidden><?php echo $data['gender'];?></p>
				</div>
		 
				<form class="form-horizontal" action="userdataedittb.php?id=<?php echo $id?>" method="post">
					<div class="control-group">
						<label class="control-label">CARD ID</label>
						<div class="controls">
							<input name="id" type="text"  placeholder="" value="<?php echo $data['id'];?>" readonly>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Bus Number</label>
						<div class="controls">
							<input name="busnumber" type="text"  placeholder="" value="<?php echo $data['busnumber'];?>" required>
						</div>
					</div>
					
				    <div class="control-group">
						<label class="control-label">STARTING POINT</label>
						<div class="controls">
							<select name="sp">
								<option value="J P Nagar">J P Nagar</option>
								<option value="Banashankari">Banashankari</option>
                                <option value="MAJESTIC">MAJESTIC</option>
							</select>
						</div>
					</div>
                    
                    	<div class="control-group">
						<label class="control-label">DESTINATION POINT</label>
						<div class="controls">
							<select name="dp">
							<option value="J P Nagar">J P Nagar</option>
								<option value="Banashankari">Banashankari</option>
                                <option value="MAJESTIC">MAJESTIC</option>
							</select>
						</div>
					
							
					<div class="form-actions">
						<button type="submit" class="btn btn-success">Update</button>
						<a class="btn" href="user data.php">Back</a>
					</div>
				</form>
			</div>               
		</div> <!-- /container -->	
		
		<script>
			var g = document.getElementById("defaultGender").innerHTML;
			if(g=="Male") {
				document.getElementById("mySelect").selectedIndex = "0";
			} else {
				document.getElementById("mySelect").selectedIndex = "1";
			}
		</script>
	</body>
        <footer>
    <p class="footer">&#169 Copyright PTMS Rfid :) </p>
    </footer>
</html>