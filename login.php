<?php
ini_set('session.save_path', '/home/w/w9g0b/public_html/session');
session_start();
    /**
     * Created by PhpStorm.
     * User: joohan0311
     * Date: 2016-06-11
     * Time: 11:44 PM
     */
    /** this tells the system that it's no longer just parsing
     * html; it's now parsing PHP
     * keep track of errors so it redirects the page only if there are no errors
     */
    
    $success = True;
    $db_conn = OCILogon("ora_g1t0b", "a71677165", "ug");
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
        if (array_key_exists('loginsubmit', $_POST)) {
            
            $stid = oci_parse($db_conn, "select gid from gymBro where username = :bind0 and password = :bind1");
            
            oci_bind_by_name($stid, ":bind0", $_POST['uid']);
            oci_bind_by_name($stid, ":bind1", $_POST['upass']);
            
            oci_execute($stid);
            $result = oci_fetch_array($stid);
            
            if($result) {
                $_SESSION['gid'] = $result[0];
                header("location: main.php");
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

