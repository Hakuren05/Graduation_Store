<?php
$servername = "graduationstore-project.c7m0qk1ncfgl.us-east-1.rds.amazonaws.com";
$username = "admin"; 
$password = "admin_1234";     
$dbname = "graduation_store"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
