<!DOCTYPE html>
<html>
<head>
	<title>Array Functions</title>
</head>
<body>
	<pre>
	<?php 
		$numbers = array(1, 2, 3, 4, 5, 6);
		print_r($numbers);
		echo "<br /><br />";
	?>
	
	<?php 

		echo "<hr />";

		// shifts first element out of an array
		// and returns it.
		$a = array_shift($numbers); 
		echo "a: {$a} <br />";
		print_r($numbers);

		echo "<hr />";

		// prepends an element to an array
		// returns the element count.
		$b = array_unshift($numbers, 'first');
		echo "b: {$b} <br />";
		print_r($numbers);
		echo "<br /><br />";

		echo "<hr />";

		// pops last element out of na array
		// and returns oit
		$a = array_pop($numbers);
		echo "a: {$a} <br />";
		print_r($numbers);
		echo "<br /><br />";

		echo "<hr />";

		// pushes an element onto the end of an array
		// returns the elment count
		$b = array_push($numbers, 'last');
		echo "b: {$b} <br />";
		print_r($numbers);
		echo "<br /><br />";


	?>
	</pre>
</body>
</html>