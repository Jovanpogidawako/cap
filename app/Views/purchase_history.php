<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?= $this->include('layout/header') ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History - Luxury Car Rentals</title>
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
        .purchase-date, .real-time-date {
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
    </style>
    <script>
        // Function to update the real-time date
        function updateRealTimeDate() {
            const realTimeElement = document.getElementById('realTimeDate');
            const now = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true };
            realTimeElement.textContent = now.toLocaleString('en-US', options);
        }

        // Update the real-time date every second
        setInterval(updateRealTimeDate, 1000);
    </script>
</head>
<body>
    <div class="container">
        <h1>Purchase History</h1>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert"><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?= $this->include('layout/header') ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History - Luxury Car Rentals</title>
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
        .purchase-date, .real-time-date {
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
        .status-approval {
            margin-top: 10px;
            font-size: 0.9em;
            color: white;
            background-color: #28a745;
            padding: 5px;
            border-radius: 5px;
            text-align: center;
        }
        .status-rejected {
            margin-top: 10px;
            font-size: 0.9em;
            color: white;
            background-color: #dc3545;
            padding: 5px;
            border-radius: 5px;
            text-align: center;
        }

    .approval-status {
        font-size: 1rem;
        color: <?= $purchase['is_approved'] ? '#10b981' : '#f59e0b' ?>;
        font-weight: bold;
        margin-top: 10px;
    }


    </style>
    <script>
        // Function to update the real-time date
        function updateRealTimeDate() {
            const realTimeElement = document.getElementById('realTimeDate');
            const now = new Date();
            const options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true };
            realTimeElement.textContent = now.toLocaleString('en-US', options);
        }

        // Update the real-time date every second
        setInterval(updateRealTimeDate, 1000);
    </script>
</head>
<body>
    <div class="container">
        <h1>Purchase History</h1>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <div class="purchase-log">
            <!-- Looping through each purchase -->
            <?php foreach ($purchases as $purchase): ?>
                <div class="purchase-card">
                    <img src="<?= esc($purchase['car_image']) ?>" alt="<?= esc($purchase['car_model']) ?>" class="car-image">

                    <div class="purchase-details">
                        <!-- Exact Purchase Date from Database -->
                        <div class="purchase-date">
                        <i class="fas fa-calendar-alt"></i> Purchased on: <?= date('F j, Y, g:i a', strtotime($purchase['purchase_date'])) ?>
                        </div>
                        <div class="car-model"><?= esc($purchase['car_model']) ?></div>
                        <div class="price">₱<?= number_format($purchase['price'], 2) ?></div>
                        <div class="customer-info">
                            <i class="fas fa-user"></i> <?= esc($purchase['customer_name']) ?>
                        </div>
                        <div class="customer-info">
                            <i class="fas fa-map-marker-alt"></i> <?= esc($purchase['customer_address']) ?>
                        </div>
                        <div class="payment-info">
                            <i class="fas fa-credit-card"></i> <?= esc($purchase['payment_method']) ?>
                        </div>
                        <div class="approval-status">
    <strong>Approval Status:</strong> <?= $purchase['is_approved'] ? 'Approved' : 'Pending' ?>
</div>


                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?= $this->include('layout/footer') ?>
</body>
</html>

                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <div class="purchase-log">
            <!-- Looping through each purchase -->
            <?php foreach ($purchases as $purchase): ?>
                <div class="purchase-card">
                    <img src="<?= esc($purchase['car_image']) ?>" alt="<?= esc($purchase['car_model']) ?>" class="car-image">

                    <div class="purchase-details">
                        <!-- Exact Purchase Date from Database -->
                        <div class="purchase-date">
                        <i class="fas fa-calendar-alt"></i> Purchased on: <?= date('F j, Y, g:i a', strtotime($purchase['purchase_date'])) ?>
                        </div>
                        <div class="car-model"><?= esc($purchase['car_model']) ?></div>
                        <div class="price">₱<?= number_format($purchase['price'], 2) ?></div>
                        <div class="customer-info">
                            <i class="fas fa-user"></i> <?= esc($purchase['customer_name']) ?>
                        </div>
                        <div class="customer-info">
                            <i class="fas fa-map-marker-alt"></i> <?= esc($purchase['customer_address']) ?>
                        </div>
                        <div class="payment-info">
                            <i class="fas fa-credit-card"></i> <?= esc($purchase['payment_method']) ?>
                        </div>
                        <div class="approval-status">
    <strong>Approval Status:</strong> <?= $purchase['is_approved'] ? 'Approved' : 'Pending' ?>
</div>
                        <a href="/feedback/create">Give Feedback</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?= $this->include('layout/footer') ?>
</body>
</html>
