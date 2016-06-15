<?PHP
ini_set('session.save_path', '/home/w/w9g0b/public_html/session');
session_start();

    $success = True;
    $db_conn = OCILogon("ora_x3b0b", "a15055149", "ug");

    function printResult($result) { //prints results from a select statement
        while (($row = oci_fetch_array($result)) != false) {
            echo "<p class=\"wrapper\">";
            echo $row[0];
            echo "</p>";
        }
    }

    $stid0 = oci_parse($db_conn, "select TO_CHAR(dateOfEntry, 'DD-MM-YYYY') from g_does_dayOfWorkout where gid = :bind0");
    oci_bind_by_name($stid0, ":bind0", $_SESSION['gid']);
    oci_execute($stid0);
    $_SESSION['show'] = $stid0;

    if (array_key_exists('delsubmit', $_POST)) {
            // Delete a workout entry by date
            $stid = oci_parse($db_conn, "delete from g_does_dayofworkout where dateofentry = TO_DATE(:bind1, 'DD-MM-YYYY') and gid = :bind2");
            oci_bind_by_name($stid, ":bind1", $_POST['doe']);
            oci_bind_by_name($stid, ":bind2", $_SESSION['gid']);
            oci_execute($stid);

            if ($result) {
                // PRINT $result
                header("location: myworkout.php");
                exit;
            }
    }

?>