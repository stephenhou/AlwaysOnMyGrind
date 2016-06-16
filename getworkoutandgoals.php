<?php
ini_set('session.save_path', '/home/w/w9g0b/public_html/session');
session_start();
$gid = $_SESSION['gid'];

	$success = True;
    $db_conn = OCILogon("ora_x3b0b", "a15055149", "ug");

    function printResult($result) { //prints results from a select statement
        while (($row = oci_fetch_array($result)) != false) {
            echo "<p class=\"wrapper\">";
            echo $row[0];
            echo "</p>";
        }
    }

    $stid0 = oci_parse($db_conn, "select distinct w.name
    	from workout_has w
    	where w.workoutId in 
    	(select distinct g.workoutId
    	from g_does_dayOfWorkout g, dayOfWorkout d
    	where g.gid = :bind0 and
    	g.workoutId = d.workoutId and
    	g.specificWorkoutId = d.specificWorkoutId and
    	d.nameOfDay = :bind1)");

    oci_bind_by_name($stid0, ":bind0", $_SESSION['gid']);
    oci_bind_by_name($stid0, ":bind1", $_SESSION['today']);
    oci_execute($stid0);
    $_SESSION['show'] = $stid0;
        
    if ($db_conn) {
    	$stid = oci_parse($db_conn, "select ");

    }
?>


