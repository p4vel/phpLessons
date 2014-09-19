<?php 

	echo "fileowner('file_permission.php') [ID]: ". fileowner('file_permission.php');
	echo "<br />";
	// if Posix is installed

	$owner_id = fileowner('file_permission.php');
	$owner_array = posix_getpwuid($owner_id);
	echo "fileowner('file_permission.php') [NAME]:" . $owner_array['name'];

	echo "<br />";

	// chown('file_permission.php', 'walter');
	// chown only works if php is superuser
	// making webserver/php a superuser is a big security issue


	// $owner_id = fileowner('file_permission.php');
	// $owner_array = posix_getpwuid($owner_id);
	// echo $owner_array['name'];

	// echo "<br />";

	echo "fileperms('file_permission.php'): " . fileperms('file_permission.php');
	echo "<br />";
	echo "decoct(fileperms('file_permission.php')): " . decoct(fileperms('file_permission.php'));
	echo "<br />";
	echo "substr(decoct(fileperms('file_permission.php')), 2): " . substr(decoct(fileperms('file_permission.php')), 2);
	echo "<br />";

	chmod('file_permission.php', 0444);

	echo "substr(decoct(fileperms('file_permission.php')), 2): " . substr(decoct(fileperms('file_permission.php')), 2);
	echo "<br />";

	echo is_readable('file_permission.php') ? 'yes' : 'no';
	echo "<br />";	
	echo is_writeable('file_permission.php') ? 'yes' : 'no' ;
?>