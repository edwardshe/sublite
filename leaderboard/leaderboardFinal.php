<?php
	require_once("LeaderboardCreater.php");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Leaderboard</title>
		<script src='assets/js/Chart.js'></script>
		<script src='assets/js/leaderboardGraphs.js'></script>
		<script src='assets/js/buttons.js'></script>
	</head>
	<body>

		<!--
		<h2>Highest Schools</h2>
		<canvas id="schools" width="800" height="400"></canvas>
		<script>
			<?php
				$top_schools_data = $CLeaderboardCreater->get_highest_schools($CLeaderboardCreater->school_count_since_date(1400000000), 4);
			?>
			draw_bar_graph("schools", <?php echo json_encode($top_schools_data);?>);
		</script>
		-->
	
		<?php
			$my_schools_days = array("Bentley University", "Eastern Michigan University");
			$my_schools_days_7_data = $CLeaderboardCreater->specific_school_count_past_number_days($my_schools_days, 7);
			$my_schools_days_30_data = $CLeaderboardCreater->specific_school_count_past_number_days($my_schools_days, 30);
			$my_schools_days_90_data = $CLeaderboardCreater->specific_school_count_past_number_days($my_schools_days, 90);
			$my_schools_days_180_data = $CLeaderboardCreater->specific_school_count_past_number_days($my_schools_days, 180);
			$my_schools_days_forever_data = $CLeaderboardCreater->specific_school_count_since_date($my_schools_days, 0);
		?>

		<h2 id="leaderboardTitle">Specific schools in past number of days:</h2>
		<button onclick="return showHide();">7</button>
		<button onclick="return showHide1();">30</button>
		<button onclick="return showHide2();">90</button>
		<button onclick="return showHide3();">180</button>
		<button onclick="return showHide4();">Forever</button>

		<div id="showHideDiv">
			<canvas id="7days" width="800" height="400"></canvas>
			<script>
				draw_bar_graph("7days", <?php echo json_encode($my_schools_days_7_data);?>);
			</script>
		</div>

		<div id="showHideDiv1">
			<canvas id="30days" width="800" height="400"></canvas>
			<script>
				draw_bar_graph("30days", <?php echo json_encode($my_schools_days_30_data);?>);
			</script>
		</div>

		<div id="showHideDiv2">
			<canvas id="90days" width="800" height="400"></canvas>
			<script>
				draw_bar_graph("90days", <?php echo json_encode($my_schools_days_90_data);?>);
			</script>
		</div>

		<div id="showHideDiv3">
			<canvas id="180days" width="800" height="400"></canvas>
			<script>
				draw_bar_graph("180days", <?php echo json_encode($my_schools_days_180_data);?>);
			</script>
		</div>

		<div id="showHideDiv4">
			<canvas id="foreverdays" width="800" height="400"></canvas>
			<script>
				draw_bar_graph("foreverdays", <?php echo json_encode($my_schools_days_forever_data);?>);
			</script>
		</div>

		<script>
			showHide4();
		</script>

		<!-- <h2>Example line graph: Yale</h2>
		<canvas id="leaderboard3" width="800" height="400"></canvas>
		<script>
			draw_line_graph("leaderboard3", <?php echo json_encode($CLeaderboardCreater->specific_school_per_day("yale.edu", 7));?>);
		</script> -->

	</body>
</html>
