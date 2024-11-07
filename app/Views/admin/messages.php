<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
</head>
<body>
    <h1>Contact Messages</h1>
    
    <?php if (session()->getFlashdata('success')): ?>
        <p><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Action</th>
        </tr>
        <?php foreach ($messages as $message): ?>
            <tr>
                <td><?= esc($message['name']) ?></td>
                <td><?= esc($message['email']) ?></td>
                <td><?= esc($message['message']) ?></td>
                <td>
                    <a href="/contact/delete/<?= $message['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
