<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>VM Server Add Prop</title>
</head>
<body>
	<div>MSISDN</div>
	
	<?php
		$countries = json_decode(file_get_contents("../data/countries.json"));
		
		foreach($countries as $country){
			$country->NDCMin = 2;
			$country->NDCMax = 2;	
			//unset($country->NDCMax);
		}
		
		//var_dump($countries);
	    echo json_encode($countries);
		//print_r($countries);
		?>
</body>
</html>