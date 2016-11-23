<?php
	include "www/settings.php";
	include "www/includes.php";
	use Splitter as Sp;
	
	if ($argc !== 2) {
		echo "Usage: php test.php [MSISDN number].\n";
		exit(1);
	}
	$MSISDN = $argv[1];	

	try {		
		$client = new JsonRpc($rpc_api_url);
		$objMSISDN = json_decode($client->splitMSISDN($MSISDN));				
		if (isset($objMSISDN->Error))
		{
			throw new Exception($objMSISDN->Error);
		}
		
		echo "\n".Sp\functions::printMSISDN($objMSISDN)."\n";
	} catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
?>