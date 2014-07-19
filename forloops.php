<html>
	<head>
		<title>loops</title>
	</head>
	<body>
	<?php  
		$count = 0;
		// echo "while-loop: ";
		while ($count <= 10) {
			echo $count . ", ";
			$count++;
		}

		echo "<br />";
		// echo "for-loop: ";
		for ($i=0; $i <= 10; $i++) { 
			echo $i . ", ";
		}
	?>

	<br />

	<?php
		for ($count=20; $count > 0 ; $count--) { 
			if ($count % 2 == 0) {
				echo "{$count} is even <br/>";
			} else {
				echo "{$count} is odd <br/>";	
			}
		}
	?>
	</body>
</html>