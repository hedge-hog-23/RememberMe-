<?php
$servername = "localhost";
$username = "root";
$password = "(WC0zSyecb.Z@uFi";
$database = "remember";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
