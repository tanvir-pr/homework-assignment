<?php

declare(strict_types=1);
// data base connect done with host
const DB_HOST = 'sql308.infinityfree.com';
const DB_NAME = 'if0_41873288_pizza';
const DB_USER = 'if0_41873288';
const DB_PASS = 'xP8xsPXMnOiKIu';

const UPLOAD_DIR = __DIR__ . '/../assets/uploads/';
const MAX_UPLOAD_SIZE = 2 * 1024 * 1024;

require_once __DIR__ . '/database.inc.php';

$pagetitle = [
    'title' => 'Pizza House Portal',
    'motto' => 'Web Programming 1 Homework',
];

$header = [
    'title' => 'Pizza House Web App',
    'motto' => 'Fresh pizzas from the Pizza database',
];

$footer = [
    'copyright' => 'Copyright ' . date('Y') . '.',
    'firm' => 'Pizza House Ltd.',
];

$pages = [
    '/' => ['file' => 'home', 'text' => 'Mainpage', 'menun' => [1, 1]],
    'images' => ['file' => 'images', 'text' => 'Images', 'menun' => [1, 1]],
    'contact' => ['file' => 'contact', 'text' => 'Contact', 'menun' => [1, 1]],
    'crud' => ['file' => 'crud', 'text' => 'CRUD', 'menun' => [1, 1]],
    'messages' => ['file' => 'messages', 'text' => 'Messages', 'menun' => [0, 1]],
    'login' => ['file' => 'login', 'text' => 'Login', 'menun' => [1, 0]],
    'login2' => ['file' => 'login2', 'text' => '', 'menun' => [0, 0]],
    'logout' => ['file' => 'logout', 'text' => 'Logout', 'menun' => [0, 1]],
    'register' => ['file' => 'register', 'text' => '', 'menun' => [0, 0]],
    'contact-submit' => ['file' => 'contact_submit', 'text' => '', 'menun' => [0, 0]],
    'upload-image' => ['file' => 'upload_image', 'text' => '', 'menun' => [0, 0]],
    'crud-create' => ['file' => 'crud_create', 'text' => '', 'menun' => [0, 0]],
    'crud-edit' => ['file' => 'crud_edit', 'text' => '', 'menun' => [0, 0]],
    'crud-delete' => ['file' => 'crud_delete', 'text' => '', 'menun' => [0, 0]],
];

$error_page = ['file' => '404', 'text' => 'Page not found!'];
