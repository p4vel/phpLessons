<?php 
require_once("../incl/functions.php");
require_once("../incl/database.php");
//require_once("../incl/user.php");


$user = User::find_by_id(1);
// echo "<pre>";
// var_dump($user);
// echo "</pre>";
echo $user->full_name(); 

echo "<hr />";

$users = User::find_all();

foreach ($users as $user){
	echo "User: " . $user->username . "<br />" ;
	echo "Name: " . $user->full_name() . "<br /><br />";
}


?>