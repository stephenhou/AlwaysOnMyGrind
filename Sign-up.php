<?php
//this tells the system that it's no longer just parsing
//html; it's now parsing PHP
$success = True; //keep track of errors so it redirects the page only if there are no errors
$db_conn = OCILogon(“ora_x3b0b”, “a15055149”, "ug");

function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
//echo "<br>running ".$cmdstr."<br>";
    global $db_conn, $success;
$statement = OCIParse($db_conn, $cmdstr); //There is a set of comments at the end of the file that describe some of the OCI specific functions and how they work

if (!$statement) {
    echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
    $e = OCI_Error($db_conn); // For OCIParse errors pass the
    // connection handle
    echo htmlentities($e['message']);
    $success = False;
}

$r = OCIExecute($statement, OCI_DEFAULT);
if (!$r) {
    echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
    $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
    echo htmlentities($e['message']);
    $success = False;
} else {

}
return $statement;

}

function executeBoundSQL($cmdstr, $list) {
/* Sometimes a same statement will be excuted for severl times, only
 the value of variables need to be changed.
 In this case you don't need to create the statement several times; 
 using bind variables can make the statement be shared and just 
 parsed once. This is also very useful in protecting against SQL injection. See example code below for       how this functions is used */

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
        unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype

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

function generateUniqueId($number,$fetchArray) {
    if (!in_array($number,$fetchArray)) {
        return $number;
    }
    else {
        $newNumber  = mt_rand( 100000, 999999);
        return generateUniqueId($newNumber, $fetchArray);
    }
}

function NewGymBro () {
    $stid = oci_parse($conn, 'SELECT gid FROM gymBro');
    oci_execute($stid);
    $fetcharray = oci_fetch_array($stid, OCI_NUM); // fetcharray = existing gid values from gymBro
    $number = mt_rand(100000, 999999);
    
    /** extract all the form fields and store them in variables*/
    $gid = generateUniqueId($number,$fetchArray);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $fullname = $firstname.''.$lastname;  // concatenation
    //$gender = $_POST['gender'];
    //$age = $_POST['age'];
    //$phone = $_POST['phone'];
    $email = $_POST['email'];
    //$weight = $_POST['weight'];
    
    /** Check whether the user has filled in the wisher's name in the text field "user" */
    if ($_POST['user'] == "")
        $userIsEmpty = true;
    
    /** Check whether a user whose name matches the "user" field already exists */
    $query = "select ID from gymBro where name = :user_bv";
    $stid = oci_parse($db_conn, $query);
    $user = $_POST['user'];
    $gid = null;
    oci_bind_by_name($stid, ':user_bv', $user);
    oci_execute($stid);
    
    /**Each user name should be unique. Check if the submitted user already exists. */
    $row = oci_fetch_array($stid, OCI_ASSOC);
    if ($row) {
        $gid = $row['gid'];
    }
    if ($gid != null) {
        $userNameIsUnique = false;
    }
    //Check for the existence and validity of the password
    if ($_POST['password'] == "") {
        $passwordIsEmpty = true;
    }
    if ($_POST['password2'] == "") {
        $password2IsEmpty = true;
    }
    if ($_POST['password'] != $_POST['password2']) {
        $passwordIsValid = false;
    }
    
    $query = "INSERT INTO gymBro (gid, username, password, fullname, gender, age, phone, email, weight) VALUES ('$gid', '$username', '$password','$fullname', 'NULL', 'NULL', 'NULL','NULL','NULL')";
    $stid = OCIparse($db_conn, $query);
    oci_bind_by_name($stid, ':username_bv', $username);
    oci_bind_by_name($stid, ':password_bv', $password);
    oci_bind_by_name($stid, ':fullname_bv', $fullname);
    //oci_bind_by_name($stid, ':gender_bv', $gender);
    //oci_bind_by_name($stid, ':age_bv', $age);
    //oci_bind_by_name($stid, ':phone_bv', $phone);
    //oci_bind_by_name($stid, ':email_bv', $email);
    //oci_bind_by_name($stid, ':weight_bv', $weight);
    OCIExecute($stid);
    oci_free_statement($stid);
    oci_close($con);
    exit;
}

?>

<!-- Enter the following PHP code block inside the HTML input form
Please enter your username: -->
<?php

if ($userIsEmpty) {
    echo ("Enter your name, please!");
    echo ("<br/>");
}
if (!$userNameIsUnique) {
    echo ("The person already exists. Please check the spelling and try again");
    echo ("<br/>");
}

?>

<!--Please enter your password: -->
<?php

if ($passwordIsEmpty) {
    echo ("Enter the password, please!");
    echo ("<br/>");
}

?>

<!--Please confirm your password: -->
<?php

if ($password2IsEmpty) {
    echo ("Confirm your password, please");
    echo ("<br/>");
}
if (!$password2IsEmpty && !$passwordIsValid) {
    echo  ("The passwords do not match!");
    echo ("<br/>");
}

?>


























