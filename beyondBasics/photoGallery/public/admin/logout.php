<?php 
require_once("../../incl/initialize.php");

if ($session->is_logged_in()) {
	$log->log_action("Logout", "{$session->username} logged out");
	$session->logout();
}
	redirect_to("index.php");
?>