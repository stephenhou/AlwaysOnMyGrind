<?php
ini_set('session.save_path', '/home/w/w9g0b/public_html/session');
session_start();
$gid = $_SESSION['gid'];

	$success = True;
    $db_conn = OCILogon("ora_g1t0b", "a71677165", "ug");
        
    if ($db_conn) {
    	$stid = oci_parse($db_conn, "select ");

    }
?>

