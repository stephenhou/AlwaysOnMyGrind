<?php
    ini_set('session.save_path', '/home/w/w9g0b/public_html/session');
    session_start();
    $gid = $_SESSION['gid'];
    /**
     * Created by PhpStorm.
     * User: joohan0311
     * Date: 2016-06-12
     * Time: 10:49 PM
     */
    $success = True;
    $db_conn = OCILogon("ora_x3b0b", "a15055149", "ug");
    
    function printResultForAggregation($result) { //prints results from a select statement
        while (($row = oci_fetch_array($result)) != false) {
            echo "<p class=\"wrapper\">";
            echo $row[1];
            echo "</p>";
            echo "<p class=\"wrapper\">";
            echo $row[0];
            echo "</p>";
        }
    }
    if ($db_conn) {
        if (array_key_exists('personal_record', $_POST)) {
            // find max weight for all your exercises
            $stid = oci_parse($db_conn, "select MAX(weight), name from gymbro_does_exercises where  gid = :bind0 group by name");

            oci_bind_by_name($stid, ":bind0", $gid);
            oci_execute($stid);

            $_SESSION['pr'] = $stid;
            
            if ($result) {
                // PRINT $result
                header("location: myexercises.php");
                exit;
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


