<html>
	<head>
		<title>Logical Expressions</title>
	</head>
	<body>
	<?php  
		$a = 4;
		$b = 3;
		$c = 1;
		$d = 20;
		if(($a > $b) || ($c >= $d)){
			echo "a is larger than b OR ";
			echo "c is larger than d";
		}
	?>
	<br />
	<?php 
		$e = 100;
		if(!isset($e)){
			$e = 200;
		}
		echo $e;
	?>
	<br />
	<?php 
		// don reject  0 or 0.0
		$quantity = "";
		if(empty($quantity) && !is_numeric($quantity)){
			echo "You must enter a quantity";
		}
	?>
	</body>
</html>