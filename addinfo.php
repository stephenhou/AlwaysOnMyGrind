<?php
    ini_set('session.save_path', '/home/w/w9g0b/public_html/session');
    session_start();
    $gid = $_SESSION['gid'];
    
    $success = True;
    $db_conn = OCILogon("ora_x3b0b", "a15055149", "ug");
    
    if ($db_conn) {
        if (array_key_exists('addinfo', $_POST)) {
        /**Getting the values from user and insert data into the table
        */

        $tuple = array (
        ":bind0" => $gid,
        ":bind1" => $_POST['gender'],
        ":bind2" => $_POST['weight'],
        ":bind3" => $_POST['phone'],
        ":bind4" => $_POST['age'],
        );
        $alltuples = array (
        $tuple
        );
        executeBoundSQL("update gymBro 
                        set gender = :bind1,
                        weight = :bind2,
                        phone = :bind3,
                        age = :bind4
                        where gid = :bind0", $alltuples);

        OCICommit($db_conn);
        }


        if ($_POST && $success) {
        /**POST-REDIRECT-GET -- See http://en.wikipedia.org/wiki/Post/Redirect/Get
        */
        header("location: main.php");
        exit;
        } else {
            
        }
        /**Commit to save changes... */
        OCILogoff($db_conn);
    } 
    else {
        echo "cannot connect";
        $e = OCI_Error(); // For OCILogon errors pass no handle
        echo htmlentities($e['message']);
    }

?>


