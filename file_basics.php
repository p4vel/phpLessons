<?php 
	echo __FILE__."<br />";
	echo __LINE__."<br />"; // be careful once you include files !!

	echo dirname(__FILE__)."<br />";
	echo __DIR__."<br />";

	echo "<hr />";

	echo file_exists(__FILE__) ? 'yes' : 'no';
	echo "<br />";
	echo file_exists(dirname(__FILE__)."/switch.php") ? 'yes' : 'no';
	echo "<br />";
	echo file_exists(dirname(__FILE__)) ? 'yes' : 'no';
	echo "<br />";

	echo "<hr />";

	echo is_file(dirname(__FILE__)."/switch.php") ? 'yes' : 'no';
	echo "<br />";
	echo is_file(dirname(__FILE__)) ? 'yes' : 'no';
	echo "<br />";

	echo "<hr />";

	echo is_dir(dirname(__FILE__)."/switch.php") ? 'yes' : 'no';
	echo "<br />";
	echo is_dir(dirname(__FILE__)) ? 'yes' : 'no';
	echo "<br />";
	echo is_dir('..') ? 'yes' : 'no';
	echo "<br />";
	?>