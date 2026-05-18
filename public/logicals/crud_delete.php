<?php

declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: crud');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);

try {
    $stmt = db()->prepare('DELETE FROM pizzas WHERE id = :id');
    $stmt->execute(['id' => $id]);
} catch (PDOException $e) {
    $_SESSION['flash'] = 'Could not delete pizza.';
}

header('Location: crud');
exit;
