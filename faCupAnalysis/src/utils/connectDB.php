<?php
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "facupdb";
// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
