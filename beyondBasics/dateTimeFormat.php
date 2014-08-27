<!DOCTYPE html>
<html>
<head>
	<title>Dates and Times: Format</title>
</head>
<body>
	<?php 
		$timestamp = time();
		echo strftime("The date today is %m/%d/%y");

		echo "<hr />";

		function stripZerosFromDate($markedString='')
		{
			// remove the marked Zeros
			$noZeros = str_replace('*0', '', $markedString);
			// remove any remianing marks
			$cleanString = str_replace('*', '', $noZeros);
			return $cleanString;
		}
		echo stripZerosFromDate(strftime("The date today is *%m/*%d/%y"));

		echo "<hr />";

		$dt = time();
		$mysqlDateTime = strftime("%Y-%m-%d %H:%M:%S", $dt);
		echo $mysqlDateTime;

	?>

</body>
</html>