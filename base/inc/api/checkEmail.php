<?php
// The back-end then will determine if the username is available or not,
// and finally returns a JSON { "valid": true } or { "valid": false }
// The code bellow demonstrates a simple back-end written in PHP
include( INCLUDE_DIR . 'commons/config.php');
include( INCLUDE_DIR . 'commons/opendb.php');


// Get the username from request
$email = $_GET['email'];
$isAvailable = false;
$sql = "SELECT count(*) as count FROM users where email = '".$email."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    if($row = $result->fetch_assoc()) {
		if($row["count"] == 0){
			$isAvailable = true;
		}
    }
} 
// Check its existence (for example, execute a query from the database) ...

// Finally, return a JSON
echo json_encode(array(
    'valid' => $isAvailable,
));

include( INCLUDE_DIR . 'commons/closedb.php');
?>