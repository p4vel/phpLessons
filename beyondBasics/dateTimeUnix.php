<!DOCTYPE html>
<html>
<head>
	<title>Dates and Times: Unix</title>
</head>
<body>
	<?php 
		echo time();
		echo "<br />";
		echo mktime(2, 30, 45, 10, 1, 2009);

		echo "<hr />";

		// checkdate();
		echo checkdate(12, 31, 2000) ? 'true' :'false';
		echo "<br />";
		echo checkdate(2, 31, 200) ? 'true' :'false';

		echo "<hr />";		

		$unix_timestamp = strtotime("now");
		echo "now: " . $unix_timestamp;
		echo "<br />";
		$unix_timestamp = strtotime("15 September 2004");
		echo "then: " . $unix_timestamp;
		echo "<br />";
		$unix_timestamp = strtotime("September 15,	 2004");
		echo "then: " . $unix_timestamp;
		echo "<br />";
		$unix_timestamp = strtotime("+1 day");
		echo "tomorrow: " . $unix_timestamp;
		echo "<br />";
		$unix_timestamp = strtotime("last Monday");
		echo "last Monday: " . $unix_timestamp;
	?>

</body>
</html>