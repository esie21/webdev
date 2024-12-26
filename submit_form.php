<?php
header('Content-Type: application/json');

// Database connection details
$host = "localhost";  // or your database server address
$dbname = "cadungog";
$username = "root";
$password = "";

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]);
    exit();
}

// Get form data
$user_name = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Insert data into the database
$sql = "INSERT INTO contacts (username, email, phone, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $user_name, $email, $phone, $message);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Form submitted successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error]);
}

// Close connections
$stmt->close();
$conn->close();
?>

