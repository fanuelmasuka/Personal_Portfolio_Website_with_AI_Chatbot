<?php
// Database connection
$servername = "localhost";
$username = "root";  // default XAMPP username
$password = "";      // default XAMPP password (empty)
$dbname = "portfolio_db";  // change this

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hash the password
$password_plain = 'masuka@2022';
$password_hash = password_hash($password_plain, PASSWORD_BCRYPT);

// SQL query
$sql = "INSERT INTO admin_users (username, password_hash, full_name, email, created_at, last_login) 
        VALUES (?, ?, ?, ?, NOW(), NULL)";

// Prepare statement
$stmt = $conn->prepare($sql);
$username = 'fanuelmasuka2.projects@gmail.com';
$fullname = 'Fanuel Masuka';
$email = 'fanuelmasuka2.projects@gmail.com';

$stmt->bind_param("ssss", $username, $password_hash, $fullname, $email);

// Execute query
if ($stmt->execute()) {
    echo "New admin added successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>