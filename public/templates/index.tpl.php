<?php session_start(); ?>
<?php if (file_exists('./logicals/' . $find['file'] . '.php')) {
    include './logicals/' . $find['file'] . '.php';
} ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pagetitle['title'] . (isset($pagetitle['motto']) ? ' | ' . $pagetitle['motto'] : '')) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/style.css" type="text/css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark app-navbar shadow-sm">
    <div class="container">
        <a class="navbar-brand" href=".">Pizza House</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav ms-auto">
                <?php foreach ($pages as $url => $page) { ?>
                    <?php if ($page['text'] === '') {
                        continue;
                    } ?>
                    <?php if ((!isset($_SESSION['login']) && $page['menun'][0]) || (isset($_SESSION['login']) && $page['menun'][1])) { ?>
                        <li class="nav-item">
                            <a class="nav-link<?= ($page === $find) ? ' active' : '' ?>" href="<?= ($url === '/') ? '.' : $url ?>">
                                <?= htmlspecialchars($page['text']) ?>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<header class="app-hero text-white py-4 mb-4 shadow-sm">
    <div class="container d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h1 class="h3 m-0"><?= htmlspecialchars($header['title']) ?></h1>
            <?php if (!empty($header['motto'])) { ?>
                <p class="m-0 small opacity-75"><?= htmlspecialchars($header['motto']) ?></p>
            <?php } ?>
        </div>
        <?php if (isset($_SESSION['login'])) { ?>
            <p class="m-0 badge rounded-pill text-bg-light px-3 py-2">
                Logged-in: <strong><?= htmlspecialchars($_SESSION['fn'] . ' ' . $_SESSION['ln'] . ' (' . $_SESSION['login'] . ')') ?></strong>
            </p>
        <?php } ?>
    </div>
</header>
<main class="container pb-5">
    <?php if (isset($_SESSION['flash'])) { ?>
        <div class="alert alert-info"><?= htmlspecialchars((string) $_SESSION['flash']) ?></div>
        <?php unset($_SESSION['flash']); ?>
    <?php } ?>
    <?php
    $pageTemplate = './templates/pages/' . $find['file'] . '.tpl.php';
    if (file_exists($pageTemplate)) {
        include $pageTemplate;
    }
    ?>
</main>
<footer class="text-center py-4 text-muted">
    <?php if (isset($footer['copyright'])) { ?>&copy;&nbsp;<?= htmlspecialchars($footer['copyright']) ?><?php } ?>
    <?php if (isset($footer['firm'])) { ?>&nbsp;<?= htmlspecialchars($footer['firm']) ?><?php } ?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/contact-validation.js"></script>
</body>
</html>
