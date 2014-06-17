<html>
	<head>
		<title>Arrays</title>
	</head>
	<body>
	
	<?php
		$array1 = array(4, 8, 15, 16, 23, 42);
		echo $array1[1];

		$array2 = array(6, "fox", "dog", array("x", "y", "z"));
		echo $array2[3][1];
		echo "<br />";
		$array2[3] = "cat";
		echo $array2[3 ]; 
	?>
	<br />

	<?php 

		$array3 = array("firstName" => "Kevin", "lastName" => "Skoglund"); 
		echo $array3["firstName"];

	?>

	<pre><?php print_r($array2);?></pre>
	

	</body>
</html>