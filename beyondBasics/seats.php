<!DOCTYPE html>
<html>
<head>
	<title>Basics</title>
</head>
<body>
	<?php  
		$a = 'Kevin';
		$b = 'Mary';
		$c = 'Joe';
		$d = 'Larry';
		$e = 'Audrey';

		$students = array('a', 'c', 'e');
		foreach ($students as $seat) {
			echo $$seat . "<br />";
		}
	?>
</body>
</html>