<?php
require_once 'includes/config.php';
require_once 'includes/db.php';
require_once 'lib/PHPMailer.php';
require_once 'lib/SMTP.php';
require_once 'lib/Exception.php';
require_once 'includes/mail.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}

$db = Database::getInstance();
$stmt = $db->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);

if ($stmt->execute()) {
    try {
        sendContactNotification($name, $email, $phone, $subject, $message);
        sendAutoReply($name, $email);
        echo json_encode(['success' => true, 'message' => 'Thank you for your message. We will get back to you shortly.']);
    } catch (Exception $e) {
        echo json_encode(['success' => true, 'message' => 'Message received. (Notification delivery: ' . $e->getMessage() . ')']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'An error occurred. Please try again later.']);
}

$stmt->close();
