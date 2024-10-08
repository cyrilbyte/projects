<?php
// Database configuration
$host = 'localhost'; // Your database host (e.g., localhost or an IP address)
$dbname = 'google_surveys'; // Your database name
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password

// Create a new PDO instance for database connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // If connection fails, output error message
    echo "Connection failed: " . $e->getMessage();
}
?>
