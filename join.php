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
    function printResult($result) { //prints results from a select statement

        while (($row = oci_fetch_array($result)) != false) {
            echo "<p class=\"wrapper\">";
            echo $row[0];
            echo "</p>";
        }       
        
    }
    if ($db_conn) {
        if (array_key_exists('exName_equipName', $_POST)) {
            // Join Involves and gymBro_does_exercises tables to query all the exercises that require this particular equipment!
            $stid = oci_parse($db_conn, "select DISTINCT exName from involves, gymBro_does_exercises where equipName = :bind0 and gid = :bind1 and name = exName");
            
            oci_bind_by_name($stid, ":bind0", $_POST['equipName']);
            oci_bind_by_name($stid, ":bind1", $gid);
            oci_execute($stid);
   
            $_SESSION['exFromEquip'] = $stid;
            
            if($result) {
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
