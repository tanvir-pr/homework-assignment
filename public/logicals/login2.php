<?php

declare(strict_types=1);

if (isset($_POST['login_name'], $_POST['password'])) {
    try {
        $loginName = trim((string) $_POST['login_name']);
        $password = (string) $_POST['password'];

        $stmt = db()->prepare(
            'SELECT id, family_name, surname, login_name, password_hash
             FROM users WHERE login_name = :login_name LIMIT 1'
        );
        $stmt->execute(['login_name' => $loginName]);
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userRow && password_verify($password, $userRow['password_hash'])) {
            $_SESSION['fn'] = $userRow['family_name'];
            $_SESSION['ln'] = $userRow['surname'];
            $_SESSION['login'] = $userRow['login_name'];
            $_SESSION['uid'] = (int) $userRow['id'];
            $row = $userRow;
        } else {
            $row = false;
        }
    } catch (PDOException $e) {
        $errormessage = 'Error: ' . $e->getMessage();
    }
} else {
    header('Location: .');
    exit;
}
