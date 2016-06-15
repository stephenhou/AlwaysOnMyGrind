<?php
ini_set('session.save_path', '/home/w/w9g0b/public_html/trainersession');
session_start();

    $success = True;
    $db_conn = OCILogon("ora_g1t0b", "a71677165", "ug");
   
    function printMultAtrResult($result) { //prints results from a select statement
        while (($row = oci_fetch_array($result)) != false) {
            echo "<p class=\"wrapper\">";
            echo "Name: ";
            echo $row[0];
            echo " ";
            echo "ID: ";
            echo $row[1];
            echo " ";
            echo "Phone Number: ";
            echo $row[2];
            echo "</p>";
        }
    }

    $stid0 = oci_parse($db_conn, "select fullname, gymBro.gid, phone from gymBro, trains where gymBro.gid = trains.gid and trains.pid = :bind0");
    oci_bind_by_name($stid0, ":bind0", $_SESSION['pid']);
    oci_execute($stid0);
    $_SESSION['show'] = $stid0;


    if ($db_conn) {
        if (array_key_exists('delsubmit', $_POST)) {
            // Delete a gymBro from the database as his/her contract expired <-- Delete all his info ON CASCADE
            $stid = oci_parse($db_conn, "DELETE from gymBro where gid = :bind0");
            oci_bind_by_name($stid, ":bind0", $_POST['delete']);
            oci_execute($stid);
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


