<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>MSISDN Splitter</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="Description" lang="en" content="MSISDN Splitter">
		<meta name="author" content="MuriJ">
		<meta name="robots" content="index, follow">

		<link rel="shortcut icon" href="assets/img/favicon.ico">
		<link rel="stylesheet" href="assets/css/styles.css">
		
		<?php
			include "settings.php";		
			include "includes.php";
			use Splitter as Sp;
		?>
	</head>
	<body>
		<div class="header">
			<div class="container">
				<h1 class="header-heading">MSISDN Splitter</h1>
			</div>
		</div>
		<div class="nav-bar">
			<div class="container">				
			</div>
		</div>
		<div class="content">
			<div class="container">
				<div class="main">
					<div style="margin:0px 0px 10px 0px; font-size:12px;">
						<b>Input samples:</b><br>
						+386 40 504 267<br>
						38604332205<br>
						+385 42 225 984<br>
						1-541-754-3010<br>
						0038631981315<br>
					</div>
					<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
					  MSISDN:<br>
					  <input type="text" name="MSISDN" value="<?php echo (empty($_POST) ? "+386 40 504 267" : $_POST["MSISDN"]); ?>">					  
					  <input type="submit" value="Submit">
					</form> 
					<hr>
					
					<?php				
						try {
							if (!empty($_POST)){
								$client = new JsonRpc($rpc_api_url);
								$objMSISDN = json_decode($client->splitMSISDN($_POST["MSISDN"]));				
								if (isset($objMSISDN->Error))
								{
									throw new Exception($objMSISDN->Error);
								}
																
								echo nl2br(Sp\functions::printMSISDN($objMSISDN));
							}
						} catch (Exception $e) {
							echo 'Caught exception: ',  $e->getMessage();
						}											
					?>
				</div>
			</div>
		</div>
		<div class="footer">
			<div class="container">
				&copy; Copyright 2016
			</div>
		</div>
	</body>
</html>