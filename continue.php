<html>
	<head>
		<title>loops: foreach</title>
	</head>
	<body>
	<?php  
		 for ($count=0; $count <= 10 ; $count++) { 
		 	if($count %2 != 0){ continue;}
		 	echo $count . ", ";
		 }
	?>
	</body>
</html>