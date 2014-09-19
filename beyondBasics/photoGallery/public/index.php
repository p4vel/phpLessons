<?php 
require_once("../incl/initialize.php");
//require_once("../incl/user.php");
?>

<?php 
	include_layout_template('header.php');
?>
<?php 
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

<?php 
	include_layout_template('admin_footer.php');
?>