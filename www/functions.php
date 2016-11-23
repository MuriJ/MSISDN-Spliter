<?php
	namespace Splitter{
		class functions{
			static function printMSISDN($obj){			
				return ("MNO identifier: $obj->MNO ($obj->Code)\n".
						"Country dialling code: $obj->Dial\n".
						"Subscriber number: $obj->Number\n".
						"Country identifier: $obj->Country\n");
				}
		}
	}
?>