<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Return Confirmation</title>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f4f4; color: #333; }
        .container { max-width: 800px; margin: 0 auto; padding: 20px; }
        .card { background-color: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); }
        .btn { display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: #fff; border-radius: 5px; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Confirm Return</h2>
            <p><strong>Product Model:</strong> <?= esc($rental['product_model']) ?></p>
            <p><strong>Rental Price:</strong> PHP <?= esc(number_format($rental['price'], 2)) ?></p>
            <?php if ($isLate): ?>
                <p><strong>Penalty:</strong> PHP <?= esc(number_format($penalty, 2)) ?> (Late by <?= $hoursLate ?> hours)</p>
            <?php endif; ?>
            <p><strong>Total Price:</strong> PHP <?= esc(number_format($totalPrice, 2)) ?></p>
            <a href="<?= base_url('user/confirm_return/' . $rental['id']) ?>" class="btn">Confirm Return</a>
        </div>
    </div>
</body>
</html>
