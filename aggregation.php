<?php
    ini_set('session.save_path', '/home/w/x3b0b/public_html/session');
    session_start();
    $gid = $_SESSION['gid'];

    $success = True;
    $db_conn = OCILogon("ora_x3b0b", "a15055149", "ug");
    
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
        if (array_key_exists('agr', $_POST)) {
            // Find MAX/MIN/COUNT/AVG weight that a gymBro has done for each exercise
            if($_POST['statchoice'] == 2){

                $stid = oci_parse($db_conn, "select max(weight), name from gymbro_does_exercises where gid = :bind1 group by name");

                oci_bind_by_name($stid, ":bind1", $gid);
                oci_execute($stid);
                $_SESSION['pr'] = $stid;
            }
            if($_POST['statchoice'] == 3){

                $stid = oci_parse($db_conn, "select min(weight), name from gymbro_does_exercises where gid = :bind1 group by name");
                
                oci_bind_by_name($stid, ":bind1", $gid);
                oci_execute($stid);
                $_SESSION['pr'] = $stid;
            }
            if($_POST['statchoice'] == 4){

                $stid = oci_parse($db_conn, "select avg(weight), name from gymbro_does_exercises where gid = :bind1 group by name");
                
                oci_bind_by_name($stid, ":bind1", $gid);
                oci_execute($stid);
                $_SESSION['pr'] = $stid;
            }
            if($_POST['statchoice'] == 5){

                $stid = oci_parse($db_conn, "select count(weight), name from gymbro_does_exercises where gid = :bind1 group by name");
                
                oci_bind_by_name($stid, ":bind1", $gid);
                oci_execute($stid);
                $_SESSION['pr'] = $stid;
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


