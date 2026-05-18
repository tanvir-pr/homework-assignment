<?php

declare(strict_types=1);

if (!isset($_SESSION['login'])) {
    header('Location: login');
    exit;
}

if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    $_SESSION['flash'] = 'Upload failed.';
    header('Location: images');
    exit;
}

$file = $_FILES['image'];
$allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];

if (!in_array($file['type'], $allowed, true) || $file['size'] > MAX_UPLOAD_SIZE) {
    $_SESSION['flash'] = 'Only JPG, PNG, WEBP, GIF up to 2MB are allowed.';
    header('Location: images');
    exit;
}

$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
$name = uniqid('img_', true) . '.' . strtolower((string) $ext);
$target = UPLOAD_DIR . $name;

if (!move_uploaded_file($file['tmp_name'], $target)) {
    $_SESSION['flash'] = 'Could not save image.';
    header('Location: images');
    exit;
}

try {
    $stmt = db()->prepare(
        'INSERT INTO gallery_images (file_name, user_id, created_at) VALUES (:file_name, :user_id, NOW())'
    );
    $stmt->execute([
        'file_name' => $name,
        'user_id' => (int) $_SESSION['uid'],
    ]);
    $_SESSION['flash'] = 'Image uploaded successfully.';
} catch (PDOException $e) {
    $_SESSION['flash'] = 'Could not save image to database.';
}

header('Location: images');
exit;
