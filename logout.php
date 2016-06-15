<?php
ini_set('session.save_path', '/home/w/w9g0b/public_html/session');
session_start();
session_destroy();
header("Location: index.php");

?>