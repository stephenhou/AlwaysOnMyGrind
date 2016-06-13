<?php
    /**
     * Created by PhpStorm.
     * User: joohan0311
     * Date: 2016-06-12
     * Time: 10:49 PM
     */
    ini_set('session.save_path', '/home/w/x3b0b/public_html/session');
    session_start();
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
            echo $row[0];
        }
    }
    if ($db_conn) {
        if (array_key_exists('personal_record', $_POST)) {
            // Find exercises that involves all the body parts
            // Select exercise name such that there is no bodypart type which is not involved in the particular exercise
            $stid = oci_parse($db_conn, "select MAX(weight), name from gymbro_does_exercises group by name");
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


