<?php 
	session_start();

	function message()
	{
		if (isset($_SESSION["message"])) {
			$output  = "<div class=\"message\">";
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			// clear message after use
			$_SESSION["message"] = null;
			return $output;
		} 
	}
	function errors()
	{
		if (isset($_SESSION["fehler"])) {
			$errors = $_SESSION["fehler"];
			$_SESSION["fehler"] = null;
			return $errors;
		} 
	}
?>