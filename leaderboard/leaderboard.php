<?php
	require_once("LeaderboardCreater.php");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Leaderboard</title>
		<script src='assets/js/Chart.js'></script>
		<script src='assets/js/leaderboardGraphs.js'></script>
	</head>
	<body>


		<p>Highest Schools</p>
		<canvas id="schools" width="800" height="400"></canvas>
		<script>
			<?php
				$top_schools_data = $CLeaderboardCreater->get_highest_schools($CLeaderboardCreater->school_count_since_date(1400000000), 4);
			?>
			draw_bar_graph("schools", <?php echo json_encode($top_schools_data);?>);
		</script>


		<p>Specific schools past number of days: 180</p>
		<canvas id="days" width="800" height="400"></canvas>
		<script>
			<?php
				$my_schools_days = array("Duke University", "Princeton University",  "Harvard University", "University of Wisconsin - Madison");
				$my_schools_days_data = $CLeaderboardCreater->specific_school_count_past_number_days($my_schools_days, 180);
			?>
			draw_bar_graph("days", <?php echo json_encode($my_schools_days_data);?>);
		</script>


		<p>Specific schools since date: Forever</p>
		<canvas id="leaderboard" width="800" height="400"></canvas>
		<script>
			<?php
				$my_schools = array("Duke University", "Princeton University",  "Harvard University", "University of Wisconsin - Madison");
				$my_schools_data = $CLeaderboardCreater->specific_school_count_since_date($my_schools, 0);
			?>
			draw_bar_graph("leaderboard", <?php echo json_encode($my_schools_data);?>);
		</script>

		<p>Specific schools since date: Forever</p>
		<canvas id="leaderboard2" width="800" height="400"></canvas>
		<script>
			<?php
				$my_schools2 = array("Duke University", "Princeton University",  "Harvard University", "University of Wisconsin - Madison");
				$my_schools2_data = $CLeaderboardCreater->specific_school_count_since_date($my_schools2, 0);
			?>
			draw_line_graph("leaderboard2", <?php echo json_encode($my_schools2_data);?>);
		</script>

		<?php
			require_once("MongoSingleton.php");
			$conn = MongoSingleton::getMongoCon();
			$db = $conn->sublite;
			$emails = $db->emails;

			$ops = array(
			    array(
			        '$group' => array(
			            "_id" => array("email" => '$email'),
			            "count" => array('$sum' => 1),
			        ),
			    ),
			);

			$cursor = $emails->aggregate($ops);

			$past_months = 5;
			foreach($cursor as $doc)
			{
				var_dump($doc);
			}

		?>
	</body>
</html>
