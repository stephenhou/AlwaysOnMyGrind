<?php
ini_set('session.save_path', '/home/w/w9g0b/public_html/trainersession');
session_start();

    $success = True;
    $db_conn = OCILogon("ora_g1t0b", "a71677165", "ug");
    
    function printResultForAggregation($result) { //prints results from a select statement
        while (($row = oci_fetch_array($result)) != false) {
            echo "<p class=\"wrapper\">";
            echo $row[1];
            echo ": ";
            echo $row[0];
            echo "</p>";
        }
    }


    if ($db_conn) {
        if (array_key_exists('nest', $_POST)) {
            //nested aggregation with group-by
            //Personal trainer queries max/min/avg/count weight done by their gymBros where the gymBros' body weight is less than the input weight.
            if($_POST['statchoice'] == 2){
                $stid = oci_parse($db_conn,
                                  "select max(gymBro_does_exercises.weight), gymbro.fullname from gymBro_does_exercises, gymBro where gymBro_does_exercises.name = :bind0 and gymBro_does_exercises.gid = gymBro.gid and gymBro.gid IN (select gymBro.gid from gymBro where gymBro.weight < :bind1) group by gymBro.fullname");

                oci_bind_by_name($stid, ":bind0", $_POST['exercise']);
                oci_bind_by_name($stid, ":bind1", $_POST['bodyw']);
                oci_execute($stid);
                $_SESSION['prg'] = $stid;
          }
          if($_POST['statchoice'] == 3){
                $stid = oci_parse($db_conn,
                                  "select min(gymBro_does_exercises.weight), gymbro.fullname from gymBro_does_exercises, gymBro where gymBro_does_exercises.name = :bind0 and gymBro_does_exercises.gid = gymBro.gid and gymBro.gid IN (select gymBro.gid from gymBro where gymBro.weight < :bind1) group by gymBro.fullname");

                oci_bind_by_name($stid, ":bind0", $_POST['exercise']);
                oci_bind_by_name($stid, ":bind1", $_POST['bodyw']);
                oci_execute($stid);
                $_SESSION['prg'] = $stid;
          }
          if($_POST['statchoice'] == 4){
                $stid = oci_parse($db_conn,
                                  "select avg(gymBro_does_exercises.weight), gymbro.fullname from gymBro_does_exercises, gymBro where gymBro_does_exercises.name = :bind0 and gymBro_does_exercises.gid = gymBro.gid and gymBro.gid IN (select gymBro.gid from gymBro where gymBro.weight < :bind1) group by gymBro.fullname");

                oci_bind_by_name($stid, ":bind0", $_POST['exercise']);
                oci_bind_by_name($stid, ":bind1", $_POST['bodyw']);
                oci_execute($stid);
                $_SESSION['prg'] = $stid;
          }
          if($_POST['statchoice'] == 5){
                $stid = oci_parse($db_conn,
                                  "select count(gymBro_does_exercises.weight), gymbro.fullname from gymBro_does_exercises, gymBro where gymBro_does_exercises.name = :bind0 and gymBro_does_exercises.gid = gymBro.gid and gymBro.gid IN (select gymBro.gid from gymBro where gymBro.weight < :bind1) group by gymBro.fullname");

                oci_bind_by_name($stid, ":bind0", $_POST['exercise']);
                oci_bind_by_name($stid, ":bind1", $_POST['bodyw']);
                oci_execute($stid);
                $_SESSION['prg'] = $stid;
          }  
        }
        /**Commit to save changes... */
        OCILogoff($db_conn);
    }
    else {
        // No rows matched so login failed
        echo "cannot connect";
        $e = OCI_Error(); // For OCILogon errors pass no handle
        echo htmlentities($e['message']);
    }
?>


