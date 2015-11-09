<?php
	require_once("MongoSingleton.php");
	require_once("schools.php");
	
	class LeaderboardCreater {
		public $start_epoch_time = 1445653816;
		public $day_time = 86400;

		/*  Gets an array of schools mapped to counts of number of sign-ups 
			since a given time, expressed as seconds since epoch. */
		function school_count_since_date($time)
		{
			$S = new Schools();

			//Best way to connect to database?
			$conn = MongoSingleton::getMongoCon();
			$db = $conn->sublite;
			$emails = $db->emails;
			$cursor = $emails->find();

			$pattern = "/(.*)@(.*)/";
			$schools = array();
			$school_names = array();

			foreach($cursor as $doc)
			{
				$success = preg_match($pattern, $doc["email"], $match);
				if($success && $doc["_id"]->getTimestamp() > $time)
				{
					$schools[$match[2]] += 1;
				}
			}

			foreach($schools as $key => $id)
			{
				if($S->hasSchoolOf($key))
					$school_names[$S->nameOf($key)] += $id;
				else
					$school_names[$key] += $id;
			}

			return $school_names;
		}

		function specific_school_count_since_date($school_array, $time)
		{
			$all_schools = $this->school_count_since_date($time);
			$specific_schools = array();

			foreach($school_array as $school)
			{
				$specific_schools[$school] = $all_schools[$school];
			}

			return $specific_schools;
			
		}

		function specific_school_count_past_number_days($school_array, $days)
		{
			return $this->specific_school_count_since_date($school_array, time()-($days * $this->day_time));
		}


		/*  Takes in a key => value and returns a splice of the top 
			$number by value. */
		function get_highest_schools($school_names, $number)
		{
			arsort($school_names);
			return array_slice($school_names, 0, $number);
		}

		function specific_school_per_day($my_school, $number_intervals)
		{
			$conn = MongoSingleton::getMongoCon();
			$db = $conn->sublite;
			$emails = $db->emails;
			$cursor = $emails->find();
			
			$pattern = "/(.*)@(.*)/";

			$time_now = time()-18000;
			$intervals = array();
			$result_array = array();

			for($x = $number_intervals; $x > 0; $x--)
			{
				array_push($intervals, (strtotime("today -" . ($x-1) . " day")-18000));
				array_push($result_array, array(date('D', (strtotime("today -" . ($x-1) . " day")-18000)), 0));
			}
			array_push($intervals, $time_now);

			//$intervals = array_map(function ($x) { return $x-46035245; } , $intervals);

			foreach($cursor as $doc)
			{
				$success = preg_match($pattern, $doc["email"], $match);
				if($success && $match[2] == $my_school)
				{
					$doc_time = $doc["_id"]->getTimeStamp();
					for($i = 0; $i < $number_intervals; $i++)
					{
						if($doc_time >= $intervals[$i] and $doc_time < $intervals[$i+1])
							$result_array[$i][1]++;
					}
				}
			}

			return $result_array;
		}

	}

	$CLeaderboardCreater = new LeaderboardCreater();
?>