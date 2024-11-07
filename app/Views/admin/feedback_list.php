<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #007BFF;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        .li-exam {
            background: #fff;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        strong {
            display: block;
            margin-bottom: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>All Feedback</h1>
    <ul>
        <?php foreach ($feedback as $item): ?>
            <li class='li-exam'>
                <strong><?= esc($item['user_name']) ?> (<?= esc($item['email']) ?>) on <?= esc($item['created_at']) ?>:</strong>
                <?= esc($item['message']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="footer">
        <a href="/admin/dashboard">Back to Dashboard</a>
    </div>
</body>
</html>
<?= $this->endSection() ?>
