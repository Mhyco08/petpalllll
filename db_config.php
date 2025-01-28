<?php
$host = 'localhost';
$db = 'login';
$user = 'root'; // Replace with your MySQL username
$password = ''; // Replace with your MySQL password

try {
    $conn = new PDO("mysql:host=$host;port=3307;dbname=$db", $user, $password); //port again depends sa sql panel
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
