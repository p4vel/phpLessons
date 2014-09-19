<?php 

	// we already used:
	// dirname()
	// is_dir()

	// getcwd(): returns Current Working Directory

	echo getcwd() . "<br />";

	// mkdir()	// create diretory (name, permission)
	// mkdir('new', 0777); // 0777 is the PHP default

	// you can use umask() to change default permission settings
	// default may be 0022

	// recursive dir creation
	// mkdir('new2/test/test2', 0777, true)

	// changing directories
	// chdir('new');
	// echo getcwd() . "<br />";

	// removing a directory
	rmdir('new');

	// must be closed and EMPTY before removal (and be CAREFUL)
	// scripts to help you wipe iout directories with files:
	// http://www.php.net/manuel/en/function.rmdir.php

	
?>