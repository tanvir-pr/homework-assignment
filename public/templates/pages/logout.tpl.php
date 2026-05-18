<h2>Logged out</h2>
<?php if (!empty($data['login'])) { ?>
    <p><?= htmlspecialchars($data['fn'] . ' ' . $data['ln'] . ' (' . $data['login'] . ')') ?></p>
<?php } ?>
<a href=".">Back to mainpage</a>
