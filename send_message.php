<?php
// send_message.php - Handle contact form submission
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $subject = $conn->real_escape_string(trim($_POST['subject']));
    $message = $conn->real_escape_string(trim($_POST['message']));
    
    // Validate input
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all fields.']);
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
        exit;
    }
    
    // Insert message into database
    $sql = "INSERT INTO messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    
    if ($conn->query($sql)) {
        echo json_encode(['success' => true, 'message' => 'Thank you for your message! I will get back to you soon.']);
        
        // In a real application, you would send an email notification here
        // $to = "fanuel.masuka@example.com";
        // $email_subject = "New Contact Form Message: $subject";
        // $email_body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        // $headers = "From: $email";
        // mail($to, $email_subject, $email_body, $headers);
        
    } else {
        echo json_encode(['success' => false, 'message' => 'Sorry, there was an error sending your message. Please try again later.']);
    }
    
    $conn->close();
} else {
    header('Location: index.php');
    exit;
}
?>