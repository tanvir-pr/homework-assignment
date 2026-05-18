<?php

declare(strict_types=1);

if (
    isset($_POST['family_name'], $_POST['surname'], $_POST['login_name'], $_POST['password'])
    && trim((string) $_POST['family_name']) !== ''
    && trim((string) $_POST['surname']) !== ''
    && trim((string) $_POST['login_name']) !== ''
    && (string) $_POST['password'] !== ''
) {
    try {
        $familyName = trim((string) $_POST['family_name']);
        $surname = trim((string) $_POST['surname']);
        $loginName = trim((string) $_POST['login_name']);
        $password = (string) $_POST['password'];

        $stmt = db()->prepare('SELECT id FROM users WHERE login_name = :login_name LIMIT 1');
        $stmt->execute(['login_name' => $loginName]);

        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            $message = 'Login name is already taken.';
            $again = true;
        } else {
            $insert = db()->prepare(
                'INSERT INTO users (family_name, surname, login_name, password_hash)
                 VALUES (:family_name, :surname, :login_name, :password_hash)'
            );
            $insert->execute([
                'family_name' => $familyName,
                'surname' => $surname,
                'login_name' => $loginName,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            ]);

            if ($insert->rowCount()) {
                $newid = (int) db()->lastInsertId();
                $message = 'Registration successful. Your ID: ' . $newid . '. Please login.';
                $again = false;
            } else {
                $message = 'Registration was not successful.';
                $again = true;
            }
        }
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
        $again = true;
    }
} else {
    header('Location: login');
    exit;
}
