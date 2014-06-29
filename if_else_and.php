<html>
	<head>
		<title>Logical Expressions</title>
	</head>
	<body>
	<?php  
		$a = 5;
		$b = 4;
		if($a > $b){
			echo "a is larger than b";
		}
		elseif($a == $b){
			echo "a equals b";
		}
		else{
			echo "a is smaller than b";
		}
	?>
	<?php
		$c = 100;
		$d = 20;
		if(($a > $b) && ($c > $d)){
			echo "a is larger than b AND ";
			echo "c is larger than d";
		}
		
	?>
	</body>
</html>