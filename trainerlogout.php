<?php
ini_set('session.save_path', '/home/w/w9g0b/public_html/trainersession');
session_start();
session_destroy();
header("Location: index.php");

?>