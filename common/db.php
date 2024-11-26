<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "discuss";

// ye pdo se configuration hai...
// try {
//     $conn = new PDO("mysql:host=$host;dbname=discuss", $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     // echo "connection successfull...";
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }


$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("connection failed" . $conn->connect_error);
} else {
    // echo "connection successfull with database...";
}
