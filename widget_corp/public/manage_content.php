
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php include '../includes/layouts/header.php'; ?>

<div id="main">
	<div id="navigation">
		<?php  echo navigation($current_subject, $current_page);  ?>
		<br />
		<a href="new_subject.php">Add a subject</a>
	</div>
	<div id="page">
		<h2>Manage Content</h2>
		<?php if ($current_subject) {  ?>
					Subject name: <?php echo $current_subject["menu_name"]; ?>
		<?php } elseif ($current_page) { ?>
					Page Name: <?php  echo $current_page["menu_name"]; ?>
		<?php } else { ?>
					Please select a subject or a page
		<?php } ?>
	</div>
</div>

<?php include '../includes/layouts/footer.php'; ?>