<?php
ini_set('session.save_path', '/home/w/w9g0b/public_html/session');
session_start();
    /**
     * Created by PhpStorm.
     * User: joohan0311
     * Date: 2016-06-12
     * Time: 10:47 PM
     */
   
    $success = True;
    $db_conn = OCILogon("ora_x3b0b", "a15055149", "ug");
    
        if ($db_conn) {
        if (array_key_exists('all_bodyparts', $_POST)) {
            // Find exercises that involves all the body parts
            // Select exercise name such that there is no bodypart type which is not involved in the particular exercise
            $stid = oci_parse($db_conn,
                              "select DISTINCT workout_has.name from workout_has where NOT EXISTS (select bodyPart.type from bodyPart where NOT EXISTS (select bodyPart_for.type from bodyPart_for where workout_has.workoutID = bodyPart_for.workoutID and bodyPart.type = bodyPart_for.type))");
            oci_execute($stid);
            $_SESSION['bp'] = $stid;
            
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