<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
            }

    $time = date('Y/m/d H:i:s');
    $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM table_nodemcu_rfidrc522_mysql where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
    $msg = null;
	if (null==$data['sp']) {
		$msg = "The ID of your Card / KeyChain is not registered !!!";
		$data['id']=$id;
		
		$data['sp']="--------";
					} else {
		$msg = null;
	}
        $sql2 = "INSERT INTO logdata (id, time) values(?, ?)";
		$s = $pdo->prepare($sql2);
		$s->execute(array($id,$time));




Database::disconnect();
	
	
    
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
	<style>
		td.lf {
			padding-left: 15px;
			padding-top: 12px;
			padding-bottom: 12px;
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
</head>
 
	<body>	
		<div>
			<form>
				<table  width="452" border="1" bordercolor="#10a0c5" align="center"  cellpadding="0" cellspacing="1"  bgcolor="#000" style="padding: 2px">
					<tr>
						<td  height="40" align="center"  bgcolor="#10a0c5"><font  color="#FFFFFF">
						<b>User Data</b></font></td>
					</tr>
					<tr>
						<td bgcolor="#f9f9f9">
							<table width="452"  border="0" align="center" cellpadding="5"  cellspacing="0">
								<tr>
									<td width="113" align="left" class="lf">ID</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['id'];?></td>
								</tr>
								
								<tr>
									<td align="left" class="lf">Terminal Name</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['sp'];?></td>
								</tr>
								
								
							</table>
                            <table class="table table-striped table-bordered">
                  <thead>
                    <tr bgcolor="#10a0c5" color="#FFFFFF">
                      <th>ID</th>
                      <th>Time</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   $sql = 'SELECT * FROM logdata';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id'] . '</td>';
                            echo '<td>'. $row['time'] . '</td>';
							echo '</tr>';
                   }
                                     ?>
                  </tbody>
				</table>
						</td>
					</tr>
				</table>
                
			</form>
		</div>
		<p style="color:red;"><?php echo $msg;?></p>
	</body>
    <footer>
    <p class="footer">&#169 Copyright PTMS Rfid :) </p>
    </footer>
</html>