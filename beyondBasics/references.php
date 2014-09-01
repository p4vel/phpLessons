<!DOCTYPE html>
<html>
<head>
	<title>References</title>
</head>
<body>
<?php 
	$a = 1;
	$b = $a;
	$b = 2;
	echo "a: {$a} / b: {$b} <br />";
	// returns 1 / 2

	$a = 1;
	$b =& $a;
	$b = 2;
	echo "a: {$a} / b: {$b} <br />";
	// returns 2 / 2

	unset($b);

	echo "a: {$a} / b: {$b} <br />";
	// returns 1 / 2
 ?>

</body>
</html>