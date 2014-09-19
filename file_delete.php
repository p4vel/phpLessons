<?php 

	// 1. Close files first. Can't delete open files.
	// 2. Must have write permissions on the folder containing the file

	// Delete files (carefully) with:

	unlink("filetext.txt");

?>