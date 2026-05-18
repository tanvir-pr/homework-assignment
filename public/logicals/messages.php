<?php

declare(strict_types=1);

if (!isset($_SESSION['login'])) {
    header('Location: login');
    exit;
}

try {
    $stmt = db()->query(
        'SELECT m.*, u.family_name, u.surname
         FROM messages m
         LEFT JOIN users u ON u.id = m.user_id
         ORDER BY m.created_at DESC'
    );
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $messages = [];
    $errormessage = 'Error: ' . $e->getMessage();
}
