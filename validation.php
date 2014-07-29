<!DOCTYPE html>
<html>
<head>
	<title>Validations</title>
</head>
<body>

	<?php 
		// presence
		$value = trim("0");
		if (!isset($value) || $value === "") {
			echo "Validation failed (presence).<br />";
		}
		
		// string length
		$value = "absd";
		$min = 3;
		if (strlen($value) < $min) {
			echo "Validation failed (min length).<br />";
		}	
		$max = 3;
		if (strlen($value) < $max) {
			echo "Validation failed (max length).<br />";
		}

		//type
		$value = "1";
		if (!is_string($value)) {
			echo "Validation failed (type).<br />";
		}

		// inclusion in a set
		$value = "1";
		$set = array('1', '2', '3', '4');
		if (!in_array($value, $set)) {
			echo "Validation failed (set).<br />";
		}

		// format
		if (preg_match("/PHP/", "PHP is fun.")) {
			echo "A match was found.<br />";
		} else {
			echo "A match was not found.<br />";
		}

		$value = "nobody@nowhere.com";
		if (!preg_match("/@/", $value)) {
			echo "Validation failed (regex).<br />";
		}	

		if (strpos($value, "@") === false) {
			echo "Validation failed (strpos).<br />";
		}
	?>
</body>
</html>
