<html>
	<head>
		<title>Booleans and NULL</title>
	</head>
	<body>
	<?php 
		$bool1 = true;
		$bool2 = false;

		echo "bool1: " . $bool1 . "<br />";
		echo "bool2: " . $bool2 . "<br />";

		$var1 = 3;
		$var2 = "cat";
		$var4 = 0;
		$var5 = "0";
		$var6 = NULL;

		echo "var1 is set: " . isset($var1) . "<br />";
		echo "var2 is set: " . isset($var2) . "<br />";
		echo "var3 is set: " . isset($var3) . "<br />";

		unset($var1);

		echo "var1 is set: " . isset($var1) . "<br />";
		echo "var2 is set: " . isset($var2) . "<br />";
		echo "var3 is set: " . isset($var3) . "<br />";	

		echo "var1 empty? " . empty($var1) . "<br />";
		echo "var4 empty? " . empty($var4) . "<br />";
		echo "var5 empty? " . empty($var5) . "<br />";
		echo "var6 empty? " . empty($var6) . "<br />";
	?>
	</body>
</html>