<?php require_once 'incl/database.php'; ?>
<?php require_once 'incl/layout/header.php'; ?>
<!-- 	<table cellpadding="0" cellspacing="0" border="0">
		<?php 
			// display all days and players
			$amount_yes_per_day = array();
			for ($rows=1; $rows < 21; $rows++) { 
					echo "<tr class='participation'>";
					for ($columns=1; $columns < 11; $columns++) { 
							if(!$amount_yes_per_day[$columns]){
								$amount_yes_per_day[$columns] = 0;
							}
						$rand = rand(1,3);
						if (($columns%$rand == 1) && ($rows%$rand == 1)) {
							$participate = "";
						} else {
							$amount_yes_per_day[$columns]++;
							$participate = "participate";
						}
						$output  = "<td class={$participate}>";
						// $output .= "{$rows} / {$columns}";
						$output .= "";
						$output .= "</td>";
						echo $output;
					}
					echo "</tr>";
					
			}
			echo "<tr class='amount_participation'>";
			// display amount of players with YES at the bottom of the column
			for ($columns=1; $columns < 11 ; $columns++) { 
				echo "<td style='background-color: red; color: white; align=center'>{$amount_yes_per_day[$columns]}</td>";
			}
			echo "</tr>";
		?>

	</table> -->
	<?php 
		$query = "SELECT 
						users.first_name AS firstname, 
						users.last_name AS lastname, 
						users.no AS no,
						dates.id AS date_id, 
						dates.date AS date, 
						dates.location AS locations
					FROM 
						org_dates_users AS dates_users
					INNER JOIN 
						org_users AS users
					ON 
						users.id = dates_users.user_id
					INNER JOIN
						org_dates AS dates
					ON
						dates.id = dates_users.date_id
					WHERE 
						date BETWEEN CURDATE() AND CURDATE()+7
					ORDER BY
						date
	";
		$result = mysqli_query($connection, $query);
		echo "<ul>";
		while ($subject = mysqli_fetch_assoc($result)) {
			echo "<li>{$subject['date']}: {$subject['firstname']} {$subject['lastname']} (#{$subject['no']})</li>";
		}
		echo "</ul>";
	?>


</body>
</html>