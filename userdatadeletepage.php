<?php
    require 'database.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM table_nodemcu_rfidrc522_mysql  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: userdata.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
	<title>Delete Details</title>
     <style>
    .footer{
                font-family: sans-serif;
                color: blueviolet;
                font-size: 45;
                position: fixed;
                width: 100%;
                bottom: 0;
                left: 0;
                text-align: center;
            }</style>
 
</head>
   
<body>
	<h2 align="center">PUBLIC TRANSPORT MANAGEMENT SYSTEM</h2>

    <div class="container">
     
		<div class="span10 offset1">
			<div class="row">
				<h3 align="center">Delete User</h3>
			</div>

			<form class="form-horizontal" action="userdatadeletepage.php" method="post">
				<input type="hidden" name="id" value="<?php echo $id;?>"/>
				<p class="alert alert-error">Are you sure to delete ?</p>
				<div class="form-actions">
					<button type="submit" class="btn btn-danger">Yes</button>
					<a class="btn" href="userdata.php">No</a>
				</div>
			</form>
		</div>
                 
    </div> <!-- /container -->
  </body>
    <footer>
    <p class="footer">&#169 Copyright PTMS Rfid :) </p>
    </footer>
</html>