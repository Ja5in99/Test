<?php
$serverName = "ja5in.org.mysql";
$dBUsername = "ja5in_orgTEST";
$dBPASSWORD = "Kallenalle1";
$dBNAME = "TEST";

$db = mysql -u [ja5in_orgtest] -p[Kallenalle1];

if($db === false){
    die("Error: connection error.".mysqli_connect_error());
}