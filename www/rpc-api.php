<?php
	include "includes.php";
	
	/**
	 * @author Jure Murovec <murovec.jure@gmail.com>
	 * @link https://github.com/MuriJ/MSISDN-Splitter
	 */
	class JsonRpcServer
	{
		/**
		 * @param String $splitMSISDN containing MSISDN number
		 *			 			 
		 * @return \Object
		 */
		public function splitMSISDN($splitMSISDN){
			$MSISDN = str_replace('-','',str_replace(' ','',ltrim(ltrim(trim($splitMSISDN),"+"),"00")));
			$out = new stdClass;
			
			/**
			 * Some input validation
			 */
			if(empty($MSISDN)){
				$out->Error = "Input a number.";
				return json_encode($out);
			}
			if(!is_numeric($MSISDN)){
				$out->Error = "Only numbers permitted.";
				return json_encode($out);
			}
			if(strlen($MSISDN) < 8){
				$out->Error = "Number is to short.";
				return json_encode($out);
			}
			if(strlen($MSISDN) > 15){
				$out->Error = "Number is to long.";
				return json_encode($out);
			}
			
			/**
			 * Searches the countries.json for a county code starting with the first 3 numbers and decrease to 1
			 */
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
			if(empty($country)){
				$out->Error = "Unknown county.";
				return json_encode($out);
			}
			
			/**
			 * If the selested county has a Local codes array set,  search for MNO otherwise just return NDCMax number of chars
			 */
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
						
			$out->MSISDN = $MSISDN;
			$out->Dial = $country[0]->Dial;
			$out->Code = $Code;
			$out->Number = $Number;
			$out->Country = $country[0]->ISO31661Alpha2;			
			$out->MNO = $MNO;
			
			return json_encode($out);
		}
	}

	$server = new JsonRpc( new JsonRpcServer() );
    $server->process();
?>