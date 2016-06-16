 <?php
    /**
     * Created by PhpStorm.
     * User: joohan0311
     * Date: 2016-06-15
     * Time: 3:00 PM
     */
    ini_set('session.save_path', '/home/w/w9g0b/public_html/session');
    session_start();
    
    $success = True;
    $db_conn = OCILogon("ora_x3b0b", "a15055149", "ug");
    
    function printResultForAppointment($result) { //prints results from a select statement
        while (($row = oci_fetch_array($result)) != false) {
            echo "<p class=\"wrapper\">";
            echo $row[2];
            echo ": ";
            echo $row[1];
            echo ": ";
            echo $row[0];
            echo "</p>";
        }
    }
    if ($db_conn) {
        $stid = oci_parse($db_conn,
                                  "select personalTrainer.fullname, TO_CHAR(trains.apptDate, 'DD-MM-YYYY'), trains.apptTime from personalTrainer, trains where trains.gid = :bind0 and personalTrainer.pid = trains.pid and trains.apptDate >= TRUNC(SYSDATE)");
        // Later implement where clause it only shows apptDate that is either today's date or later.
        oci_bind_by_name($stid, ":bind0", $_SESSION['gid']);
        oci_execute($stid);
        $_SESSION['ap'] = $stid;
        /**Commit to save changes... */
        OCILogoff($db_conn);
    }   else {
        // No rows matched so login failed
        echo "cannot connect";
        $e = OCI_Error(); // For OCILogon errors pass no handle
        echo htmlentities($e['message']);
    }
?>




