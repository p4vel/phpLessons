<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/styles.css" media="screen">
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="js/functions.js"></script>
	<title></title>
</head>
<body>
	<table cellpadding="0" cellspacing="0" border="0">
		<?php 
			// display all days and players
			$amount_yes_per_day = array();
			for ($rows=1; $rows < 21; $rows++) { 
					echo "<tr class='participation'>";
					for ($columns=1; $columns < 11; $columns++) { 
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

		<!-- <pre>
			<?php 
				echo var_dump($amount_yes_per_day);
			 ?>	
		</pre> -->

	</table>
</body>
</html>