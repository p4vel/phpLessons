<?php  
	//This is how zou redirect to a new page
	function redirect_to($new_location)
	{
		header("Location: " . $new_location);
		exit;
	}

	$logged_in  = $_GET['logged_in'];
	if ($logged_in == "1") {
		redirect_to("constants.php");
	} else {
		redirect_to("strings.php");
	}
?>
<html>
	<head>
		<title>Redirect</title>
	</head>
	<body>
	<pre>
	<?php  

	?>
	</pre>
	</body>
</html>