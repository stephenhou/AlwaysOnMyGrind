<?php
    ini_set('session.save_path', '/home/w/w9g0b/public_html/session');
    session_start();
    $gid = $_SESSION['gid'];
    
    $success = True;
    $db_conn = OCILogon("ora_x3b0b", "a15055149", "ug");
    function executePlainSQL($cmdstr) {
        /**takes a plain (no bound variables) SQL command and executes it
         * echo "<br>running ".$cmdstr."<br>";
         */
        global $db_conn, $success;
        $statement = OCIParse($db_conn, $cmdstr);
        /**There is a set of comments at the end of the file that describe some of the OCI specific functions and how they work
         */
        if (!$statement) {
            echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
            $e = OCI_Error($db_conn);
            echo htmlentities($e['message']);
            $success = False;
        }
        
        $r = OCIExecute($statement, OCI_DEFAULT);
        if (!$r) {
            echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
            $e = oci_error($statement);
            echo htmlentities($e['message']);
            $success = False;
        } else {
            
        }
        return $statement;
    }
    function executeBoundSQL($cmdstr, $list) {
        /** Sometimes a same statement will be excuted for severl times, only
         the value of variables need to be changed.
         In this case you don't need to create the statement several times;
         using bind variables can make the statement be shared and just
         parsed once. This is also very useful in protecting against SQL injection. See example code below for
         how this functions is used */
        global $db_conn, $success;
        $statement = OCIParse($db_conn, $cmdstr);
        
        if (!$statement) {
            echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
            $e = OCI_Error($db_conn);
            echo htmlentities($e['message']);
            $success = False;
        }
        
        foreach ($list as $tuple) {
            foreach ($tuple as $bind => $val) {
                //echo $val;
                //echo "<br>".$bind."<br>";
                OCIBindByName($statement, $bind, $val);
                unset ($val);
                //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
            }
            $r = OCIExecute($statement, OCI_DEFAULT);
            if (!$r) {
                echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
                $e = OCI_Error($statement); // For OCIExecute errors pass the statementhandle
                echo htmlentities($e['message']);
                echo "<br>";
                $success = False;
            }

        }
    }
    
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
        $_SESSION['invalid'] = 0;
        header("location: mainnew.php");
        exit;
        } else if (!$success){
            $_SESSION['invalid'] = 2;
            header("location: submitsignup.php");
            exit;
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


