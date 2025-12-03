<?php
$nameServer = "localhost";
$userName = "root";
$password = "";
$dbName = "MR_DataB";

$conn = new mysqli($nameServer, $userName, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // echo "Connected successfully";
}
