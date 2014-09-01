<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php confirm_logged_in(); ?>
<?php 
	$admin_set = find_all_admins();
	// print_r($admin_set);
?>

<?php $layout_context = 'admin'; ?>
<?php include '../includes/layouts/header.php'; ?> 

<div id="main">
	<div id="navigation">
		<br />
		<a href="admin.php">&laquo; Main Menu</a>
	</div>
	<div id="page">
		<?php echo message(); ?>

		<h2>Manage Admins</h2>

		<table>
			<tr>
				<th>Username</th>
				<th>Actions</th>
			</tr>
			<?php while ($admin = mysqli_fetch_assoc($admin_set)) { ?>
				<tr>
					<td><?php echo htmlentities($admin["username"]); ?></td>
					<td>
						<a href="edit_admin.php?id=<?php echo urlencode($admin["id"]);?>">Edit</a>
						<a href="delete_admin.php?id=<?php echo urlencode($admin["id"]);?>">Delete</a>
					</td>
				</tr>	
			<?php } ?>
		</table>
		<br />
		<a href="new_Admin.php">Add admin</a>
	</div>
<?php include '../includes/layouts/footer.php'; ?>