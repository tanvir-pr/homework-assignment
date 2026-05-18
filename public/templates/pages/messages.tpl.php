<section>
    <h2>Messages</h2>
    <?php if (isset($errormessage)) { ?>
        <div class="alert alert-danger"><?= htmlspecialchars($errormessage) ?></div>
    <?php } ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Sent at</th>
                    <th>Sender</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $msg) { ?>
                    <tr>
                        <td><?= htmlspecialchars($msg['created_at']) ?></td>
                        <td>
                            <?php if ($msg['user_id']) { ?>
                                <?= htmlspecialchars($msg['family_name'] . ' ' . $msg['surname']) ?>
                            <?php } else { ?>
                                Guest
                            <?php } ?>
                        </td>
                        <td><?= htmlspecialchars($msg['sender_email']) ?></td>
                        <td><?= htmlspecialchars($msg['subject']) ?></td>
                        <td><?= htmlspecialchars($msg['message_body']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>
