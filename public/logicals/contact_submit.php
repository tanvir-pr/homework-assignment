<?php

declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact');
    exit;
}

$data = [
    'sender_name' => trim((string) ($_POST['sender_name'] ?? '')),
    'sender_email' => trim((string) ($_POST['sender_email'] ?? '')),
    'subject' => trim((string) ($_POST['subject'] ?? '')),
    'message_body' => trim((string) ($_POST['message_body'] ?? '')),
    'user_id' => isset($_SESSION['uid']) ? (int) $_SESSION['uid'] : null,
];

$errors = [];
if ($data['sender_name'] === '') {
    $errors[] = 'Name is required.';
}
if (!filter_var($data['sender_email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email is required.';
}
if ($data['subject'] === '' || $data['message_body'] === '') {
    $errors[] = 'Subject and message are required.';
}

if ($errors) {
    $_SESSION['contact_errors'] = $errors;
    $_SESSION['contact_old'] = $data;
    header('Location: contact');
    exit;
}

try {
    $stmt = db()->prepare(
        'INSERT INTO messages (sender_name, sender_email, subject, message_body, user_id, created_at)
         VALUES (:sender_name, :sender_email, :subject, :message_body, :user_id, NOW())'
    );
    $stmt->execute($data);
    $_SESSION['flash'] = 'Message sent successfully.';
} catch (PDOException $e) {
    $_SESSION['flash'] = 'Could not save message.';
}

header('Location: contact');
exit;
