<?php
$servername = "localhost";
$username = "moneybook";
$password = "moneybook";
$dbname = "moneybook";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully</br>";

$sql = "INSERT INTO users (email, password, name)
VALUES ('test1@mail.com', password('1234'), '한글')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>