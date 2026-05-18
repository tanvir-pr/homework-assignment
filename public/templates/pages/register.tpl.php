<?php if (isset($message)) { ?>
    <h2>Registration</h2>
    <p><?= htmlspecialchars($message) ?></p>
    <?php if (!empty($again)) { ?>
        <a href="login">Try again</a>
    <?php } else { ?>
        <a href="login">Go to login</a>
    <?php } ?>
<?php } ?>
