<?php

$dbhost = 'localhost';
$dbuser = 'moneybook';
$dbpass = 'moneybook';
$dbname = 'moneybook';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>