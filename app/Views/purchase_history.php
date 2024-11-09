<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History - Luxury Car Sales</title>
    <?= $this->include('layout/header') ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .purchase-log {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .purchase-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .purchase-card:hover {
            transform: translateY(-5px);
        }
        .car-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .purchase-details {
            padding: 20px;
        }
        .purchase-date {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 10px;
        }
        .car-model {
            font-size: 1.2em;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .price {
            font-size: 1.1em;
            font-weight: 600;
            color: #4CAF50;
            margin-bottom: 10px;
        }
        .customer-info, .payment-info {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 5px;
        }
        .alert {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .approval-status {
            font-size: 1rem;
            font-weight: bold;
            margin-top: 10px;
        }
        .approval-status.approved {
            color: #10b981;
        }
        .approval-status.pending {
            color: #f59e0b;
        }
        .download-btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        .download-btn:hover {
            background-color: #45a049;
        }
        @media (max-width: 768px) {
            .purchase-log {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Purchase History</h1>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <div class="purchase-log">
            <?php if (empty($purchases)): ?>
                <p>No purchase history available.</p>
            <?php else: ?>
                <?php foreach ($purchases as $purchase): ?>
                    <div class="purchase-card">
                        <img src="<?= esc($purchase['car_image']) ?>" alt="<?= esc($purchase['car_model']) ?>" class="car-image">
                        <div class="purchase-details">
                            <div class="purchase-date">
                                <i class="fas fa-calendar-alt" aria-hidden="true"></i> 
                                <span>Purchased on: <?= date('F j, Y, g:i a', strtotime($purchase['purchase_date'])) ?></span>
                            </div>
                            <div class="car-model"><?= esc($purchase['car_model']) ?></div>
                            <div class="price">₱<?= number_format($purchase['price'], 2) ?></div>
                            <div class="customer-info">
                                <i class="fas fa-user" aria-hidden="true"></i>
                                <span><?= esc($purchase['customer_name']) ?></span>
                            </div>
                            <div class="customer-info">
                                <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                                <span><?= esc($purchase['customer_address']) ?></span>
                            </div>
                            <div class="payment-info">
                                <i class="fas fa-credit-card" aria-hidden="true"></i>
                                <span><?= esc($purchase['payment_method']) ?></span>
                            </div>
                            <div class="approval-status <?= $purchase['is_approved'] ? 'approved' : 'pending' ?>">
                                <strong>Approval Status:</strong> <?= $purchase['is_approved'] ? 'Approved' : 'Pending' ?>
                            </div>
                            <?php if ($purchase['is_approved']): ?>
                                <div class="download-agreement">
                                    <a href="<?= base_url('purchase/agreement/' . $purchase['id']) ?>" class="download-btn">
                                        Download Purchase Agreement
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <?= $this->include('layout/footer') ?>
</body>
</html>