<?php 
	$errors = array();

	// presence
	function has_presence($value)
	{
		return isset($value) && $value !== "";
	}
	
	function validate_presences($required_fields)
	{
		global $errors;
		foreach ($required_fields as $field) {
			$value = trim($_POST[$field]);
			if(!has_presence($value)){
				$errors[$field] = ucfirst($field) . " is empty";
			}
		}
	}

	// string length
	function has_max_length($value, $max)
	{
		return strlen($value) <= $max;
	}

	function validate_max_length($fields_with_max_length)
	{
		global $errors;
		foreach ($fields_with_max_length as $field => $max) {
			$value = trim($_POST[$field]);
			if (!has_max_length($value, $max)) {
				$errors[$field] = ucfirst($field) . " is too long";	
			}
		}
	}
	// inclusion in a set
	function has_inclusion_in($value, $set)
	{
		return in_array($value, $set);
	}

?>