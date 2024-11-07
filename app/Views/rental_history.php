<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .container {
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    h1 {
        font-size: 28px;
        font-weight: bold;
        color: #333;
        margin-bottom: 30px;
    }

    .card {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .rental-item {
        border-bottom: 1px solid #ddd;
        padding: 15px 0;
    }

    .status {
        font-weight: bold;
    }

    .status.success {
        color: green;
    }

    .status.primary {
        color: blue;
    }

    .status.info {
        color: orange;
    }

    .status.secondary {
        color: grey;
    }

    .price {
        font-weight: bold;
    }
</style>

<div class="container">
    <h1>
        <i class="fas fa-history"></i> Rental History
    </h1>
    <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success">
        <?= esc($_SESSION['message']) ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>


    <?php if (!empty($rentals)): ?>
        <?php foreach ($rentals as $rental): ?>
            <div class="card rental-item">
                <div>
                    <strong>Name:</strong> <?= esc($rental['user_name']) ?><br>
                    <strong>First Location:</strong> <?= esc($rental['FirstLocation']) ?><br>
                    <strong>Second Location:</strong> <?= esc($rental['SecondLocation']) ?><br>
                    <strong>Start Date:</strong> <?= esc($rental['StartDate']) ?> <?= esc($rental['StartTime']) ?><br>
                    <strong>End Date:</strong> <?= esc($rental['EndDate']) ?> <?= esc($rental['EndTime']) ?><br>
                    <strong class="price">Price: PHP <?= esc(number_format((float)$rental['price'], 2)) ?></strong><br>
                    <strong class="status" style="color: <?= esc($rental['statusColor']) ?>">Status: <?= esc($rental['Status']) ?></strong>
                    <!-- Only show the return button if the rental is still active/ongoing -->
                    <?php if ($rental['Status'] === 'Active'): ?>
                        <a href="<?= base_url('user/return_car/' . $rental['id']) ?>" class="btn">Return Car</a>
                    <?php else: ?>
                        <span class="status-returned">Returned</span>
                    <?php endif; ?>

                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No rental history available.</p>
    <?php endif; ?>
</div>

<?= $this->include('layout/footer') ?>
