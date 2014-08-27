<!DOCTYPE html>
<html>
<head>
	<title>variable Variables</title>
</head>
<body>
<?php 

	$a = "hello";
	$hello = "Hello everyone";
	echo $a . "<br />";
	echo $hello . "<br />";
	echo "<hr />";
	echo$$a;
	
	// Does $$var[1] mean:
	// #1 get the first element then evalate dynamicallly?
	// #2 evaluate dynamically tehn get the first element?

	// Use {} to make it clear:
	// echo ${$var[1]}; // for #1
	// echo ${$var}[1]; // for #2

?>
</body>
</html>