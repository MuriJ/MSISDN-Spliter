<?php
	function printMSISDN($obj){			
			echo "MNO identifier: $obj->MNO ($obj->Code)<br>
			      Country dialling code: $obj->Dial<br>
				  Subscriber number: $obj->Number<br>
				  Country identifier: $obj->Country";
		}
?>