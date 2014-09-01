<!DOCTYPE html>
<html>
<head>
	<title>References as Return values</title>
</head>
<body>
<?php 
	function &refReturn()
	{
		global $a;
		$a = $a * 2;
		return $a;
	}

	$a = 10;
	$b =& refReturn();

	echo "a: {$a} / b: {$b}<br />";

	$b = 30;
	echo "a: {$a} / b: {$b}<br />";

	function &increments()
	{
		static $var = 0;
		$var++;
		return $var;
	}
	$a =& increments(); 	// var increments 
	increments();			// var increments 
	$a++;					// var increments
	increments();			// var increments
	echo "a: {$a}<br />";	// 4 ($a incremented 4 $var)
 ?>

</body>
</html>