<?php 

	// Define teh core paths
	// Define them as absolute paths to make sure that require_one works as expected

	// DIRECTORY_SEPERATOR is a PHP pre-defined constant
	// ("\" for Windows, "/" for Unix )

	defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

	defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'homepages'.DS.'0'.DS.'d26215848'.DS.'htdocs'.DS.'lynda_com'.DS.'beyondBasics'.DS.'photoGallery');

	defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'incl');

	// load config file first
	require_once(LIB_PATH.DS."config.php");

	// laod basic functions next so taht everything after can use tem
	require_once(LIB_PATH.DS."functions.php");

	// load core objects
	require_once(LIB_PATH.DS."session.php");
	require_once(LIB_PATH.DS."database.php");

	// laod database-related classes
	require_once(LIB_PATH.DS."user.php");

	require_once(LIB_PATH.DS."log.php");
?>