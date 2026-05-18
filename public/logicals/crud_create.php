<?php

declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: crud');
    exit;
}

try {
    $stmt = db()->prepare(
        'INSERT INTO pizzas (pizza_name, category_name, vegetarian, created_at)
         VALUES (:pizza_name, :category_name, :vegetarian, NOW())'
    );
    $stmt->execute([
        'pizza_name' => trim((string) ($_POST['pizza_name'] ?? '')),
        'category_name' => trim((string) ($_POST['category_name'] ?? '')),
        'vegetarian' => isset($_POST['vegetarian']) ? 1 : 0,
    ]);
} catch (PDOException $e) {
    $_SESSION['flash'] = 'Could not create pizza.';
}

header('Location: crud');
exit;
