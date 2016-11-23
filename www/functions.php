<?php
	namespace Splitter{
		/**
		 * @author Jure Murovec <murovec.jure@gmail.com>
		 * @link https://github.com/MuriJ/MSISDN-Splitter
		 */
		class functions{			
			/**
			 * @param object $obj stdClass class containing properties(MSISDN,Dial,Code,Number,Country,MNO)
			 *
             * @throws \InvalidArgumentException
			 *			 			 
			 * @return \String
			 */
			static function printMSISDN($obj){
				if (!is_object($obj) || !isset($obj->MNO)) 
					throw new \InvalidArgumentException("printMSISDN function only accepts objects with parameters(MSISDN,Dial,Code,Number,Country,MNO).");				
	
				return ("MNO identifier: $obj->MNO ($obj->Code)\n".
						"Country dialling code: $obj->Dial\n".
						"Subscriber number: $obj->Number\n".
						"Country identifier: $obj->Country\n");
				}
		}
	}
?>