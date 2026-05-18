<?php

declare(strict_types=1);

include './includes/config.inc.php';

$page = $_SERVER['QUERY_STRING'] ?? '';

if ($page !== '' && str_contains($page, '=')) {
    parse_str($page, $_GET);
}

$pageKey = isset($_GET['route'])
    ? trim((string) $_GET['route'], '/')
    : trim(urldecode($page === '' ? '' : explode('&', $page, 2)[0]), '/');

if ($pageKey === '' || $pageKey === 'home') {
    $find = $pages['/'];
} elseif (isset($pages[$pageKey])) {
    $find = $pages[$pageKey];
    $tpl = "./templates/pages/{$find['file']}.tpl.php";
    $logical = "./logicals/{$find['file']}.php";
    if (!file_exists($tpl) && !file_exists($logical)) {
        $find = $error_page;
        header('HTTP/1.0 404 Not Found');
    }
} else {
    $find = $error_page;
    header('HTTP/1.0 404 Not Found');
}

include './templates/index.tpl.php';
