
<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
		$busnumber = $_POST['busnumber'];
        $sp = $_POST['sp'];
        $dp = $_POST['dp'];
                 
        $pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE table_nodemcu_rfidrc522_mysql  set busnumber = ?, sp =?, dp =? WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($busnumber,$sp,$dp,$id));
		Database::disconnect();
		header("Location: userdata.php");
    }
?>