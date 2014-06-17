<html>
	<head>
		<title>Arrays</title>
	</head>
	<body>
	
	<?php $array1 = array(4, 8, 15, 16, 23, 42); ?>
	Count: <?php echo count($array1); ?><br />
	Max Value: <?php echo max($array1) ;?><br />
	Min Value: <?php echo min($array1) ; ?>

	Sort:<pre> <?php sort($array1); print_r($array1); ?></pre><br />
	Reverse Sort: <pre><?php rsort($array1); print_r($array1);?></pre>

	<br />

	Implode: <?php echo $string1 = implode(" * ", $array1);?><br />
	Explode: <pre><?php  print_r(explode(" * ", $string1)); ?></pre> <br />

	<br />

	In array: <?php echo in_array(4, $array1); // returns t/f ?><br />
	</body>
</html>