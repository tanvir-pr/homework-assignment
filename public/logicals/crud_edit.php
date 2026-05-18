<?php

declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: crud');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);

try {
    $stmt = db()->prepare(
        'UPDATE pizzas
         SET pizza_name = :pizza_name, category_name = :category_name, vegetarian = :vegetarian
         WHERE id = :id'
    );
    $stmt->execute([
        'id' => $id,
        'pizza_name' => trim((string) ($_POST['pizza_name'] ?? '')),
        'category_name' => trim((string) ($_POST['category_name'] ?? '')),
        'vegetarian' => isset($_POST['vegetarian']) ? 1 : 0,
    ]);
} catch (PDOException $e) {
    $_SESSION['flash'] = 'Could not update pizza.';
}

header('Location: crud');
exit;
