<?php

declare(strict_types=1);

$data = [
    'fn' => $_SESSION['fn'] ?? '',
    'ln' => $_SESSION['ln'] ?? '',
    'login' => $_SESSION['login'] ?? '',
];

unset($_SESSION['fn'], $_SESSION['ln'], $_SESSION['login'], $_SESSION['uid'], $_SESSION['flash']);
