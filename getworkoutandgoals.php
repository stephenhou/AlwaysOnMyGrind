<?php
ini_set('session.save_path', '/home/w/w9g0b/public_html/session');
session_start();
$gid = $_SESSION['gid'];

	$success = True;
    $db_conn = OCILogon("ora_x3b0b", "a15055149", "ug");
    
    if ($db_conn) {
    	$stid = oci_parse($db_conn, "select ");

    }

?>

