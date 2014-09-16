<?php require_once 'incl/database.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/styles.css" media="screen">
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="js/functions.js"></script>
	<title></title>
</head>
<body>
	<div class="overview">
		<?php 
			// DB-Query: Anzahl aller User
			$sql = "SELECT * FROM org_users";
			$result = mysqli_query($connection, $sql);
			$total_players = mysqli_num_rows($result);

			$total_dates_to_display = 4;
				
			$sql = "SELECT * FROM org_dates";
			$result = mysqli_query($connection, $sql);
			$next_dates = array();

			while ($row = mysqli_fetch_assoc($result)){
				$next_dates[] =  $row['date'];
			}

			$sql = "SELECT * FROM org_users";
			$result = mysqli_query($connection, $sql);
			$players = array();

			while ($row = mysqli_fetch_assoc($result)){
				$players[] =  $row['first_name'];
			}

			for ($columns = -1; $columns < $total_dates_to_display; $columns++) { 
				if($columns < 0){
					echo "<div style='float:left; background-color: #e3e3e3;'>";
					echo "<table cellpadding=0 cellspacing=0 border=0>";
					echo "<tr><td>dates</td></tr>";
					for ($rows=0; $rows < $total_players; $rows++) { 
						echo "<tr><td>{$players[$rows]}</td></tr>";
					}
					echo "<tr class='amount_participation'>";
					// display amount of totalplayers with YES at the bottom of the column
					echo "<td style='background-color: #e3e3e3; text-align: center'>{$total_players}</td>";
					echo "</tr>";
					echo "</table>";
					echo "</div>";
				} else {
					echo "<div style='float:left'>";
					// DB-Query: Array mit Datum für bestimmten Filter (Datum, 5on5, Training)
					echo "<table cellpadding=0 cellspacing=0 border=0";
					echo "<tr class='date'><td style='background-color: #e3e3e3;'>{$next_dates[$columns]}</td></tr>";

					unset($participation);

					$sql = "SELECT 
								users.first_name AS firstname, 
								dates.id AS date_id, 
								users.id
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
								date_id = {$columns}+1
							ORDER BY
								users.id";
					$result = mysqli_query($connection, $sql);
					while($row = mysqli_fetch_assoc($result)){
						$participation[] = $row['id'];
					}

					// echo "<pre>";
					// var_dump($participation);
					// echo "</pre>";

					for ($rows=0; $rows < $total_players; $rows++) { 

						if (in_array($rows+1, $participation)) {
							$participate = "participate";
						} else {
							$participate = "";
						}
						echo "<tr class='participation'><td class='{$participate}' id='" . ($rows+1) . "_" . ($columns+1) . "'>";
						// DB-Query: Array mit participating users dieses Datums
						echo "";
						echo "</td></tr>";
					}
					echo "<tr class='amount_participation'>";
					// display amount of players with YES at the bottom of the column
					echo "<td style='background-color: #e3e3e3; text-align: center'>{$amount_yes_per_day[$columns]}</td>";
					echo "</tr>";

					echo "</table>";
					echo "</div>";
				}	
			}
		?>
		<div class="clearer" style="clear: both;"></div>
	</div>
</body>
</html>

