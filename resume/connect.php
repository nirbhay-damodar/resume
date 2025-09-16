<?php
// Get values from POST
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

// Simple validation (server-side)
if (!$name || !$email || !$subject || !$message) {
    echo "All fields are required.";
    exit;
}

// Connect to DB (XAMPP default)
$servername = "localhost";
$username = "root";
$password = ""; // No password by default
$dbname = "resume";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert into database
$sql = "INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $subject, $message);

if ($stmt->execute()) {
    echo "Your message has been sent successfully!";
} else {
    echo "Failed to send message. Please try again.";
}

$stmt->close();
$conn->close();
?>
