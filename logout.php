<?php
session_start();
$_SESSION = array();
session_destroy();
header("location: page1.php");
exit;
?>
