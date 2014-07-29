<?php  
	header("HTTP 1.1/ 404 Not Found");
	header("X-Powered-By: Non of your business");
?>
<html>
	<head>
		<title>Headers</title>
	</head>
	<body>
	<pre>
	<?php  
		// This wont work
		// header("HTTP 1.1/ 404 Not Found");
		print_r(headers_list());
	?>
	</pre>
	</body>
</html>