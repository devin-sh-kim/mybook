<?php

include( INCLUDE_DIR . 'commons/opendb.php');

extract($_POST);

$sql = "INSERT INTO users (email, password, username) VALUES ('".$email."', password('".$password."'), '".$username."')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    
}	

include( INCLUDE_DIR . 'commons/closedb.php');
	
?>