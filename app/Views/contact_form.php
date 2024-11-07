<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
</head>
<body>
    <h1>Contact Us</h1>
    
    <?php if (session()->getFlashdata('success')): ?>
        <p><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <form action="/contact/submit" method="post">
        <?= csrf_field() ?>
        <label>Name:</label><br>
        <input type="text" name="name" value="<?= old('name') ?>"><br>
        <div><?= \Config\Services::validation()->getError('name') ?></div>
        
        <label>Email:</label><br>
        <input type="email" name="email" value="<?= old('email') ?>"><br>
        <div><?= \Config\Services::validation()->getError('email') ?></div>

        <label>Message:</label><br>
        <textarea name="message"><?= old('message') ?></textarea><br>
        <div><?= \Config\Services::validation()->getError('message') ?></div>

        <button type="submit">Send Message</button>
    </form>
</body>
</html>
