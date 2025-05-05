<?php
$host = 'graduationstore-project.c7m0qk1ncfgl.us-east-1.rds.amazonaws.com';
$user = 'admin';
$pass = 'admin_1234';
$dbname = 'graduation_store';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
