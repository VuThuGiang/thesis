<?php

$hname = 'localhost';
$uname = 'root';
$pword = '';
$db = 'travel';
$con = new mysqli($hname, $uname, $pword, $db);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

?>
