<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Feedback</title>
</head>
<body>
    <h1>Your Feedback</h1>
    <?php if (session()->getFlashdata('message')): ?>
        <p><?= session()->getFlashdata('message') ?></p>
    <?php endif; ?>
    <a href="/feedback/create">Give Feedback</a>
    <ul>
        <?php foreach ($feedback as $item): ?>
            <li>
                <strong><?= esc($item['created_at']) ?>:</strong>
                <?= esc($item['message']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
