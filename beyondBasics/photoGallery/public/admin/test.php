<?php 
require_once("../../incl/initialize.php");
if (!$session->is_logged_in()) {
	redirect_to("login.php");
}
?>
<?php 
	include_layout_template('admin_header.php');
?>

<?php 

	// $user = new User();
	// $user->username = 'johnsmith';
	// $user->password = 'test';
	// $user->first_name = 'John';
	// $user->last_name = 'Smith';
	// $user->create();

	$user = User::find_by_id(6);
	$user->password = "test2";
	$user->save();

	// $user = User::find_by_id(5);
	// $user->delete();
?>


<?php 
	include_layout_template('admin_footer.php');
?>