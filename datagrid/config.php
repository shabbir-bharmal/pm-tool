<?php
$servername = "localhost";
$username = "pmmastazusr";
$password = "P2g*n5s3";
$dbname = "pmmastaz";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
