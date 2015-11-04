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
		<canvas id="leaderboard" width="800" height="400"></canvas>
		<script>
			<?php
				$my_schools = array("Duke University", "Princeton University",  "Harvard University", "University of Wisconsin - Madison");
				$my_schools_data = $CLeaderboardCreater->specific_school_count_since_date($my_schools, 0);
			?>
			draw_bar_graph("leaderboard", <?php echo json_encode($my_schools_data);?>);
		</script>
		<canvas id="schools" width="800" height="400"></canvas>
		<script>
			<?php
				$top_schools_data = $CLeaderboardCreater->get_highest_schools($CLeaderboardCreater->school_count_since_date(1400000000), 4);
			?>
			draw_bar_graph("schools", <?php echo json_encode($top_schools_data);?>);
		</script>
	</body>
</html>
