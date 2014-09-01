<!DOCTYPE html>
<html>
<head>
	<title>References as Function Arguments</title>
</head>
<body>
<?php 
	function refTest(&$var)
	{
		$var = $var * 2;
	}
	$a = 10;
	refTest($a);
	echo $a;

 ?>

</body>
</html>