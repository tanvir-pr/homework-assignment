<?php if (isset($row)) { ?>
    <?php if ($row) { ?>
        <h2>Logged in</h2>
        <p>Name: <strong><?= htmlspecialchars($row['family_name'] . ' ' . $row['surname']) ?></strong></p>
        <a href=".">Go to mainpage</a>
    <?php } else { ?>
        <h2>Login failed</h2>
        <a href="login">Try again</a>
    <?php } ?>
<?php } ?>
<?php if (isset($errormessage)) { ?>
    <div class="alert alert-danger"><?= htmlspecialchars($errormessage) ?></div>
<?php } ?>
