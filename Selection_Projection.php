<?php
    ini_set('session.save_path', '/home/w/w9g0b/public_html/session');
    session_start();
    /**
     * Created by PhpStorm.
     * User: joohan0311
     * Date: 2016-06-12
     * Time: 5:43 PM
     */
    /** this tells the system that it's no longer just parsing
     * html; it's now parsing PHP
     * keep track of errors so it redirects the page only if there are no errors
     */
    
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
        echo "<br>Got data from table tab1:<br>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th></tr>";
        
        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "<tr><td>" . $row["NID"] . "</td><td>" . $row["NAME"] . "</td></tr>"; //or just use "echo $row[0]"
        }
        echo "</table>";
        
    }
    if ($db_conn) {
        if (array_key_exists('nameandage', $_POST)) {
            
            //Select Name from Personal Trainer where age ($_POST) = 19
            //Select Email Address from Personal Trainer where weight ($_POST) > 20
            $stid = oci_parse($db_conn, "select fullname from personalTrainer where age = :bind0");
            
            oci_bind_by_name($stid, ":bind0", $_POST['age']);
            oci_execute($stid);
            $result = oci_fetch_array($stid);
            
            if($result) {
                // PRINT $result
                header("location: mytrainers.php");
                exit;
            }
            else {
                
            }
        }
        else if (array_key_exists('emailandweight', $_POST)) {
            $stid = oci_parse($db_conn, "select email from personalTrainer where weight = :bind0");
            
            oci_bind_by_name($stid, ":bind0", $_POST['weight']);
            oci_execute($stid);
            $result = oci_fetch_array($stid);
            
            if($result) {
                // PRINT $result
                header("location: mytrainers.php");
                exit;
            }
            else {
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


