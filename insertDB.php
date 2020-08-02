<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
		$sp = $_POST['sp'];
        $time = date('Y/m/d H:i:s');
            
		// insert data
        $pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO table_nodemcu_rfidrc522_mysql (id,sp) values(?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($id,$sp));
        Database::disconnect();
		header("Location: userdata.php");
    }
?>