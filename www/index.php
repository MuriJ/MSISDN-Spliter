<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>VM Server</title>
</head>
<body>	
	<?php
		error_reporting(E_ALL);
		ini_set('display_errors', 1);				

		function splitMSISDN($splitMSISDN){
			$MSISDN = str_replace('-','',str_replace(' ','',ltrim(trim($splitMSISDN),"+")));			
			$countries = json_decode(file_get_contents("../data/countries.json"));
			
			for ($x = 3; $x >= 1; $x--) {
				$search = substr($MSISDN,0,$x);
				$country = array_values(array_filter($countries, function($obj) use ($search){
											return($obj->Dial == $search);		
										}));
				if(!empty($country)){
					break;
				}
			}
			
			$phone = substr($MSISDN,$x);									
			if (isset($country[0]->Codes)){
				for ($x = $country[0]->NDCMax; $x >= $country[0]->NDCMin; $x--) {
					$cityCode = substr($phone,0,$x);
					$aMNO = array_values(array_filter($country[0]->Codes, function($obj) use ($cityCode){
												return($obj->Code == $cityCode);		
											}));
					if(!empty($aMNO)){
						break;
					}
				}
			}			
			
			if(empty($aMNO)){								
				$MNO = "";
				$Code = substr($phone,0,$country[0]->NDCMax);
				$Number = substr($phone,$country[0]->NDCMax);							
			}else{
				$MNO = $aMNO[0]->MNO;
				$Code = $aMNO[0]->Code;
				$Number = substr($phone,strlen($aMNO[0]->Code));
			}		
			
			$out = new stdClass;
			$out->MSISDN = $MSISDN;
			$out->Dial = $country[0]->Dial;
			$out->Code = $Code;
			$out->Number = $Number;
			$out->Country = $country[0]->ISO31661Alpha2;			
			$out->MNO = $MNO;
			
			return $out;
		}
		function printMSISDN($obj){
			echo nl2br("MSISDN - ".$obj->MSISDN."\n");
			echo nl2br($obj->Dial." - ".$obj->Country."\n");
			echo nl2br($obj->Code.(!empty($obj->MNO) ? " - " : "").$obj->MNO."\n");
			echo nl2br($obj->Number."\n");
			echo nl2br("\n");
		}
		
		$objMSISDN = splitMSISDN("+386 40 504 267");
		echo json_encode($objMSISDN)."<br><br>";
		
		printMSISDN($objMSISDN);
		printMSISDN(splitMSISDN("38604332205"));
		printMSISDN(splitMSISDN("+385 42 225 984"));
		printMSISDN(splitMSISDN("1-541-754-3010"));
	?>
</body>
</html>