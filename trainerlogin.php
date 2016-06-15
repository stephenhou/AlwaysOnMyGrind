<?php
ini_set('session.save_path', '/home/w/w9g0b/public_html/trainersession');
session_start();

    $success = True;
    $db_conn = OCILogon("ora_x3b0b", "a15055149", "ug");

    if ($db_conn) {
        if (array_key_exists('trainersubmit', $_POST)) {
    
            $stid = oci_parse($db_conn, "select pid from personalTrainer where username = :bind0 and password = :bind1");
            
            oci_bind_by_name($stid, ":bind0", $_POST['uid']);
            oci_bind_by_name($stid, ":bind1", $_POST['upass']);
            
            oci_execute($stid);
            $result = oci_fetch_array($stid);
            
            if($result) {
                $_SESSION['pid'] = $result[0];
                header("location: trainermain.php");
                exit;
            }
            else {
                header("location: index.php");
                exit;
            }
        }
        OCILogoff($db_conn);
    }
    else {
        // No rows matched so login failed
        echo "cannot connect";
        $e = OCI_Error(); // For OCILogon errors pass no handle
        echo htmlentities($e['message']);
    }
?>

